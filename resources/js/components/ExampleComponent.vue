<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Bodegas
                                <button type="button" class="btn btn-warning" data-container="body" data-toggle="popover" data-placement="top" data-content="Top popover" style="float:right" @click="accionBodega('crear')">
                                    Añadir Bodega
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive" v-if="listadoBodegas">
                                    <table class="table table-striped table-sm">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Bodega</th>
                                            <th>Responsable</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="listarBodegas.length > 0">
                                        <tr v-for="(bodega,index) in listarBodegas" :key="index">
                                            <th class="text-center">{{ index + 1 }}</th>
                                            <td>{{ bodega.nombre }}</td>
                                            <td>{{ bodega.responsable.name }}</td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <div class="alert alert-primary" role="alert" v-if="listarBodegas.length < 1">
                                        Actualmente no existen bodegas.
                                    </div>
                                </div>
                                <div v-else>
                                    <div>
                                        <label>Bodega</label>
                                        <input type="text" class="form-control" placeholder="Nombre" v-model="bodega">
                                    </div>
                                    <div class="mt-2">
                                        <label>Responsable</label>
                                        <select class="form-control" v-model="idResponsable">
                                            <option value="">Seleccione</option>
                                            <option v-for="user in listarUsuarios" :key="user.id" :value="user.id">{{ user.name }}</option>
                                        </select>
                                    </div>
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-primary" @click="guardarBodega">Guardar</button>
                                        <button type="button" class="btn btn-danger" @click="accionBodega('listado')">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                <div class="card-header">
                    Inventario
                    <button type="button" class="btn btn-warning" data-container="body" data-toggle="popover" data-placement="top" data-content="Top popover" style="float:right" @click="accionIventario('crear')">
                        Añadir Producto
                    </button>
                </div>
                <div class="card-body">
                    <div v-if="listadoInventario">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Bodega</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Fecha Creación</th>
                                </tr>
                            </thead>
                            <tbody v-if="listarInventario.length > 0">
                                <tr v-for="(inven,index) in listarInventario" :key="index">
                                    <th class="text-center">{{ index + 1 }}</th>
                                    <td>{{ inven.bodega.nombre }}</td>
                                    <td>{{ inven.producto.nombre }}</td>
                                    <th class="text-center">{{ inven.cantidad }}</th>
                                    <td class="text-center">{{ inven.created_by }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-primary" role="alert" v-if="listarInventario.length < 1">
                            El inventario está vacío.
                        </div>
                    </div>
                    <div v-else>
                        <div>
                            <label>Producto</label>
                            <select class="form-control" v-model="idProducto">
                                <option value="">Seleccione</option>
                                <option v-for="product in listarProductos" :key="product.id" :value="product.id">{{ product.nombre }}</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label>Bodega</label>
                            <select class="form-control" v-model="idBodega">
                                <option value="">Seleccione</option>
                                <option v-for="bodega in listarBodegas" :key="bodega.id" :value="bodega.id">{{ bodega.nombre }}</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label>Cantidad</label>
                            <input type="number" class="form-control" placeholder="#" v-model="cantidad">
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-primary" @click="guardarProducto">Guardar</button>
                            <button type="button" class="btn btn-danger" @click="accionIventario('listado')">Cancelar</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            listadoBodegas: true,
            listadoInventario: true,
            listarUsuarios: [],
            listarBodegas: [],
            listarInventario: [],
            listarProductos: [],
            bodega: "",
            idResponsable: "",

            cantidad: "",
            idProducto: "",
            idBodega: "",
        };
    },
    created() {
        this.consultarInfo();
    },
    methods: {
        consultarInfo() {
            axios
            .get(`/info`)
            .then(response => {
                this.listarUsuarios = response.data.usuarios;
                this.listarBodegas = response.data.bodegas;
                this.listarInventario = response.data.inventario;
                this.listarProductos = response.data.productos;
            })
            .catch(response => {
                console.log("Error!");
            });
        },
        consultarBodegas() {
            axios
            .get(`/bodega`)
            .then(response => {
                this.listarBodegas = response.data.bodegas;
            })
            .catch(response => {
                console.log("Error!");
            });
        },
        guardarBodega() {
            const info = {
                nombre: this.bodega,
                user_id: this.idResponsable,
            };
            axios
            .post(`/bodega`,info)
            .then(response => {
                this.listarBodegas = response.data;
                this.accionBodega('listado');
            })
            .catch(response => {
                console.log("Error!");
            });
        },
        accionBodega(accion) {
            if (accion === "listado") {
                this.listadoBodegas = true;
                this.bodega =  "";
                this.idResponsable =  "";
            }
            if (accion === "crear") {
                this.listadoBodegas = false;
            }
        },
        guardarProducto() {
            const info = {
                producto_id: this.idProducto,
                bodega_id: this.idBodega,
                cantidad: this.cantidad
            };
            axios
            .post(`/inventario`,info)
            .then(response => {
                this.listarInventario = response.data;
                this.accionIventario('listado');
            })
            .catch(response => {
                console.log("Error!");
            });
        },
        accionIventario(accion) {
            if (accion === "listado") {
                this.listadoInventario = true;
                this.idProducto =  "";
                this.idBodega =  "";
                this.cantidad = "";
            }
            if (accion === "crear") {
                this.listadoInventario = false;
            }
        }
    },
}
</script>
