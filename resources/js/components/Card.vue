<template>
    <div class="p-4 min-w-[300px] max-w-[300px]">
        <div class="h-full bg-gray-100 bg-opacity-75 rounded-lg overflow-hidden">
            <div class="flex flex-row justify-between px-4 pt-8">
                <div class="flex flex-col space-y-2">
                    <inertia-link :href="'/enquetes/' + id + '/edit'">
                        <button
                            class="p-2 border border-primary rounded-lg text-primary hover:text-white hover:bg-primary text-xs">
                            editar enquete
                        </button>
                    </inertia-link>
                    <inertia-link :href="'/options/' + id + '/edit'">
                        <button
                            class="p-2 border border-primary rounded-lg text-primary hover:text-white hover:bg-primary text-xs">
                            editar opções
                        </button>
                    </inertia-link>
                </div>
                <button v-on:click="deleteSubmit()" type="button"
                    class="w-10 h-10 p-2 border border-primary rounded-full text-primary hover:text-white hover:bg-primary text-xs">
                    X
                </button>
            </div>

            <div class="h-full px-8 py-32 rounded-lg overflow-hidden text-center relative">
                <h2 class="tracking-widest text-xs font-medium text-gray-400 mb-1">ENQUETE</h2>
                <h1 class="sm:text-2xl text-xl font-medium text-gray-900 mb-3 py-3 overflow-x-auto whitespace-nowrap">{{
                        title
                }}</h1>
                <button type="button"
                    class="relative mt-10 text-primary inline-flex items-center p-2 border border-primary cursor-pointer hover:text-white hover:bg-primary transition-all">
                    <inertia-link :href="'/enquetes/' + id">Votar na Enquete</inertia-link>
                </button>
                <div class="text-center mt-2 leading-none flex justify-center absolute bottom-0 left-0 w-full p-4">
                    <span class="font-semibold text-xs text-primary"> {{ dateFormatter(start_date) }} até as {{
                            dateFormatter(end_date)
                    }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
import { Inertia } from '@inertiajs/inertia'

export default {
    props: {
        id: Number,
        title: String,
        start_date: String,
        end_date: String,
    },

    data(props) {
        return {
            id: props.id
        };
    },
    methods: {
        dateFormatter: (date) => moment(date).format('DD/MM/YY H:m'),

        deleteSubmit: function () {
            Inertia.delete(`/enquetes/${this.id}`);
        }
    }
}

</script>
