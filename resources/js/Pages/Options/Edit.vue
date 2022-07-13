<template>
    <LayoutDashboard>

        <div class="relative flex flex-col md:flex-row md:justify-between align-baseline md:mt-20 mt-5">
            <ResponsibleLabel>Editar Opções da Enquete de id: {{id}} </ResponsibleLabel>
        </div>


        <Fileld>
            <form @submit.prevent="submit">
                <div class="flex md:flex-row flex-col md:space-y-0 space-y-10 md:space-x-3 w-full">
                    <div class="w-full text-center md:text-left">
                        <Label> Titulo da Opção </Label>

                        <div class="flex flex-col space-y-10 w-full" v-for="(option, index) in options">
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
        options: Array,
        id: Number,
        flash: Object
    },

    setup() {

        return {
            options: Array,
        }

    },

    data() {
        return {
            options: [
                { title: '' },
                { title: '' },
                { title: '' }
            ],
            isHidden: false,
        };
    },

    methods: {
        addOption: function () {
            this.options.push({ title: '' });
        },
        deleteOption: function (index) {
            if (this.options.length <= 3) {
                return;
            }

            this.options.splice(index, 1);
            if (index === 0)
                this.addOption()
        },

        submit: function () {
            let options = this.options;
            let urlParams = new URLSearchParams(window.location.search);
            let survey_id = urlParams.get('survey');

            if( !survey_id ){
                window.alert('Algo deu errado na adição das opções...');
                return;
            }

            Inertia.put('/options', {
                options,
                survey_id: survey_id
            });
        }
    },
}
</script>
