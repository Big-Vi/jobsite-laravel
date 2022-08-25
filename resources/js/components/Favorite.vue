<template>
<span>
        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(job)">
            <i  class="fa fa-heart"></i>
        </a>
        <a href="#" v-else @click.prevent="favorite(job)">
            <i  class="fa fa-heart-o"></i>
        </a>
</span>
</template>

<script>
export default {
    props: ['job', 'favorited'],
    name: 'favorite',
    data() {
        return {
            isFavorited: ''
        }
    },
    mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },
    methods: {
        unFavorite(job) {
            axios.post('/unfavorite/'+job)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
        },
        favorite(job) {
            axios.post('/favorite/'+job)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
        }
    }
}
</script>