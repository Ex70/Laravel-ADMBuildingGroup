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
          <div id="jsGrid1" class="jsgrid" style="position: relative; height: 100%; width: 100%;"><div class="jsgrid-grid-header jsgrid-header-scrollbar"><table class="jsgrid-table"><tr class="jsgrid-header-row"><th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 150px;">Name</th><th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 50px;">Age</th><th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 200px;">Address</th><th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable" style="width: 100px;">Country</th><th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable" style="width: 100px;">Is Married</th></tr><tr class="jsgrid-filter-row" style="display: none;"><td class="jsgrid-cell" style="width: 150px;"><input type="text"></td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;"><input type="number"></td><td class="jsgrid-cell" style="width: 200px;"><input type="text"></td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><select><option value="0"></option><option value="1">United States</option><option value="2">Canada</option><option value="3">United Kingdom</option><option value="4">France</option><option value="5">Brazil</option><option value="6">China</option><option value="7">Russia</option></select></td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" readonly=""></td></tr><tr class="jsgrid-insert-row" style="display: none;"><td class="jsgrid-cell" style="width: 150px;"><input type="text"></td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;"><input type="number"></td><td class="jsgrid-cell" style="width: 200px;"><input type="text"></td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><select><option value="0"></option><option value="1">United States</option><option value="2">Canada</option><option value="3">United Kingdom</option><option value="4">France</option><option value="5">Brazil</option><option value="6">China</option><option value="7">Russia</option></select></td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox"></td></tr></table></div><div class="jsgrid-grid-body" style="height: 821px;"><table class="jsgrid-table"><tbody><tr class="jsgrid-row"><td class="jsgrid-cell" style="width: 150px;">Otto Clay</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">61</td><td class="jsgrid-cell" style="width: 200px;">Ap #897-1459 Quam Avenue</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">China</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-alt-row"><td class="jsgrid-cell" style="width: 150px;">Connor Johnston</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">73</td><td class="jsgrid-cell" style="width: 200px;">Ap #370-4647 Dis Av.</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Russia</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-row"><td class="jsgrid-cell" style="width: 150px;">Lacey Hess</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">29</td><td class="jsgrid-cell" style="width: 200px;">Ap #365-8835 Integer St.</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Russia</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-alt-row"><td class="jsgrid-cell" style="width: 150px;">Timothy Henson</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">78</td><td class="jsgrid-cell" style="width: 200px;">911-5143 Luctus Ave</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">United States</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-row"><td class="jsgrid-cell" style="width: 150px;">Ramona Benton</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">43</td><td class="jsgrid-cell" style="width: 200px;">Ap #614-689 Vehicula Street</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Brazil</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-alt-row"><td class="jsgrid-cell" style="width: 150px;">Ezra Tillman</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">51</td><td class="jsgrid-cell" style="width: 200px;">P.O. Box 738, 7583 Quisque St.</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">United States</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-row"><td class="jsgrid-cell" style="width: 150px;">Dante Carter</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">59</td><td class="jsgrid-cell" style="width: 200px;">P.O. Box 976, 6316 Lorem, St.</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">United States</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-alt-row"><td class="jsgrid-cell" style="width: 150px;">Christopher Mcclure</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">58</td><td class="jsgrid-cell" style="width: 200px;">847-4303 Dictum Av.</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">United States</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-row"><td class="jsgrid-cell" style="width: 150px;">Ruby Rocha</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">62</td><td class="jsgrid-cell" style="width: 200px;">5212 Sagittis Ave</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Canada</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-alt-row"><td class="jsgrid-cell" style="width: 150px;">Imelda Hardin</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">39</td><td class="jsgrid-cell" style="width: 200px;">719-7009 Auctor Av.</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Brazil</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-row"><td class="jsgrid-cell" style="width: 150px;">Jonah Johns</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">28</td><td class="jsgrid-cell" style="width: 200px;">P.O. Box 939, 9310 A Ave</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Brazil</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-alt-row"><td class="jsgrid-cell" style="width: 150px;">Herman Rosa</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">49</td><td class="jsgrid-cell" style="width: 200px;">718-7162 Molestie Av.</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Russia</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-row"><td class="jsgrid-cell" style="width: 150px;">Arthur Gay</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">20</td><td class="jsgrid-cell" style="width: 200px;">5497 Neque Street</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Russia</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-alt-row"><td class="jsgrid-cell" style="width: 150px;">Xena Wilkerson</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">63</td><td class="jsgrid-cell" style="width: 200px;">Ap #303-6974 Proin Street</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">United States</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-row"><td class="jsgrid-cell" style="width: 150px;">Lilah Atkins</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">33</td><td class="jsgrid-cell" style="width: 200px;">622-8602 Gravida Ave</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Brazil</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-alt-row"><td class="jsgrid-cell" style="width: 150px;">Malik Shepard</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">59</td><td class="jsgrid-cell" style="width: 200px;">967-5176 Tincidunt Av.</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">United States</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-row jsgrid-selected-row"><td class="jsgrid-cell" style="width: 150px;">Keely Silva</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">24</td><td class="jsgrid-cell" style="width: 200px;">P.O. Box 153, 8995 Praesent Ave</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">United States</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-alt-row"><td class="jsgrid-cell" style="width: 150px;">Hunter Pate</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">73</td><td class="jsgrid-cell" style="width: 200px;">P.O. Box 771, 7599 Ante, Road</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Russia</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-row"><td class="jsgrid-cell" style="width: 150px;">Mikayla Roach</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">55</td><td class="jsgrid-cell" style="width: 200px;">Ap #438-9886 Donec Rd.</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">Brazil</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr><tr class="jsgrid-alt-row"><td class="jsgrid-cell" style="width: 150px;">Upton Joseph</td><td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">48</td><td class="jsgrid-cell" style="width: 200px;">Ap #896-7592 Habitant St.</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;">France</td><td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><input type="checkbox" disabled=""></td></tr></tbody></table></div><div class="jsgrid-pager-container"><div class="jsgrid-pager">Pages: <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button"><a href="javascript:void(0);">First</a></span> <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button"><a href="javascript:void(0);">Prev</a></span> <span class="jsgrid-pager-page jsgrid-pager-current-page">1</span><span class="jsgrid-pager-page"><a href="javascript:void(0);">2</a></span><span class="jsgrid-pager-page"><a href="javascript:void(0);">3</a></span><span class="jsgrid-pager-page"><a href="javascript:void(0);">4</a></span><span class="jsgrid-pager-page"><a href="javascript:void(0);">5</a></span> <span class="jsgrid-pager-nav-button"><a href="javascript:void(0);">Next</a></span> <span class="jsgrid-pager-nav-button"><a href="javascript:void(0);">Last</a></span> &nbsp;&nbsp; 1 of 5 </div></div><div class="jsgrid-load-shader" style="display: none; position: absolute; inset: 0px; z-index: 1000;"></div><div class="jsgrid-load-panel" style="display: none; position: absolute; top: 50%; left: 50%; z-index: 1000;">Please, wait...</div></div>
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