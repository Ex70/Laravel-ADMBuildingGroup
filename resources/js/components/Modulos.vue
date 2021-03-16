<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Modulos</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Agregar modulo  <i class="fas fa-plus fa-wf"></i></button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Vista</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="modulo in modulos" :key="modulo.id">
                                    <td>{{modulo.id}}</td>
                                    <td>{{modulo.clave | upText}}</td>
                                    <td>{{modulo.nombre | upText}}</td>
                                    <td>{{modulo.vista}}</td>
                                    <td>
                                        <a href="#" @click="editarModulo(modulo)">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        /
                                        <a href="#" @click="borrarModulo(modulo.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Modulo </h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Actualizar información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? actualizarModulo() : crearModulo()">
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
                                <input v-model="form.vista" type="text" name="vista" placeholder="Vista" id="vista"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('vista') }">
                                <has-error :form="form" field="vista"></has-error>
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
                modulos:{},
                form: new Form({
                    id: '',
                    nombre: '',
                    clave: '',
                    vista: ''
                })
            }
        },
        methods:{
            actualizarModulo(){
                this.$Progress.start();
                this.form.put('api/modulo/'+this.form.id)
                .then(()=>{
                    $('#addNew').modal('hide');
                    swal.fire(
                        '¡Actualizado!',
                        'La información ha sido actualizada.',
                        'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(()=>{
                    this.$Progress.fail();
                });
                this.form.reset();
            },
            editarModulo(modulo){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(modulo);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            borrarModulo(id){
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
                            this.form.delete('api/modulo/'+id).then(()=>{
                                swal.fire(
                                    '¡Eliminado!',
                                    'El modulo ha sido eliminado.',
                                    'success'
                                )
                                Fire.$emit('AfterCreate');
                            }).catch(()=>{
                                swal("Error", "Algo malo sucedió.","warning");
                            });
                        }
                })
            },
            cargarModulos(){
                axios.get("api/modulo").then(({data}) => (this.modulos = data));
            },
            crearModulo(){
                this.$Progress.start();
                this.form.post('api/modulo')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    toast.fire({
                        icon: 'success',
                        type: 'success',
                        title: 'Modulo creado'
                    })
                    this.$Progress.finish();
                })
                .catch(()=>{
                })
            }
        },
        mounted() {
            this.cargarModulos();
            Fire.$on('AfterCreate',()=>{
                this.cargarModulos();
            });
        }
    }
</script>