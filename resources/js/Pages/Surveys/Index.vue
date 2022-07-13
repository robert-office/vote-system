<template>
    <LayoutDashboard>
        <div class="relative flex flex-col md:flex-row md:justify-between align-baseline md:mt-20 mt-5">
            <ResponsibleLabel>Todas as Enquetes</ResponsibleLabel>
            <ButtonSurvey></ButtonSurvey>
        </div>

        <CarrouselCards>
            <div v-for="survey in surveys">
                <Card :title="survey.title" :id="survey.id" :start_date="survey.start_date"  :end_date="survey.end_date" />
            </div>
        </CarrouselCards>

    </LayoutDashboard>
</template>


<script>
import LayoutDashboard from '../../components/LayoutDashboard.vue';
import ResponsibleLabel from '../../components/ResponsibleLabel.vue';
import Card from '../../components/Card.vue';
import ButtonSurvey from '../../components/ButtonSurvey.vue';
import CarrouselCards from '../../components/CarrouselCards.vue';

export default {
    props: {
        surveys: Object
    },
    components: {
        LayoutDashboard,
        ResponsibleLabel,
        ButtonSurvey,
        Card,
        CarrouselCards
    }
}
</script>
