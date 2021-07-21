<template>
    <div>
        <div class="form-group">
            <label>Dia de reserva</label>
            <input type="text" v-model="date" class="form-control">
        </div>
        <div class="form-group">
            <label>Cantidad</label>
            <input type="text" class="form-control" v-model="quantity">
        </div>
        <div class="form-group">
            <a @click.prevent="storeBooking()" class="btn btn-primary btn-block">Reservar</a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            date: '',
            quantity: ''
        }
    },
    methods: {
        storeBooking() {
            localStorage.setItem('date', this.date);
            localStorage.setItem('quantity', this.quantity);
            window.location="/booking";
        }
    }
}
</script>
