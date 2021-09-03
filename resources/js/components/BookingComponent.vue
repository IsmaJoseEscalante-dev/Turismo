<template>
    <div>
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
                        <button type="button" class="close" @click.prevent="closeModal('#modalStorage')">
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
                        <h5>Reserva viaje para {{ model.name }}</h5>
                        <p class="lead">Dia : {{ formatDate }}</p>
                        <p class="lead">{{ persons }} x {{ model.amount }}</p>
                        <p class="lead">Total : {{ total }} $</p>
                    </div>
                    <div class="modal-footer d-flex align-items-end">
                        <button @click.prevent="closeModal('#modalStorage')" class="btn btn-secondary">Close</button>
                        <button class="btn btn-primary" @click.prevent="storeLocal">Reservar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    props: ['model','date','cartable_type'],
    data() {
        return {
            quantity: {adult: 1, boy: 0, bebe: 0},
            amount: 0,
            persons: 0,
            inputs: [],
            total: 0,
            errors: [],
        }
    },
    methods: {
        closeModal(id){
            this.errors = []
            $(id).modal("hide");
        },
        loadBooking() {
            this.persons = Number(this.quantity.adult) + Number(this.quantity.boy) + Number(this.quantity.bebe);
            this.total = Number(this.model.amount) * this.persons;
            for (let i = 0; i < this.persons; i++) {
                this.inputs.push({name: '', lastName: ''})
            }
            $("#modalStorage").modal('show');
        },
        storeLocal() {
            this.errors = [];
            let fech = this.date.split("-")
            let a = new Date()
            let m = new Date()
            let d = new Date()
            for (let i = 0; i < this.persons; i++) {
                if (this.inputs[i].name === "" || /^\s+$/.test(this.inputs[i].name)) {
                    this.errors.push({error: 'llene el campo de nombre'})
                }
                if (this.inputs[i].lastName === "" || /^\s+$/.test(this.inputs[i].lastName)) {
                    this.errors.push({error: 'llene el campo de apellido'})
                }
            }
            if (new Date(fech[0],fech[1],fech[2]) <= new Date(a.getFullYear(),(m.getMonth() +1), d.getDate())) {
                this.errors.push({error: 'la fecha no puede ser menor a la de hoy'})
            }
            if (this.errors.length === 0) {
                localStorage.setItem('inputs', JSON.stringify(this.inputs));
                localStorage.setItem('date', this.date);
                localStorage.setItem('cartable_type',JSON.stringify(this.cartable_type));
                localStorage.setItem('model', JSON.stringify(this.model));
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
    color: #14505C !important;
    padding: 0 !important;
    display: inline !important;
}

.button_quanity {
    height: 28px;
    width: 28px;
    background: #fff;
    border: 2px solid #14505C;
    color: #14505C;
    font-size: 15px;
    margin: 0 7px;
}


.vdp-datepicker__calendar {
    position: relative !important;
    width: 100% !important;
}

.vdp-datepicker__calendar .cell.selected {
    color: white;
    background: #14505C !important;
}
.vdp-datepicker__calendar .cell:hover{
   border: 1px solid #14505C !important;
}
</style>
