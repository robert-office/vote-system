<template>
    <LayoutDashboard>

        <div v-if="flash.success && !isHidden"
            class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md flex"
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
            <ResponsibleLabel>Editar Opções da Enquete de id: {{ id }} </ResponsibleLabel>
        </div>


        <Fileld>
            <form @submit.prevent="submit">
                <div class="flex md:flex-row flex-col md:space-y-0 space-y-10 md:space-x-3 w-full">
                    <div class="w-full text-center md:text-left">
                        <Label> Titulo das Opções </Label>

                        <div class="flex flex-col space-y-10 w-full" v-for="(option, index) in formOptions">
                            <div class="flex flex-row space-x-5">
                                <input
                                    class="my-2 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    v-model="option.title" :key="index" label="Titulo" type="text"
                                    placeholder="insira o titulo da opção" />

                                <button type="button" @click="deleteOption(index)"
                                    class="relative h-12 md:w-auto w-full mb-2 mt-2 border border-primary cursor-pointer md:px-10 p-2 rounded-md">
                                    <span class="text-primary transition-all font-bold text-xs self-center">
                                        Deletar
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="flex md:flex-row flex-col justify-between">
                            <button type="button" @click="addOption"
                                class="relative md:h-12 h-16 md:w-auto w-full md:mt-10 mt-10 border border-primary cursor-pointer md:px-10 p-2 rounded-md">
                                <span class="text-primary transition-all font-bold text-xs self-center">
                                    Adicionar +1 opção para a enquete
                                </span>
                            </button>
                            <ButtonSubmit>
                                Salvar Informações
                            </ButtonSubmit>
                        </div>
                    </div>
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
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        LayoutDashboard,
        ResponsibleLabel,
        Fileld,
        ButtonSubmit,
        Label
    },

    props: {
        id: Number,
        options: Array,
        flash: Object
    },

    setup(props) {
        return {
            survey_id: props.id
        }
    },

    data(props) {

        let realOptions = props.options.map((option) => {
            return { "title": option.title }
        });

        let fakeOptions = [
            { title: '' },
            { title: '' },
            { title: '' }
        ];

        return {
            formOptions: realOptions.length > 0 ? realOptions : fakeOptions,
            isHidden: false,
        };
    },

    methods: {
        addOption: function () {
            this.formOptions.push({ title: '' });
        },
        deleteOption: function (index) {
            if (this.formOptions.length <= 3) {
                return;
            }

            this.formOptions.splice(index, 1);
            if (index === 0)
                this.addOption()
        },

        submit: function () {
            let options = this.formOptions;

            if (!this.id) {
                window.alert('Algo deu errado na adição das opções...');
                return;
            }

            Inertia.put(`/options/${this.id}`, {
                options
            });
        }
    },
}
</script>
