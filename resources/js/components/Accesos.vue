<template>
    <div class="container">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Asignación de Accesos - {{user.usuario}}</h3>
            </div>
            <div class="form-group">
                <label>Usuarios</label>
                <select class="form-control" name="id_usuario" style="width: 100%;" type="number" v-model="form.id_usuario" :class="{ 'is-invalid': form.errors.has('id_usuario') }"> <option value="">Seleccionar usuario</option> <option v-for="(usuario, c) in usuarios" v-bind:key="c" :value="usuario.id">{{usuario.usuario}}</option>
                </select>
                <has-error :form="form" field="id_usuario"></has-error>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-6">
                                <label>PRESUPUESTO BASE</label>
                                <div v-for="(modulo, c) in modulos" v-bind:key="c">
                                    <div class="custom-control" v-if="user.id==modulo.id_usuario || modulo.id_usuario==NULL">
                                        <label v-if="modulo.clave.length == 1">modulo.nombre</label>
                                        {{modulo.clave.length}}
                                        <!-- <div class="custom-control" v-if="acceso.id_modulo == 1 || index == 3"> -->
                                        <input :id=concatenar+modulo.id :v-model=concatenar+modulo.id type="checkbox" checked=modulo.id_usuario :checked="modulo.id_usuario==user.id ? checked=true : checked=false">
                                        <label>{{modulo.nombre}}</label><br/><br/>
                                    </div>
                                </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>PRESUPUESTO CLIENTE</label><br>
                                <label>Importación</label>
                                <div id='example-3'>
                                    <div v-for="(item, index) in names" :key="index">
                                        <input type="checkbox" :id="item.name" v-model="item.checked">
                                        <label :for="item.name">{{ item.name }}</label>
                                    </div>
                                    <span>Checked names: {{ checkedNames }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button @click.prevent="crearAccesos" type="submit" class="btn btn-success">Asignar permisos</button>
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
                    <form @submit.prevent="editmode ? actualizarCiudad() : crearAccesos()">
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
        props : ['user'],
        data(){
            return{
                editmode: false,
                accesos:{},
                ciudades:{},
                estados:{},
                usuarios:{},
                modulos:{},
                form: new Form({
                    id: '',
                    pruebas:[],
                    1: '',
                    nombre: '',
                    clave: '',
                    estado: '',
                    id_estado: '',
                    id_usuario: '',
                    id_modulo: ''
                }),
                names: [{
                    name: 'jack',
                    checked: true
                }, {
                    name: 'john',
                    checked: true
                }, {
                    name: 'mike',
                    checked: false
                }]
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
                axios.get("api/acceso").then(({data}) => (this.accesos = data.data));
            },
            cargarEstados(){
                axios.get("api/estado").then(({data}) => (this.estados = data));
                console.log(this.estados);
            },
            cargarUsuarios(){
                axios.get("api/user").then(({data}) => (this.usuarios = data));
                console.log(this.usuarios);
            },cargarModulos(){
                axios.get("api/modulosAccesos").then(({data}) => (this.modulos = data));
                console.log(this.modulos);
            },
            crearAccesos(){
                var c = document.getElementById('form.1');
                // var d=document.getElementById('terms_div');
                if (c.checked) {
                    //c= c.slice(c.lastIndexOf('.') + 1);
                    c = c.id;
                    console.log(c);
                    console.log("Seleccionado "+c);
                    c = "this."+c;
                    console.log("Seleccionado "+c);
                    this.form.pruebas.push(true);
                }else{console.log("No seleccionado")}
                this.$Progress.start();
                this.form.post('api/accesos')
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
            this.cargarModulos();
            this.cargarAccesos();
            this.cargarEstados();
            this.cargarUsuarios();
            Fire.$on('AfterCreate',()=>{
                this.cargarAccesos();
            });
        },
        computed: {
            checkedNames () {
                return this.names.filter(item => item.checked).map(name => name.name)
            },
            concatenar(){
                return "form.";
            }
        }
    }
</script>