<template>
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card mb-2" v-for="(comment,index) in comments" :key="index">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5><b>{{ comment.name }}</b>
                            <span id="sss" v-html="setStart(comment.points)"></span>
                        </h5>
                        <h6><i class="fas fa-clock"></i> {{ getDate(comment.created_at) }}</h6>
                    </div>
                    <p class="lead">{{ comment.body }}</p>
                </div>
            </div>
            <div v-show="alert" id="alert" class="alert alert-success">Su comentario fue enviado al administrador del sitio donde será <b>revisado</b> y <b>publicado</b></div>
            <form @submit.prevent="storeComment">
                <div class="rating-box col-md-6">
                    <div class="rating-container">
                        <input v-model="comment.points" type="radio" class="starts" name="rating" value="5" id="star-5">
                        <label
                            for="star-5">&#9733;</label>

                        <input v-model="comment.points" type="radio" class="starts" name="rating" value="4" id="star-4">
                        <label
                            for="star-4">&#9733;</label>

                        <input v-model="comment.points" type="radio" class="starts" name="rating" value="3" id="star-3">
                        <label
                            for="star-3">&#9733;</label>

                        <input v-model="comment.points" type="radio" class="starts" name="rating" value="2" id="star-2">
                        <label
                            for="star-2">&#9733;</label>

                        <input v-model="comment.points" type="radio" class="starts" name="rating" value="1" id="star-1">
                        <label
                            for="star-1">&#9733;</label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <input v-model="comment.name" type="text" class="form-control border-0" style="background: #eaeaea"
                           placeholder="Nombre *">
                </div>
                <div class="form-group col-md-6">
                    <input v-model="comment.email" type="email" class="form-control border-0"
                           style="background: #eaeaea"
                           placeholder="Correo electrónico *">
                </div>
                <div class="form-group col-md-8">
                    <textarea v-model="comment.body" type="text" class="form-control border-0"
                              style="background: #eaeaea" placeholder="Tu reseña *" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Comentar">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    props: ['tour'],
    mounted() {
        this.getComments();
    },
    data() {
        return {
            alert:false,
            comments: [],
            comment: {name: '', body: '', points: 0, email: ''}
        }
    },
    methods: {
        getDate(date){
            return moment(date).format('DD/MM/YYYY HH:mm')
        },
        async getComments() {
            await axios.get('/api/comments/' + this.tour)
                .then(res => {
                    this.comments = res.data;
                })
                .catch((e) => {
                    console.log(e.data)
                })
        },
        async storeComment() {
            await axios.post('/comments', {
                name: this.comment.name,
                body: this.comment.body,
                email: this.comment.email,
                points: Number(this.comment.points),
                tour_id: this.tour
            })
                .then(() => {
                    this.getComments()
                    this.comment.name = "";
                    this.comment.email = "";
                    this.comment.body = "";
                    this.comment.points = 0;

                    document.getElementById("alert").style.display = "block";
                    document.getElementsByClassName("starts").style.color = "transparent"
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        setStart(start){
            let starses ="";
            for (let i = 0; i < 5; i++) {
                starses += i < start
                    ? "<span><i class='fas fa-star color-start'></i></span>"
                    :"<span><i class='far fa-star color-start'></i></span>";
            }
            return starses;
        }
    },
    computed:{

    }
}
</script>
<style>
.lead {
    margin-bottom: 0;
}

.rating-box {
    display: inline-block;
}

.rating-box .rating-container {
    direction: rtl !important;
}

.rating-box .rating-container label {
    display: inline-block;
    margin: -10px 0;
    color: #d4d4d4;
    cursor: pointer;
    font-size: 37px;
    transition: color 0.2s;
}

.rating-box .rating-container input {
    display: none;
}

.rating-box .rating-container label:hover, .rating-box .rating-container label:hover ~ label, .rating-box .rating-container input:checked ~ label {
    color: gold;
}
.color-start{
    color: darkgoldenrod;
}
</style>
