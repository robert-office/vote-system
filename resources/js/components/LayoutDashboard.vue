<template>
    <Header />
    <div class="relative container mx-auto flex flex-col p-5 mb-40">
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
