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
        <div class="form-group">
            <label>Cantidad</label>
            <div class="d-flex justify-content-between">
                <h5>Adulto:</h5>
                <span class="pr-4">
                    <button class="button_quanity" @click.prevent="quantity.adult+=1">+</button>
                        <input type="number" class="person-input" min="0" v-model="quantity.adult">
                    <button class="button_quanity" @click.prevent="quantity.adult-=1"
                            :disabled="quantity.adult <= 1">-</button>
                </span>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <h5>3 a 11 años:</h5>
                <span class="pr-4">
                    <button class="button_quanity" @click.prevent="quantity.boy+=1">+</button>
                        <input type="number" class="person-input" v-model="quantity.boy">
                    <button class="button_quanity" @click.prevent="quantity.boy-=1"
                            :disabled="quantity.boy <= 0">-</button>
                </span>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <h5>0 a 2 años:</h5>
                <span class="pr-4">
                    <button class="button_quanity" @click.prevent="quantity.bebe+=1">+</button>
                        <input type="number" class="person-input" :min="0" v-model="quantity.bebe">
                    <button class="button_quanity" @click.prevent="quantity.bebe-=1"
                            :disabled="quantity.bebe <= 0">-</button>
                </span>
            </div>
        </div>
        <div class="form-group mb-0">
            <button role="button" class="btn btn-primary btn-block"
                    @click.prevent="loadBooking()">Cargar
            </button>
        </div>
        <div class="modal fade" id="modalStorage" tabindex="-1" role="dialog" aria-labelledby="modalStorageLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalStorageLabel"><h4>Rellena los siguientes datos</h4></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger pb-0" id="alert-error" role="alert" v-show="errors.length">
                            <b>Por favor corriga los siguientes errores:</b>
                            <ul>
                                <li v-for="(error, index) in errors" :key="index">{{ error.error }}</li>
                            </ul>
                        </div>
                        <div v-for="(person, index) in persons" :key="index" class="row">
                            <div class="form-group col-6">
                                <label>Nombre persona {{ index + 1 }}</label>
                                <input type="text" class="form-control" v-model="inputs[index].name"
                                       required>
                            </div>
                            <div class="form-group col-6">
                                <label>Apellido de la persona {{ index + 1 }}</label>
                                <input type="text" class="form-control" v-model="inputs[index].lastName"
                                       required>
                            </div>
                        </div>
                        <hr>
                        <h5>Reserva viaje para {{ tour.name }}</h5>
                        <p class="lead">Dia : {{ date }}</p>
                        <p class="lead">{{ persons }} x {{ tour.amount }}</p>
                        <p class="lead">Total : {{ total }} $</p>
                    </div>
                    <div class="modal-footer d-flex align-items-end">
                        <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary w-25" @click.prevent="storeLocal">Reservar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {es} from 'vuejs-datepicker/dist/locale'
import moment from "moment";

export default {
    components: {
        Datepicker
    },
    props: ['tour'],
    data() {
        return {
            date: new Date(),
            quantity: {adult: 1, boy: 0, bebe: 0},
            amount: 0,
            es: es,
            persons: 0,
            inputs: [],
            total: 0,
            errors: [],
        }
    },
    methods: {
        loadBooking() {
            this.date = this.formatDate;
            this.persons = Number(this.quantity.adult) + Number(this.quantity.boy) + Number(this.quantity.bebe);
            this.total = Number(this.tour.amount) * this.persons;
            for (let i = 0; i < this.persons; i++) {
                this.inputs.push({name: '', lastName: ''})
            }
            $("#modalStorage").modal('show');
        },
        storeLocal() {
            this.errors = [];
            for (let i = 0; i < this.persons; i++) {
                if (this.inputs[i].name === "" || /^\s+$/.test(this.inputs[i].name)) {
                    this.errors.push({error: 'llene el campo de nombre'})
                }
                if (this.inputs[i].lastName === "" || /^\s+$/.test(this.inputs[i].lastName)) {
                    this.errors.push({error: 'llene el campo de apellido'})
                }
            }
            if (this.date <= moment(new Date()).format('YYYY-MM-D')) {
                this.errors.push({error: 'la fecha no puede ser menor a la de hoy'})
            }
            if (this.errors.length === 0) {
                localStorage.setItem('inputs', JSON.stringify(this.inputs));
                localStorage.setItem('date', this.date);
                localStorage.setItem('tour', JSON.stringify(this.tour));
                location.href = "/home"
            }
        }
    },
    computed: {
        formatDate() {
            return moment(this.date).format('YYYY-MM-D')
        },
    }
}
</script>

<style>
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
}

.person-input {
    background: none !important;
    text-align: center !important;
    width: 30px !important;
    outline: none !important;
    border: none !important;
    color: #777 !important;
    padding: 0 !important;
    display: inline !important;
}

.button_quanity {
    height: 28px;
    width: 28px;
    background: #fff;
    border: 2px solid #268fc7;
    color: #268fc7;
    font-size: 15px;
    margin: 0 7px;
}


.vdp-datepicker__calendar {
    position: relative !important;
    width: 100% !important;
}

.vdp-datepicker__calendar .cell.selected {
    color: white;
    background: #268fc7 !important;
}
</style>
