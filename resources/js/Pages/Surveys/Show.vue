<template>
    <LayoutDashboard>


        <h3>Enquete de id {{survey.id}}</h3>





    </LayoutDashboard>
</template>


<script>
import LayoutDashboard from '../../components/LayoutDashboard.vue';

export default {
    props: {
        survey: Object
    },
    components: {
        LayoutDashboard
    }
}
</script>
