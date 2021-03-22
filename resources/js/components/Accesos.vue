<template>
    <div class="container">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Asignación de Accesos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Custom Select</label>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Toggle this custom switch element</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                        <label class="custom-control-label" for="customSwitch3">Toggle this custom switch element with custom colors danger/success</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Custom Select Disabled</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Toggle this custom switch element</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch3">
                        <label class="custom-control-label" for="customSwitch3">Toggle this custom switch element with custom colors danger/success</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" disabled="" id="customSwitch2">
                        <label class="custom-control-label" for="customSwitch2">Disabled custom switch element</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Ciudad </h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Actualizar información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? actualizarCiudad() : crearCiudad()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.nombre" type="text" name="nombre" placeholder="Nombre" id="nombre"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }">
                                <has-error :form="form" field="nombre"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.clave" type="text" name="clave" placeholder="Clave" id="clave"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('clave') }">
                                <has-error :form="form" field="clave"></has-error>
                            </div>
                            <div class="form-group">
                                <!-- <label for="name">Estado</label> -->
                                <select class="form-control" name="id_estado" style="width: 100%;" type="number" 
                                    v-model="form.id_estado" :class="{ 'is-invalid': form.errors.has('id_estado') }">
                                    <option value="">Seleccione estado</option>
                                    <option v-for="(estado, c) in estados" v-bind:key="c" :value="estado.id">{{estado.nombre}}</option>
                                </select>
                                <has-error :form="form" field="id_estado"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Actualizar</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                editmode: false,
                accesos:{},
                ciudades:{},
                estados:{},
                form: new Form({
                    id: '',
                    nombre: '',
                    clave: '',
                    estado: '',
                    id_estado: ''
                })
            }
        },
        methods:{
            claveCorta(cadena){
                let indice = cadena.indexOf("-");
                return cadena.substring(0, indice);
            },
            actualizarCiudad(){
                this.$Progress.start();
                this.form.put('api/ciudad/'+this.form.id)
                .then(()=>{
                    $('#addNew').modal('hide');
                    swal.fire(
                        '¡Actualizado!',
                        'La información ha sido actualizada.',
                        'success'
                    )
                    this.$Progress.finish();
                    this.form.reset();
                    Fire.$emit('AfterCreate');
                })
                .catch(()=>{
                    this.$Progress.fail();
                    this.form.fill(estado);
                });
            },
            editarCiudad(ciudad){
                this.editmode = true;
                ciudad.clave = this.claveCorta(ciudad.clave);
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(ciudad);
            },
            nuevoModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            borrarCiudad(id){
                swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar!'
                    }).then((result) => {
                        if(result.value){
                            this.form.delete('api/ciudad/'+id).then(()=>{
                                swal.fire(
                                    '¡Eliminado!',
                                    'La ciudad ha sido eliminada.',
                                    'success'
                                )
                                Fire.$emit('AfterCreate');
                            }).catch(()=>{
                                swal("Error", "Algo malo sucedió.","warning");
                            });
                        }
                })
            },
            cargarAccesos(){
                axios.get("api/acceso").then(({data}) => (this.accesos = data));
            },
            cargarEstados(){
                axios.get("api/estado").then(({data}) => (this.estados = data));
                console.log(this.estados);
            },
            crearCiudad(){
                this.$Progress.start();
                this.form.post('api/ciudad')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    toast.fire({
                        icon: 'success',
                        type: 'success',
                        title: 'Ciudad creada'
                    })
                    this.$Progress.finish();
                })
                .catch(()=>{
                })
            }
        },
        mounted() {
            this.cargarAccesos();
            this.cargarEstados();
            Fire.$on('AfterCreate',()=>{
                this.cargarAccesos();
            });
        }
    }
</script>