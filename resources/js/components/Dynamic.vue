<template>
    <div id="app">
    <!-- <toolbar :current-comp="currentComp"></toolbar>     -->
        <div class="container">
            <component :is="currentComp"></component>
        </div>
    </div>
</template>

<script>
import { bus } from './../app.js';
import Usuario from './Unidades.vue';
import Dashboard from './reportes-pdf/reporteUnidades.vue';
export default {
    data() {
        return {
            currentComp: 'usuarios'
        };
    },
    created() {
        bus.$on('switchComp', comp => {
            this.currentComp = comp;
        })
    },
    components: {
        'usuarios': Usuario,
        'dashboard': Dashboard
    }

}
</script>