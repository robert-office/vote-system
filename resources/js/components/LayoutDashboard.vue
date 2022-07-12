<template>
    <Header />
    <div class="container mx-auto flex p-5 items-center">
        <slot></slot>
    </div>
</template>

<script>
import Header from './Header.vue';

export default {
    mounted() {

    },
    components: {
        Header
    }
}
</script>
