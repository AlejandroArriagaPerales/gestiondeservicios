<template>
    <div class="popup">
        <slot/>
        <h1>Se abre el Telón</h1>
        <button class="popup-close">acaba la función</button>
    </div>

</template>

<script>

export default {
    created(){
        
      },
        data(){
            return {
                
            }
            
        },
        mounted() {
            
        },
        methods: {
            
        }
    }

</script>

<style lang="scss" scoped>
.popup{
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 99;
    background-color: red;


    display: flex;
    align-items: center;
    justify-content: center;


    .popup-inner{
        background-color: #fff;
        padding: 32px;
    }
}
</style>