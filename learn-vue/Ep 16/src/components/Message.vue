<template>
    <div class="box is-info">
        <slot></slot>
    </div>
</template> 

<script>
export default {
    
}
</script>

<style lang="scss">
    .box{
        background: red;
        padding: 10px;
        border: 1px solid darkgrey;
        margin-bottom: 15px;
    }
</style>