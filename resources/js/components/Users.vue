<template>
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-1">
                </div>
            </div>
        </section>
        <div class="row mt-10" id="printMe" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Agregar usuario<i class="fas fa-user-plus fa-wf"></i></button>
                            <button type="button" v-print="'#printMe'" class="btn btn-info"><i class="icon-doc"></i>&nbsp;Imprimir</button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Usuario</th>
                                    <th>Tipo</th>
                                    <th>Creado el</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data" :key="user.id">
                                    <td>{{user.id}}</td>
                                    <td>{{user.nombre}}</td>
                                    <td>{{user.email | upText}}</td>
                                    <td>{{user.usuario | upText}}</td>
                                    <td v-if="user.tipo==1"><span class="tag tag-success">SU</span></td>
                                    <td v-else><span class="tag tag-success">Admin</span></td>
                                    <td>{{user.created_at | myDate}}</td>
                                    <td>
                                        <a href="#" @click="editarUsuario(user)">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        /
                                        <a href="#" @click="boorarUsuario(user.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="users" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Usuario </h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Actualizar información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? actualizarUsuario() : crearUsuario()">
                        <div class="modal-body">
                            <input v-model="form.tipo" type="hidden" name="tipo" value="0">
                            <input v-model="form.activo" type="hidden" name="activo" value="1">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input v-model="form.nombre" type="text" name="nombre" placeholder="Nombre" id="nombre"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }">
                                <has-error :form="form" field="nombre"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Usuario</label>
                                <input v-model="form.usuario" type="text" name="usuario" placeholder="Usuario" id="usuario"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('usuario') }">
                                <has-error :form="form" field="usuario"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" type="email" name="email" placeholder="Correo electrónico" id="email"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input v-model="form.password" type="password" name="password" id="password" placeholder="Contraseña"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                            <div class="form.-group" v-if="user.tipo==1">
                                <label>Superusuario</label>
                                <input v-model="form.tipo" type="checkbox" :checked="user.tipo==1 ? checked=true : checked=false"><br/><br/>
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
                users:{},
                form: new Form({
                    id: '',
                    nombre: '',
                    usuario: '',
                    email: '',
                    password: '',
                    tipo:0,
                    activo:1
                })
            }
        },
        props : ['user'],
        methods:{
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            actualizarUsuario(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id)
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
            editarUsuario(user){
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
            boorarUsuario(id){
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
                            this.form.delete('api/user/'+id).then(()=>{
                                swal.fire(
                                    '¡Eliminado!',
                                    'El usuario ha sido eliminado.',
                                    'success'
                                )
                                Fire.$emit('AfterCreate');
                            }).catch(()=>{
                                swal("Error", "Algo malo sucedió.","warning");
                            });
                        }
                })
            },
            cargarPdf(){
                window.open('pdfUser','_blank');
            },
            loadUsers(){
                if(this.$gate.isAdmin){
                    axios.get("api/user").then(({data}) => (this.users = data));
                }
            },
            crearUsuario(){
                this.$Progress.start();
                this.form.post('api/user')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    toast.fire({
                        icon: 'success',
                        type: 'success',
                        title: 'Usuario creado'
                    })
                    this.$Progress.finish();
                })
                .catch(()=>{
                })
            }
        },
        mounted() {
            this.loadUsers();
            Fire.$on('AfterCreate',()=>{
                this.loadUsers();
            });
            Fire.$on('searching',()=>{
                let query = this.$parent.search;
                axios.get('api/findUser?q='+query)
                .then((data)=>{
                    this.users = data.data;
                })
            });
        }
    }
</script>