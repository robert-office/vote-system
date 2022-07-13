<template>
    <LayoutDashboard>
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
                       Criar e escolher Opções
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
