<template>
    <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">dfasdfas</h5>
                    <button type="button" class="close btn btn-light" @click.prevent="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img v-if="image.image"
                         :src=" nameImage "
                         alt="image project"
                         class="img-fluid d-block mx-auto"
                         style="height: 320px !important;"
                    >
                    <button type="button" class="btn btn-primary px-4" @click.prevent="closeModal()">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['image'],
    methods: {
        closeModal() {
            $('#modalShow').modal('hide')
        },
    },
    computed: {
        nameImage() {
            return '/storage/' + (this.image.image.slice(6))
        },
    }
}
</script>
