<template>
    <div class="my-3">
        <template v-if="!page">
            <div class="card">
                <div class="card-body">
                    <h4>No hay ninguna reserva por agregar</h4>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="alert alert-danger pb-0" id="alert-error" role="alert" v-show="errors.lenght">
                <b>Por favor corriga los siguientes errores:</b>
                <ul>
                    <li v-for="(error, index) in errors" :key="index">{{ error[0] }}</li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4>Rellena los siguientes datos</h4>
                            <div v-for="(person, index) in persons" :key="index" class="row">
                                <div class="form-group col-md-6">
                                    <label>Nombre persona {{ index + 1 }}</label>
                                    <input type="text" class="form-control" v-model="inputs[index].name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Apellido de la persona {{ index + 1 }}</label>
                                    <input type="text" class="form-control" v-model="inputs[index].lastName" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Reserva viaje para {{ tour.name }}</h4>
                            <p class="lead">Dia : {{ date }}</p>
                            <p class="lead">{{ persons }} x {{ tour.amount }}</p>
                            <p class="lead">Total : {{ total }}$</p>
                            <div class="form-group mb-0 mt-3">
                                <a @click.prevent="storeBooking"
                                   class="btn btn-block btn-primary cho-container">Reservar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>
<script>
export default {
    mounted() {
        this.getTour()
    },
    props: ['user'],
    data() {
        return {
            date: '',
            quantity: {},
            persons: 0,
            total: 0,
            inputs: [],
            tour: {},
            errors: [],
            page: false,
        }
    },
    methods: {
        async getTour() {
            if (localStorage.getItem('id')) {
                await axios.get('/api/tour/' + localStorage.getItem('id'))
                    .then((res) => {
                        this.tour = res.data;
                        this.getBooking()
                    })
                    .catch((e) => {
                        this.errors = e.data.errors;
                    })
            }
        },
        getBooking() {
            if (localStorage.getItem('date')) {
                this.page = true;
                this.date = localStorage.getItem('date');
                this.quantity = JSON.parse(localStorage.getItem('quantity'))
                this.persons = Number(this.quantity.adult) + Number(this.quantity.boy) + Number(this.quantity.bebe);
                this.total = Number(this.tour.amount) * this.persons;
                for (let i = 0; i < this.persons; i++) {
                    this.inputs.push({name: '', lastName: ''})
                }
            }
        },
        async storeBooking() {
            if (this.user != null) {
                await axios.post('/api/booking', {
                    names: this.inputs,
                    total: this.total,
                    date: this.date,
                    user_id: this.user,
                    tour_id: this.tour.id
                })
                    .then(() => {
                        localStorage.removeItem('date');
                        localStorage.removeItem('id');
                        localStorage.removeItem('quantity');
                        location.href = "home"
                    })
                    .catch((e) => {
                        this.errors = e.response.data.errors;
                        document.getElementById('alert-error').style.display = "block"
                    });
            } else {
                location.href = "register"
            }
        },
        validateSpaces(value) {
            let patron = /^\s+$/;
            return !patron.test(value);
        },
    }
}
</script>
