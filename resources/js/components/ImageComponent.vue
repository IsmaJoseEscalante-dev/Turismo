<template>
    <div class="row justify-content-center">

        <div class="modal fade" id="modalStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">Create new image</h5>
                        <button type="button" class="close btn btn-light" @click.prevent="closeModal('#modalStore')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="storeImage()" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" @change="getImage">
                                    <label class="custom-file-label">seleccionar imagen</label>
                                </div>
                                <span v-if="errors.image" class="text-danger">{{ errors.image[0] }}</span>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card-body">
                <div class=" d-flex justify-content-between align-items-center">
                    <h4 class="text-muted">Images</h4>
                    <button type="button" class="btn btn-success btn-sm" id="storeModal"
                            @click.prevent="createImage()">
                        + Create
                    </button>
                </div>
                <div class="row">
                    <div class="col-6 col-md-4 col-lg-3 shadow mb-4"
                         v-for="(image, index) in images"
                         :key="index">
                        <a  class="item-wrap fancybox">
                            <div class="work-info">
                                <img class="img-fluid" width="300px" :src="/storage/+image.image.slice(6)">
                                <span>
                                    <a class="btn btn-light" role="button" @click.prevent="showImage(image)">
                                        Show
                                    </a>
                                    <a class="btn btn-danger" role="button" @click.prevent="deleteImage(image,index)">
                                        Eliminar
                                    </a>
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
                <show-image-component
                    :image="{id:image.id, image:image.image}"
                >
                </show-image-component>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props:[
        'station'
    ],
    mounted() {
        this.getImages();
    },
    data() {
        return {
            images: [],
            image: {id:'',image:''},
            errors: []
        }
    },
    methods: {
        async getImages() {
            await axios.get('/api/images/'+this.station)
                .then((res) => {
                    this.images = res.data;
                }).catch((e) => {
                    console.log(e.data)
                })
        },
        getImage(e) {
            let file = e.target.files[0];
            this.image.image = file;
        },
        createImage() {
            this.image = {}
            $('#modalStore').modal('show')
        },
        async storeImage() {
            let formData = new FormData();
            formData.append('image', this.image.image)
            await axios.post('/api/storeStation/'+this.station, formData)
                .then(() => {
                    this.getImages()
                    this.image = {image:''}
                    this.errors = []
                    $('#modalStore').modal('hide')
                }).catch(error => {
                    this.errors = error.response.data.errors;
                })
        },
        closeModal(name) {
            $(name).modal('hide')
        },
        showImage(image) {
            this.image.id = image.id
            this.image.image = image.image
            $('#modalShow').modal('show')
        },
        async deleteImage(image, index) {
            await axios.delete('/api/deleteStation/' + image.id)
                .then(() => {
                    this.images.splice(index, 1);
                }).catch((e) => {
                    console.log(e.data)
                })
        }
    },
}
</script>
