<template>
    <div class="container">
        <div class="form-group">
            <label>Dia de reserva</label>
            <h5>fecha de inicio: {{ formatDate(model.start) }}</h5>
            <h5>fecha de llegada: {{ formatDate(model.end) }}</h5>
        </div>
        <booking-component :model="model" :cartable_type="'App\\Models\\Event'" :date="formatDate(model.start)"></booking-component>
    </div>
</template>

<script>
import moment from "moment";

export default {
    props: ['model'],
    data() {
        return {
            date: new Date(),
        }
    },
    methods: {
        formatDate(date) {
            return moment(date).format('YYYY-MM-D')
        },
    }
}
</script>
