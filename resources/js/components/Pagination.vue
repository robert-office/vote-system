<template>
    <div v-if="links.length > 3">
        <div class="w-full">
            <div class="flex flex-wrap justify-center mt-10">
                <template v-for="(link, key) in links">
                    <div v-if="link.url === null" :key="'label' + key"
                        class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                        v-html="link.label" />
                    <inertia-link v-else :key="'paginator' + key"
                        class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                        :class="{ 'bg-primary': link.active }" :href="link.url" v-html="link.label" />
                </template>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        links: Array,
    }
}
</script>
