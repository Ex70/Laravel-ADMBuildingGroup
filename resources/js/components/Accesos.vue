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
            getUser(id) {
                return this.modulos[id].clave;
            },
            seleccionUsuario(event) {
                console.log(event.target.value);
                axios.get("api/modulosAccesos2/"+this.form.id_usuario).then(({data}) => (this.modulos = data));
                this.usuario = this.form.id_usuario;
            },
            cargarUsuarios(){
                axios.get("api/user").then(({data}) => (this.usuarios = data));
                console.log(this.usuarios);
            },
            cargarModulos(){
                axios.get("api/modulo").then(({data}) => (this.contadorModulos = data));
            },
            cargarModulosAccesos(){
                axios.get("api/modulosAccesos").then(({data}) => (this.modulos = data));
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
            this.cargarUsuarios();
            this.cargarModulos();
            this.cargarModulosAccesos();
            //this.cargarAccesos();
            //this.cargarEstados();
            // Fire.$on('AfterCreate',()=>{
            //     this.cargarAccesos();
            // });
        },
        computed: {
            concatenar(){
                return "form.";
            }
        }
    }
</script>