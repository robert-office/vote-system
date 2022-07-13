<template>
    <LayoutDashboard>
        <div v-if="flash.success && !isHidden" class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md flex"
            role="alert">
            <div class="flex w-11/12">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Alerta</p>
                    <p class="text-sm">
                        {{ flash.success }}
                    </p>
                </div>
            </div>
            <div class="w-1/12 flex justify-end">
                <button @click="isHidden = !isHidden">
                    <svg class="fill-current h-6 w-6 text-teal-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
        </div>


        <div class="relative flex flex-col md:flex-row md:justify-between align-baseline md:mt-20 mt-5">
            <ResponsibleLabel>Criar nova Enquete</ResponsibleLabel>
        </div>


        <Fileld>

            <form @submit.prevent="form.post('/enquetes', () => form.reset())">
                <div class="flex md:flex-row flex-col md:space-y-0 space-y-10 md:space-x-3 w-full">
                    <div class="md:w-1/3 w-full text-center md:text-left">
                        <Label> Titulo da Enquete </Label>
                        <input
                            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            v-model="form.title" label="Titulo" type="text" placeholder="insira o titula da enquete" />

                        <p v-if="form.errors.title" class="text-red-500 text-xs italic">
                            {{ form.errors.title }}
                        </p>
                    </div>
                    <div class="md:w-1/3 w-full text-center md:text-left">
                        <Label> Data de inicio </Label>

                        <input
                            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            v-model="form.start_date" type="datetime-local" />

                        <p v-if="form.errors.start_date" class="text-red-500 text-xs italic">
                            {{ form.errors.start_date }}
                        </p>
                    </div>
                    <div class="md:w-1/3 w-full text-center md:text-left">
                        <Label> Data de fim </Label>

                        <input
                            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            v-model="form.end_date" type="datetime-local" />
                        <p v-if="form.errors.end_date" class="text-red-500 text-xs italic">
                            {{ form.errors.end_date }}
                        </p>
                    </div>
                </div>
                <div class="flex md:justify-end md:mr-1">
                    <ButtonSubmit>
                        Criar
                    </ButtonSubmit>
                </div>
            </form>
        </Fileld>
    </LayoutDashboard>
</template>

<script>
import LayoutDashboard from '../../components/LayoutDashboard.vue';
import ResponsibleLabel from '../../components/ResponsibleLabel.vue';
import Fileld from '../../components/Fileld.vue';
import ButtonSubmit from '../../components/ButtonSubmit.vue'
import Label from '../../components/Label.vue'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        LayoutDashboard,
        ResponsibleLabel,
        Fileld,
        ButtonSubmit,
        Label
    },

    props: {
        flash: Object
    },

    data() {
        return {
            isHidden: false,
        };
    },

    setup() {
        const form = useForm({
            title: null,
            start_date: null,
            end_date: null,
        })

        return { form }
    },
}
</script>
