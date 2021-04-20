<template>
    <div class="container">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Asignación de Accesos</h3>
            </div>
            <div class="form-group">
                <label>Usuarios</label>
                <select class="form-control" @change="seleccionUsuario($event)" name="id_usuario" style="width: 100%;" type="number" v-model="form.id_usuario" :class="{ 'is-invalid': form.errors.has('id_usuario') }"> <option value="">Seleccionar usuario</option> <option v-for="(usuario, c) in usuarios.data" v-bind:key="c" :value="usuario.id">{{usuario.usuario}}</option>
                </select>
                <has-error :form="form" field="id_usuario"></has-error>
            </div>
            <div class="card-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div v-for="(modulo, c) in modulos" v-bind:key="c">
                                <div v-if="modulos[c+1]">
                                    <div v-if="modulo['id_usuario'] !== modulos[c+1].id_usuario && modulo['clave'] == modulos[c+1].clave">
                                        <div class="custom-control" v-if="user.id==modulo.id_usuario && usuario==user.id">
                                            <label v-if="modulo.clave.length==2 && modulo.vista=='0000'">{{modulo.nombre}}</label>
                                            <label v-else-if="modulo.vista=='0000'">&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <label v-else>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <input v-show="modulo.vista!='0000'" :id=concatenar+modulo.id type="checkbox" :checked="modulo.id_usuario==usuario ? checked=true : checked=false">
                                            <br/><br/>
                                        </div>
                                        <div class="custom-control" v-else-if="modulo.id_usuario==usuario">
                                            <label v-if="modulo.clave.length==2 && modulo.vista=='0000'">{{modulo.nombre}}</label>
                                            <label v-else-if="modulo.vista=='0000'">&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <label v-else>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <input v-show="modulo.vista!='0000'" :id=concatenar+modulo.id type="checkbox" :checked="modulo.id_usuario==usuario ? checked=true : checked=false">
                                            <br/><br/>
                                        </div>
                                        <div class="custom-control" v-else-if="user.id==modulo.id_usuario">
                                            <label v-if="modulo.clave.length==2 && modulo.vista=='0000'">{{modulo.nombre}}</label>
                                            <label v-else-if="modulo.vista=='0000'">&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <label v-else>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <input v-show="modulo.vista!='0000'" :id=concatenar+modulo.id type="checkbox" :checked="modulo.id_usuario==usuario ? checked=true : checked=false">
                                            <br/><br/>
                                        </div>
                                    </div>
                                    <div v-else-if="modulo['clave']!=clave">
                                        <div class="custom-control" v-if="user.id==modulo.id_usuario && usuario==user.id">
                                            <label v-if="modulo.clave.length==2 && modulo.vista=='0000'">{{modulo.nombre}}</label>
                                            <label v-else-if="modulo.vista=='0000'">&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <label v-else>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <input v-show="modulo.vista!='0000'" :id=concatenar+modulo.id type="checkbox" :checked="modulo.id_usuario==usuario ? checked=true : checked=false">
                                            <br/><br/>
                                        </div>
                                        <div class="custom-control" v-else-if="modulo.id_usuario==usuario">
                                            <label v-if="modulo.clave.length==2 && modulo.vista=='0000'">{{modulo.nombre}}</label>
                                            <label v-else-if="modulo.vista=='0000'">&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <label v-else>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <input v-show="modulo.vista!='0000'" :id=concatenar+modulo.id type="checkbox" :checked="modulo.id_usuario==usuario ? checked=true : checked=false">
                                            <br/><br/>
                                        </div>
                                        <div class="custom-control" v-else-if="user.id==modulo.id_usuario">
                                            <label v-if="modulo.clave.length==2 && modulo.vista=='0000'">{{modulo.nombre}}</label>
                                            <label v-else-if="modulo.vista=='0000'">&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <label v-else>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <input v-show="modulo.vista!='0000'" :id=concatenar+modulo.id type="checkbox" :checked="modulo.id_usuario==usuario ? checked=true : checked=false">
                                            <br/><br/>
                                        </div>
                                    </div>
                                    <div else></div>
                                </div>
                                <div v-else>
                                    <div v-if="modulo['clave'] !== clave">
                                        <div class="custom-control" v-if="user.id==modulo.id_usuario && usuario==user.id">
                                            <label v-if="modulo.clave.length==2 && modulo.vista=='0000'">{{modulo.nombre}}</label>
                                            <label v-else-if="modulo.vista=='0000'">&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <label v-else>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <input v-show="modulo.vista!='0000'" :id=concatenar+modulo.id type="checkbox" :checked="modulo.id_usuario==usuario ? checked=true : checked=false">
                                            <br/><br/>
                                        </div>
                                        <div class="custom-control" v-else-if="modulo.id_usuario==usuario">
                                            <label v-if="modulo.clave.length==2 && modulo.vista=='0000'">{{modulo.nombre}}</label>
                                            <label v-else-if="modulo.vista=='0000'">&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <label v-else>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <input v-show="modulo.vista!='0000'" :id=concatenar+modulo.id type="checkbox" :checked="modulo.id_usuario==usuario ? checked=true : checked=false">
                                            <br/><br/>
                                        </div>
                                        <div class="custom-control" v-else-if="user.id==modulo.id_usuario">
                                            <label v-if="modulo.clave.length==2 && modulo.vista=='0000'">{{modulo.nombre}}</label>
                                            <label v-else-if="modulo.vista=='0000'">&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <label v-else>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{modulo.nombre}}</label>
                                            <input v-show="modulo.vista!='0000'" :id=concatenar+modulo.id type="checkbox" :checked="modulo.id_usuario==usuario ? checked=true : checked=false">
                                            <br/><br/>
                                        </div>
                                    </div>
                                </div>
                                <div style="display:none">{{clave = modulo.clave}}</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" @click.prevent="crearAccesos" class="btn btn-success float-right" style="margin-right: 5px;">
                                <i class="fas fa-circle"></i> Asignar permisos
                            </button>
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
                clave: '',
                contadorModulos: {},
                usuario: this.user.id,
                form: new Form({
                    id: '',
                    pruebas:[],
                    1: '',
                    nombre: '',
                    permisos: [],
                    clave: '',
                    estado: '',
                    id_estado: '',
                    id_usuario: '',
                    id_modulo: ''
                })
            }
        },
        methods:{
            seleccionUsuario2(event){
                console.log(this.form.id_usuario);
                axios.get("api/modulosAccesos2"+this.form.id_usuario).then(({data}) => (this.modulos = data));
                console.log(this.modulos);
            },
            seleccionUsuario(event) {
                console.log(event.target.value);
                axios.get("api/modulosAccesos2/"+this.form.id_usuario).then(({data}) => (this.modulos = data));
                this.usuario = this.form.id_usuario;
            },
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
            },
            cargarModulos(){
                axios.get("api/modulosAccesos").then(({data}) => (this.modulos = data));
                axios.get("api/modulo").then(({data}) => (this.contadorModulos = data));
            },
            crearAccesos(){
                var contador = this.contadorModulos.length;
                var obj = {};
                for (i=1;i<=contador;i++){
                    this.form.pruebas.splice(0, 1);
                    console.log("Algo")
                }
                var i=0;
                console.log("Contador: "+contador);
                if(this.form.id_usuario<1){
                    this.form.id_usuario = this.user.id;
                }
                for (i=1;i<=contador;i++){
                    var link = false;
                    var formValor = this.concatenar+i;
                    var c = document.getElementById(formValor);
                    if(c.checked){
                        link=true;
                        this.form.pruebas.push({[i] : link});
                    }else{
                        link=false;
                        this.form.pruebas.push({[i] : link});
                    }
                }
                contador = 0;
                this.$Progress.start();
                this.form.post('api/acceso')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide');
                    toast.fire({
                        icon: 'success',
                        type: 'success',
                        title: 'Accesos actualizados'
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
            concatenar(){
                return "form.";
            }
        }
    }
</script>