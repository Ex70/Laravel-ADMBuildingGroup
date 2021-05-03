<template>
    <div id="app">
        <div class="container">
            <component :is="currentComp" v-bind="currentProp"></component>
        </div>
    </div>
</template>

<script>
import { bus } from './../../app.js';
import Estado from './../Estados.vue';
import Reporte from './../reportes-pdf/reporteEstados.vue';
export default {
    data() {
        return {
            id_usuario:'',
            currentComp: 'estados'
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
            if(this.currentComp === 'estados'){
                return {id_usuario: this.user.id}
            }
        }
    },
    components: {
        'estados': Estado,
        'reporte': Reporte
    }
}
</script>