<template>
    <div class="container-fluid">
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
                        <h3 class="card-title">Estados</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="nuevoModal">Agregar estado  <i class="fas fa-plus fa-wf"></i></button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="estado in estados.data" :key="estado.id">
                                    <td>{{estado.id}}</td>
                                    <td>{{estado.clave | upText}}</td>
                                    <td>{{estado.nombre | upText}}</td>
                                    <td>
                                        <a href="#" @click="editarEstado(estado)">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        /
                                        <a href="#" @click="borrarEstado(estado.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="estados" @pagination-change-page="getResults"></pagination>
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
                    <form @submit.prevent="editmode ? actualizarEstado() : crearUsuario()">
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
                estados:{},
                form: new Form({
                    id: '',
                    nombre: '',
                    clave: ''
                })
            }
        },
        methods:{
            switchComponent(comp) {
                bus.$emit('switchComp', comp);
            },
            getResults(page = 1) {
                axios.get('api/estado?page=' + page)
                    .then(response => {
                        this.estados = response.data;
                    });
            },
            actualizarEstado(){
                this.$Progress.start();
                this.form.put('api/estado/'+this.form.id)
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
            editarEstado(estado){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(estado);
            },
            nuevoModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            borrarEstado(id){
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
                            this.form.delete('api/estado/'+id).then(()=>{
                                swal.fire(
                                    '¡Eliminado!',
                                    'El estado ha sido eliminado.',
                                    'success'
                                )
                                Fire.$emit('AfterCreate');
                            }).catch(()=>{
                                swal("Error", "Algo malo sucedió.","warning");
                            });
                        }
                })
            },
            cargarEstados(){
                if(this.$gate.isAdmin){
                    axios.get("api/estado").then(({data}) => (this.estados = data));
                }
            },
            crearUsuario(){
                this.$Progress.start();
                this.form.post('api/estado')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    toast.fire({
                        icon: 'success',
                        type: 'success',
                        title: 'Estado creado'
                    })
                    this.$Progress.finish();
                })
                .catch(()=>{
                })
            }
        },
        mounted() {
            this.cargarEstados();
            Fire.$on('AfterCreate',()=>{
                this.cargarEstados();
            });
            Fire.$on('searching',()=>{
                let query = this.$parent.$parent.search;
                axios.get('api/findState?q='+query)
                .then((data)=>{
                    this.estados = data.data;
                })
            });
        }
    }
</script>