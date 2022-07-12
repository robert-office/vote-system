<template>
    <header class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <p class="flex flex-row font-medium items-center text-gray-900 mb-4 md:mb-0">
                <img :src="'../../assets/logo-signo.svg'" alt="empresa logo" width="150" />

            </p>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <inertia-link href="/" class="mr-5 cursor-pointer hover:text-gray-900">Home</inertia-link>
                <inertia-link href="/enquetes" class="mr-5 cursor-pointer hover:text-gray-900">Enquetes</inertia-link>
            </nav>
        </div>
    </header>
</template>

<script>

export default {


}
</script>
