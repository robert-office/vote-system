<template>
    <LayoutDashboard>
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

export default {
    props: {
        surveys: Object
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
        addHours: function(numOfHours, date) {
            date = new Date(date);
            date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);
            return date;
        }
    }
}
</script>
