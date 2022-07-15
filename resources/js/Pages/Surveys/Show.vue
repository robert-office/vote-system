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
            <ResponsibleLabel>Votando na enquete de id {{ survey.id }}</ResponsibleLabel>
        </div>

        <Fileld>
            <p>

            </p>
            <p class="text-center text-sm font-bold text-gray-600"> enquete nº {{ survey.id }} </p>
            <p class="text-center text-2xl text-primary font-bold"> {{ survey.title }} </p>

            <form class="relative w-full flex flex-col justify-center space-y-5 mt-10"
                @submit.prevent="form.post('/votes/' + survey.id)">
                <div v-for="option in options">
                    <div
                        class="relative md:w-1/2 w-full flex flex-row justify-between p-2 border border-primary mx-auto rounded">
                        <div class="flex h-auto">
                            <div class="w-10">
                                <input
                                    v-bind:class="{ disabled: !infos.survey_is_open }"
                                    v-model="picked" :value="option.id" type="radio"
                                    class="appearance-none rounded-full h-4 w-4 border border-primary bg-white checked:bg-primary focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" />
                            </div>
                            <p class="w-full text-gray-600 font-serif font-bold">{{ option.title }}</p>
                        </div>
                        <div class="w-16 flex justify-end absolute -top-3 right-2">
                            <p class="relative bg-gray-100 px-2 text-xs text-center font-bold whitespace-nowrap">
                                 ({{ getCount(option.id) }} votos )
                            </p>
                        </div>
                    </div>
                </div>
                <div class="relative self-center">
                    <ButtonSubmit :disabled="!infos.survey_is_open">
                        <p v-if="infos.survey_is_open">
                            Enviar Resposta
                        </p>
                        <p v-if="!infos.survey_is_open">
                            Enquete Encerrada!
                        </p>
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
import ButtonSubmit from '../../components/ButtonSubmit.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from "vue";
import { format } from 'date-fns';

export default {
    props: {
        survey: Object,
        options: Object,
        infos: Object,
        votes: Object,
        flash: Object
    },

    mounted() {
        window.Echo.channel(`votes_survey_id_${this.$props.survey.id}`)
            .listen('VoteAdded', (votesApi) => {
                this.setLocalVotes(votesApi);
            });
    },

    setup(props) {
        const picked = ref('');
        const isHidden = ref(false);


        const form = useForm({
            'survey_id': props.survey.id,
            'option_id': picked,
        });

        return { form, picked, isHidden, format }
    },

    methods: {
        getCount(id) {
            return this.$props.votes.data.find(vote => vote.id == id)['count'];
        },

        setLocalVotes(data) {
            this.$props.votes.data = data.votes;
        }
    },

    components: {
        LayoutDashboard,
        ResponsibleLabel,
        Fileld,
        ButtonSubmit
    }
}
</script>
