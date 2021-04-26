<template>
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-1">
                </div>
            </div>
        </section>
        <div class="row mt-10" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Unidades</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="nuevoModal">Agregar unidad  <i class="fas fa-plus fa-wf"></i></button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Clave</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="unidad in unidades" :key="unidad.id">
                                    <td>{{unidad.id}}</td>
                                    <td>{{unidad.clave | upText}}</td>
                                    <td>{{unidad.descripcion | upText}}</td>
                                    <td>
                                        <a href="#" @click="editarUnidad(unidad)">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        /
                                        <a href="#" @click="borrarUnidad(unidad.id)">
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
        <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Estado </h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Actualizar información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? actualizarUnidad() : crearUnidad()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Clave</label>
                                <input v-model="form.clave" type="text" name="clave" placeholder="Clave" id="clave"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('clave') }">
                                <has-error :form="form" field="clave"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <input v-model="form.descripcion" type="text" name="descripcion" placeholder="Descripción" id="descripcion"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }">
                                <has-error :form="form" field="descripcion"></has-error>
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
                unidades:{},
                form: new Form({
                    id: '',
                    clave: '',
                    descripcion: ''
                })
            }
        },
        methods:{
            actualizarUnidad(){
                this.$Progress.start();
                this.form.put('api/unidad/'+this.form.id)
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
                    this.form.fill(unidad);
                });
            },
            editarUnidad(unidad){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(unidad);
            },
            nuevoModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            borrarUnidad(id){
                swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar!',
                    cancelButtonText: "Cancelar",
                    }).then((result) => {
                        if(result.value){
                            this.form.delete('api/unidad/'+id).then(()=>{
                                swal.fire(
                                    '¡Eliminado!',
                                    'La unidad ha sido eliminada.',
                                    'success'
                                )
                                Fire.$emit('AfterCreate');
                            }).catch(()=>{
                                swal("Error", "Algo malo sucedió.","warning");
                            });
                        }
                })
            },
            cargarUnidades(){
                if(this.$gate.isAdmin){
                    axios.get("api/unidad").then(({data}) => (this.unidades = data));
                }
            },
            crearUnidad(){
                this.$Progress.start();
                this.form.post('api/unidad')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    toast.fire({
                        icon: 'success',
                        type: 'success',
                        title: 'Unidad creado'
                    })
                    this.$Progress.finish();
                })
                .catch(()=>{
                })
            }
        },
        mounted() {
            this.cargarUnidades();
            Fire.$on('AfterCreate',()=>{
                this.cargarUnidades();
            });
        }
    }
</script>