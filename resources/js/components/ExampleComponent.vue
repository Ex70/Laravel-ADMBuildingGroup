<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                    <button 
      class="switch notes" 
      @click="switchComponent('dashboard')"
      :disabled="currentComp === 'dashboard'"
    >notes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { bus } from './../app.js';
    export default {
        props: {
            currentComp: {
                type: String,
                required: true
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
        switchComponent(comp) {
            bus.$emit('switchComp', comp);
        }
    }
    }
</script>
