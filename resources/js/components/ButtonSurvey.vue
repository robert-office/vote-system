<template>
    <inertia-link href="/enquetes/create">
        <div
            class="md:flex relative w-12 h-12 btn btnDesktop group transition-all hover:border-primary border cursor-pointer hidden justify-center">
            <span class="text-primary group-hover:scale-125 transition-all font-bold text-3xl self-center">+</span>
        </div>
    </inertia-link>

    <inertia-link href="enquetes/create">
        <div class="md:hidden relative h-12 w-40 border border-primary cursor-pointer mx-auto p-2 my-5 rounded-md">
            <span class="text-primary transition-all font-bold text-xs self-center">Cadastrar nova
                Enquete</span>
        </div>
    </inertia-link>

</template>

<style scoped>
.btnDesktop {
    border-radius: 100%;
    background: #e0e0e0;
    box-shadow: 20px 20px 60px #bebebe,
        -20px -20px 60px #ffffff;
}
</style>
