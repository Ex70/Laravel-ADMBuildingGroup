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
                        <h3 class="card-title">Empresas</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Agregar empresa<i class="fas fa-user-plus fa-wf"></i></button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>RFC</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Logo</th>
                                    <th>Creado el</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="empresa in empresas.data" :key="empresa.id">
                                    <td>{{empresa.id}}</td>
                                    <td>{{empresa.nombre}}</td>
                                    <td>{{empresa.rfc | upText}}</td>
                                    <td>{{empresa.direccion | upText}}</td>
                                    <td>{{empresa.telefono}}</td>
                                    <td>{{empresa.correo | upText}}</td>
                                    <td>{{empresa.logo | upText}}</td>
                                    <td>{{empresa.created_at | myDate}}</td>
                                    <td>
                                        <router-link :to="{ name: 'perfilEmpresa', params: {empresa: empresa.id } }">
                                            <i class="fas fa-eye nav-icon"></i>
                                        </router-link>
                                        /
                                        <a href="#" @click="editarEmpresa(empresa)">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        /
                                        <a href="#" @click="borrarEmpresa(empresa.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="empresas" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Empresa</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Actualizar información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? actualizarEmpresa() : crearEmpresa()">
                        <!-- <input v-model="form.id" type="hidden" name="id"> -->
                            <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.nombre" type="text" name="nombre" placeholder="Nombre" id="nombre"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }">
                                <has-error :form="form" field="nombre"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.direccion" type="text" name="direccion" placeholder="Dirección" id="direccion"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('direccion') }">
                                <has-error :form="form" field="direccion"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.rfc" type="text" name="rfc" placeholder="RFC" id="rfc"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('rfc') }">
                                <has-error :form="form" field="rfc"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.telefono" type="text" name="telefono" placeholder="Teléfono" id="telefono"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('telefono') }">
                                <has-error :form="form" field="telefono"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.correo" type="email" name="correo" placeholder="Correo electrónico" id="correo"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('correo') }">
                                <has-error :form="form" field="correo"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="logo" class="col-sm-2 control-label">Logo</label>
                                <div class="col-sm-12">
                                    <input type="file" @change="updateProfile" name="logo" class="form-input":class="{ 'is-invalid': form.errors.has('logo') }">
                                    <has-error :form="form" field="logo"></has-error>
                                </div>
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
                empresas:{},
                form: new Form({
                    id: '',
                    nombre: '',
                    rfc: '',
                    direccion: '',
                    telefono: '',
                    correo: '',
                    logo: ''
                })
            }
        },
        methods:{
            switchComponent(comp) {
                bus.$emit('switchComp', comp);
            },
            getResults(page = 1) {
                axios.get('api/empresa?page=' + page)
                    .then(response => {
                        this.empresas = response.data;
                    });
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                if(file['size'] < 2111775){ //2MB
                    reader.onloadend = (file) => {
                        this.form.logo = reader.result;
                    }
                    reader.readAsDataURL(file);
                }else{
                    swal.fire({
                        icon: 'error',
                        type: 'error',
                        title: 'Oops...',
                        text: 'Estás subiendo una imagen muy pesada',
                    })
                }
            },
            actualizarEmpresa(){
                this.$Progress.start();
                this.form.put('api/empresa/'+this.form.id)
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
            editarEmpresa(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            borrarEmpresa(id){
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
                            this.form.delete('api/empresa/'+id).then(()=>{
                                swal.fire(
                                    '¡Eliminado!',
                                    'La empresa ha sido eliminada.',
                                    'success'
                                )
                                Fire.$emit('AfterCreate');
                            }).catch(()=>{
                                swal("Error", "Algo malo sucedió.","warning");
                            });
                        }
                })
            },
            cargarEmpresas(){
                axios.get("api/empresa").then(({data}) => (this.empresas = data));
            },
            crearEmpresa(){
                this.$Progress.start();
                this.form.post('api/empresa')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    toast.fire({
                        icon: 'success',
                        type: 'success',
                        title: 'Empresa creada'
                    })
                    this.$Progress.finish();
                })
                .catch(()=>{
                })
            }
        },
        mounted() {
            this.cargarEmpresas();
            Fire.$on('AfterCreate',()=>{
                this.cargarEmpresas();
            });
            Fire.$on('searching',()=>{
                let query = this.$parent.search;
                axios.get('api/findCompany?q='+query)
                .then((data)=>{
                    this.empresas = data.data;
                })
            });
        }
    }
</script>