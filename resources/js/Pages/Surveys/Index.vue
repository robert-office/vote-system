<template>
    <LayoutDashboard>
        <div v-if="flash.failed && !isHidden"
            class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md flex" role="alert">
            <div class="flex w-11/12">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Alerta</p>
                    <p class="text-sm">
                        {{ flash.failed }}
                    </p>
                </div>
            </div>
            <div class="w-1/12 flex justify-end">
                <button @click="isHidden = !isHidden">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="relative flex flex-col md:flex-row md:justify-between align-baseline md:mt-20 mt-5">
            <ResponsibleLabel>Todas as Enquetes</ResponsibleLabel>
            <ButtonSurvey></ButtonSurvey>
        </div>

        <ResponsiveGrid>
            <div v-for="survey in surveys.data" class="mx-auto md:mx-0">
                <Card :title="survey.title" :id="survey.id" :start_date="addHours(3, survey.start_date)"
                    :end_date="addHours(3, survey.end_date)" />
            </div>
        </ResponsiveGrid>

        <Pagination :links="surveys.links" />
    </LayoutDashboard>
</template>

<script>
import LayoutDashboard from '../../components/LayoutDashboard.vue';
import ResponsibleLabel from '../../components/ResponsibleLabel.vue';
import Card from '../../components/Card.vue';
import ButtonSurvey from '../../components/ButtonSurvey.vue';
import CarrouselCards from '../../components/CarrouselCards.vue';
import ResponsiveGrid from '../../components/ResponsiveGrid.vue';
import Pagination from '../../components/Pagination.vue';
import { ref } from 'vue';

export default {
    props: {
        surveys: Object,
        flash: Object
    },

    setup() {
        const isHidden = ref(false);

        return { isHidden }
    },

    components: {
        LayoutDashboard,
        ResponsibleLabel,
        ButtonSurvey,
        Card,
        CarrouselCards,
        ResponsiveGrid,
        Pagination
    },
    methods: {
        addHours: function (numOfHours, date) {
            date = new Date(date);
            date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);
            return date;
        }
    }
}
</script>
