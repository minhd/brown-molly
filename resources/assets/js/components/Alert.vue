<script>
export default {

    props: ['type'],

    data() {
        return {
            show: true
        }
    }

}
</script>

<template>
    <div class = "alert" v-show="show">
        <slot></slot>
        <span class="alert-close" @click="show = false">x</span>
    </div>
</template>

<style>
    .alert {
        position:relative;
        background: #ddd;
        border: 1px solid darken(#ddd, 10%);
    }
    .alert-close {
        position:absolute;
        top:1em;
        right:1em;
        cursor:pointer;
    }
</style>




