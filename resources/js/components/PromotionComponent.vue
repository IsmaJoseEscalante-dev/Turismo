<template>
    <div class="container">
        <div class="form-group">
            <h5 class="text-principal font-weight-bold">Dia de reserva</h5>
            <select class="form-control" v-model="selected">
                <option v-for="(option, index) in daysOfYear" :key="index">{{ option }}</option>
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
            let dateStart = new Date(this.model.date_start);
            dateStart.setDate(dateStart.getDate() + 1)
            let dateFinish = new Date(this.model.date_finish)
            dateFinish.setDate(dateFinish.getDate() + 1)
            console.log(dateStart)
            for (let d = dateStart; d <= dateFinish; d.setDate(d.getDate() + 1)) {
                this.daysOfYear.push(moment(d).format('YYYY-MM-D'));
            }
            this.selected = this.daysOfYear[0]
        }
    }
}
</script>
