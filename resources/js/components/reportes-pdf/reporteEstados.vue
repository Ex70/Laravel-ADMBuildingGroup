<template>
    <div class="container-fluid" id="printMe2">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-1">
                </div>
            </div>
        </section>
        <div class="row" id="printMe" ref="document">
            <div class="col-12">
                <div class="invoice p-3 mb-3">
                    <div class="row">
                        <div class="col-12" style="margin-top: 20px;">
                            <h5>
                                <i class="fa fa-globe"></i> Grupo Constructor Acosta Del Moral S.A. de C.V
                                <small class="float-right">Fecha: {{this.callFunction()}}</small>
                            </h5>
                        </div>
                    </div>
                    <div class="p-5 text-center" style="margin-top: 10px;">
                        <h1 class="mb-3">Reporte de estados</h1>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Clave</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="unidad in unidades.data" :key="unidad.id">
                                    <td>{{unidad.id}}</td>
                                    <td>{{unidad.clave | upText}}</td>
                                    <td>{{unidad.descripcion | upText}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-print" v-show="!printing">
            <div class="col-12">
                <a href="" class="btn btn-success float-right" v-print="printObj" @click.prevent="printme">
                    <i class="fa fa-print"></i>
                    Imprimir
                </a>
                <button type="button" @click="exportToPDF" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generar PDF
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import html2pdf from 'html2pdf.js'
    export default {
        data(){
            return {
                printing: false,
                currentDateWithFormat:'',
                printObj: {
                    id: "printMe2",
                    popTitle: 'Reporte Estados',
                    extraCss: 'public/css/app.css,https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
                    extraHead: '<link rel="stylesheet" href="css/app.css">'
                },
                unidades:{}
            }
        },
        mounted() {
            this.cargarUnidades();
            this.callFunction();
        },
        methods:{
            print(){
                this.$htmlToPaper('printMe');
            },
            callFunction: function () {
                var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
                return currentDateWithFormat;
            },
            cargarUnidades(){
                if(this.$gate.isAdmin){
                    axios.get("api/unidad").then(({data}) => (this.unidades = data));
                }
            },
            exportToPDF () {
				html2pdf(this.$refs.document, {
					margin: 1,
					filename: 'Estados -' +this.callFunction()+'.pdf',
					image: { type: 'jpeg', quality: 0.98 },
					html2canvas: { dpi: 192, letterRendering: true },
					jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
				});
			}
        }
    }
</script>