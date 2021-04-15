<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer{
    padding: 0;
}
</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background-image:url('./img/img-user2.png')">
                        <h3 class="widget-user-username">{{this.form.nombre}}</h3>
                        <h5 class="widget-user-desc">{{this.form.type}}</h5>
                    </div>
                    <div class="widget-user-image">
                        <!-- <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar"> -->
                        <!-- <img src="storage/empresas/7/logo/1616698339.png" style="width: 100%; height: 100%;">
                        <img :src="'/storage/empresas/7/logo/1616698339.png'" /> -->
                    </div>
                    <div class="card-footer">
                        <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">3,200</h5>
                            <span class="description-text">REPORTES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">13,000</h5>
                            <span class="description-text">MOVIMIENTOS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">35</h5>
                            <span class="description-text">SOLICITUDES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Actividad</a></li>
                            <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Ajustes</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Activity Tab -->
                            <div class="tab-pane" id="activity">
                                <h3 class="text-center">Mostrar actividad del usuario - {{form.id}}</h3>
                            </div>
                            <!-- Setting Tab -->
                            <div class="tab-pane active show" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                                        <div class="col-sm-12">
                                        <input type="" v-model="form.nombre" class="form-control" id="inputName" placeholder="Nombre" :class="{ 'is-invalid': form.errors.has('nombre') }">
                                        <has-error :form="form" field="nombre"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUsuario" class="col-sm-2 control-label">Usuario</label>
                                        <div class="col-sm-12">
                                        <input type="" v-model="form.usuario" class="form-control" id="inputUsuario" placeholder="Usuario" :class="{ 'is-invalid': form.errors.has('usuario') }" disabled>
                                        <has-error :form="form" field="usuario"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Correo</label>
                                        <div class="col-sm-12">
                                        <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Correo electrónico"  :class="{ 'is-invalid': form.errors.has('email') }">
                                        <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-12 control-label">Contraseña (Dejar igual si no requiere el cambio)</label>
                                        <div class="col-sm-12">
                                            <input type="password"
                                                v-model="form.password"
                                                class="form-control"
                                                id="password"
                                                placeholder="Contraseña"
                                                :class="{ 'is-invalid': form.errors.has('password') }"
                                            >
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                    <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Actualizar</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
          </div>
          <!-- end tabs -->
        </div>
    </div>
</template>



<script>
    export default {
        data(){
            return {
                usuarios:{},
                form: new Form({
                    id:'',
                    nombre : '',
                    usuario: '',
                    email: '',
                    password: '',
                    imagen: '',
                    tipo: ''
                })
            }
        },
        //props: ['empresa'],
        mounted() {
            
        },
        methods:{
            cargarUsuario(){
                //axios.get("../api/user"+"/"+Auth::user()->id).then(({data}) => (this.form.fill(data)));
                // axios.get("../api/empresa"+"/"+this.empresa).then(({data}) => (this.empresas = data));
                // this.form.fill(this.empresas);
            },
            getProfilePhoto(){
                let logo = (this.form.logo.length > 200) ? this.form.logo : "/storage/empresas/" +this.form.id + "/logo/"+ this.form.logo ;
                return logo;
            },
            updateInfo(){
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/user/'+this.form.id)
                .then(()=>{
                    swal.fire(
                        '¡Actualizado!',
                        'La información ha sido actualizada.',
                        'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }
                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            }
        },
        created() {
            axios.get("api/profile")
            .then(({ data }) => (this.form.fill(data)));
        }
    }
</script>