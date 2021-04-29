<template>
    <div class="container" id="printMe2">
        <div class="row" id="printMe">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fa fa-globe"></i> Grupo Constructor Acosta Del Moral S.A. de C.V
                                <small class="float-right">Fecha: 2/10/2018</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- 0 -->
                    <div class="p-5 text-center bg-light" style="margin-top: 58px;">
                        <h1 class="mb-3">Reporte de unidades</h1>
                        <!-- <h4 class="mb-3">Subheading</h4>
                        <a class="btn btn-primary" href="" role="button">Call to action</a> -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <!-- From
                            <address>
                                <strong>Admin, Inc.</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (804) 123-5432<br>
                                Email: info@almasaeedstudio.com
                            </address> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>Reporte de unidades</strong><br>
                                <!-- 795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (555) 539-1037<br>
                                Email: john.doe@example.com -->
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <!-- <b>Invoice #007612</b><br>
                            <br>
                            <b>Order ID:</b> 4F3S8J<br>
                            <b>Payment Due:</b> 2/22/2014<br>
                            <b>Account:</b> 968-34567 -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Serial #</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Call of Duty</td>
                                        <td>455-981-221</td>
                                        <td>El snort testosterone trophy driving gloves handsome</td>
                                        <td>$64.50</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Need for Speed IV</td>
                                        <td>247-925-726</td>
                                        <td>Wes Anderson umami biodiesel</td>
                                        <td>$50.00</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Monsters DVD</td>
                                        <td>735-845-642</td>
                                        <td>Terry Richardson helvetica tousled street art master</td>
                                        <td>$10.70</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Grown Ups Blue Ray</td>
                                        <td>422-568-642</td>
                                        <td>Tousled lomo letterpress</td>
                                        <td>$25.99</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- this row will not appear when printing -->
                </div>
            <!-- /.invoice -->
            </div>
        </div>
        <div class="row no-print" v-show="!printing">
                        <div class="col-12">
                            <a href="" v-print="printObj" @click.prevent="printme" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                            <a href="" @click="print" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print 2</a>
                            <button type="button" class="btn btn-success float-right">
                                <i class="fa fa-credit-card"></i>
                                Submit Payment
                            </button>
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Generate PDF
                            </button>
                        </div>
                    </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                printing: false,
                printObj: {
                    id: "printMe2",
                    popTitle: 'Reporte Unidades',
                    extraCss: 'public/css/app.css,https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
                    extraHead: '<link rel="stylesheet" href="css/app.css">'
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            print(){
                //this.printing = true;
                //const options = null; // Set this if you need to, based on https://randomcodetips.com/vue-html-to-paper/
                // this.$htmlToPaper('printMe', () => {
                //     this.printing = false;
                // });
                this.$htmlToPaper('printMe');
            }
        }
    }
</script>