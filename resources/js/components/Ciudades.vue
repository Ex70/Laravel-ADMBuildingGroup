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
                        <h3 class="card-title">Ciudades</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="nuevoModal">Agregar ciudad  <i class="fas fa-plus fa-wf"></i></button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ciudad</th>
                                    <th>Estado</th>
                                    <th>Clave</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ciudad in ciudades.data" :key="ciudad.id">
                                    <td>{{ciudad.id}}</td>
                                    <td>{{ciudad.nombre | upText}}</td>
                                    <td>{{ciudad.estado | upText}}</td>
                                    <!-- <td>{{ciudad.clave | upText}}</td> -->
                                    <td>{{claveCorta(ciudad.clave)}}</td>
                                    <!-- <td>{{(ciudad.clave).substring(0, clave)}}</td> -->
                                    <td>
                                        <a href="#" @click="editarCiudad(ciudad)">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        /
                                        <a href="#" @click="borrarCiudad(ciudad.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="ciudades" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Ciudad </h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Actualizar información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? actualizarCiudad() : crearCiudad()">
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
        data(){
            return{
                editmode: false,
                ciudades:{},
                estados:{},
                form: new Form({
                    id: '',
                    nombre: '',
                    clave: '',
                    estado: '',
                    id_estado: ''
                })
            }
        },
        methods:{
            switchComponent(comp) {
                bus.$emit('switchComp', comp);
            },
            getResults(page = 1) {
                axios.get('api/ciudad?page=' + page)
                    .then(response => {
                        this.ciudades = response.data;
                    });
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
            cargarCiudades(){
                axios.get("api/ciudad").then(({data}) => (this.ciudades = data));
            },
            cargarEstados(){
                if(this.$gate.isAdmin){
                    axios.get("api/estado").then(({data}) => (this.estados = data));
                }
            },
            crearCiudad(){
                this.$Progress.start();
                this.form.post('api/ciudad')
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
            this.cargarCiudades();
            this.cargarEstados();
            Fire.$on('AfterCreate',()=>{
                this.cargarCiudades();
            });
            Fire.$on('searching',()=>{
                let query = this.$parent.search;
                axios.get('api/findCity?q='+query)
                .then((data)=>{
                    this.ciudades = data.data;
                })
            });
        }
    }
</script>