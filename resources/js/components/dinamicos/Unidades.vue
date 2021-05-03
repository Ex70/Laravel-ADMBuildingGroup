<template>
    <div id="app">
        <div class="container">
            <component :is="currentComp" v-bind="currentProp"></component>
        </div>
    </div>
</template>

<script>
import { bus } from './../../app.js';
import Unidad from './../Unidades.vue';
import Reporte from './../reportes-pdf/reporteUnidades.vue';
export default {
    data() {
        return {
            id_usuario:'',
            currentComp: 'unidades'
        };
    },
    props:['user'],
    created() {
        bus.$on('switchComp', comp => {
            this.currentComp = comp;
        })
    },
    computed:{
        currentProp: function(){
            if(this.currentComp === 'unidades'){
                return {id_usuario: this.user.id}
            }
        }
    },
    components: {
        'unidades': Unidad,
        'reporte': Reporte
    }
}
</script>