<template>
    <button v-bind:class="{ disabled: isdisabled }" type="submit" class="relative h-12 md:w-auto w-full md:mt-10 mt-10 border bg-primary cursor-pointer md:px-10 p-2 rounded-md">
        <span class="text-white transition-all font-bold text-xs self-center">
            <slot></slot>
        </span>
    </button>
</template>

<script>
    export default {
        props: {
            isdisabled: false
        }
    }
</script>
