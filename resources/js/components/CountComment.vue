<template>
    <span class="badge badge-danger">{{ countComment() }}</span>
</template>

<script>
export default {
    mounted() {
        this.getComment()
    },
    data() {
        return {
            comment: 0
        }
    },
    methods: {
        async getComment() {
            await axios.get('/api/comment-count')
                .then(res => {
                    this.comment = res.data;
                })
                .catch((e) => {
                    console.log(e.data)
                })
        },
        countComment(){
            this.comment= this.comment > 0 ? this.comment:""
            return this.comment;
        }
    }
}
</script>

