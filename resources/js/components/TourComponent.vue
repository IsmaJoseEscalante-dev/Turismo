<template>
    <div class="container">
        <div class="form-group">
            <label>Dia de reserva</label>
            <datepicker
                type="date"
                :language="es"
                :inline="true"
                :format="formatDate"
                v-model="date"
            ></datepicker>
        </div>
        <booking-component :model="model" :cartable_type="'App\\Models\\Tour'" :date="formatDate"></booking-component>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {es} from 'vuejs-datepicker/dist/locale'
import moment from "moment";

export default {
    components: {
        Datepicker,
    },
    props: ['model'],
    data() {
        return {
            date: new Date(),
            es: es,
        }
    },
    computed: {
        formatDate() {
            return moment(this.date).format('YYYY-MM-D')
        },
    }
}
</script>
