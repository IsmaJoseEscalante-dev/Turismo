<template>
    <div class="container">
        <div class="form-group">
            <label>Dia de reserva</label>
            <select class="form-control" v-model="selected">
                <option v-for="option in daysOfYear">{{ option }}</option>
            </select>
        </div>
        <booking-component :model="model" :cartable_type="'App\\Models\\Promotion'" :date="selected"></booking-component>
    </div>
</template>

<script>
import moment from "moment";

export default {
    props: ['model'],
    mounted() {
        this.fillSelect()
    },
    data() {
        return {
            date: new Date(),
            daysOfYear:[],
            selected:0
        }
    },
    methods:{
        fillSelect(){
            for (let d = new Date(this.model.date_start); d <= new Date(this.model.date_finish); d.setDate(d.getDate() + 1)) {
                this.daysOfYear.push(moment(d).format('YYYY-MM-D'));
            }
        }
    }
}
</script>
