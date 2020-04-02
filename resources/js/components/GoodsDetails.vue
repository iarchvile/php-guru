<template>
    <div class="container">

        <div v-if="loading" class="loading">
            Загрузка...
        </div>

        <div v-if="error" class="error">
            {{ error }}
        </div>

        <template v-if="data">
            <div class="py-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <router-link to="/">Home</router-link>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ data.name }}</li>
                    </ol>
                </nav>
            </div>

            <div class="card">
                <div class="row">
                    <aside class="col-sm-5 border-right">
                        <article class="gallery-wrap">
                            <div class="img-big-wrap">
                                <img width="100%" :src="currentImg">
                            </div>
                            <hr>
                            <div class="d-flex img-small-wrap">
                                <template v-for="item in data.photos">
                                    <div @click="currImg = item" class="item-gallery p-1"><img height="75" :src="item"></div>
                                </template>
                            </div>
                        </article>
                    </aside>
                    <aside class="col-sm-7">
                        <article class="card-body p-5">
                            <h3 class="title mb-3">{{ data.name }}</h3>

                            <p class="price-detail-wrap">
                            <span class="price h3">
                                <span class="currency">US $</span><span class="num">{{ data.price | withSpaces }}</span>
                            </span>
                            </p>
                            <dl class="item-property">
                                <dt>Description</dt>
                                <dd><p>{{ data.description }}</p></dd>
                            </dl>

                            <hr>

                            <div class="text-right">
                                <a href="#" @click.prevent="goEdit(data.id)" class="btn btn-primary">edit</a>
                            </div>


                        </article>
                    </aside>
                </div>
            </div>
        </template>



    </div>
</template>

<script>
    export default {
        name: "GoodsDetails",
        data() {
            return {
                loading: false,
                data: null,
                error: null,
                currImg: null
            }
        },
        created() {
            this.fetchData()
        },
        watch: {
            $route: 'fetchData'
        },
        methods: {
            onThumpClick(id) {
                this.$router.push({name: 'edit', params: {id: id}})
            },
            goEdit(id) {
                this.$router.push({name: 'edit', params: {id: id}})
            },
            fetchData() {
                this.error = this.data = null;
                this.loading = true;

                var
                    $this = this;

                axios.get('/api/goods/' + this.$route.params.id + '?fields=photos,description,id')
                    .then(function (response) {
                        $this.loading = false;
                        $this.data = response.data.data;

                    }).catch(function (error) {
                    console.log(error);
                });

            }
        },
        computed: {
            currentImg:
                {
                    get: function () {
                        return this.$data.currImg ? this.$data.currImg : this.$data.data.photos[0];
                    },
                    set: function (img) {
                        this.$data.currImg = img;
                    }
                }
        }
    }
</script>

<style scoped>

    .item-gallery {
        cursor: pointer;
        border: 2px solid transparent;
    }

    .item-gallery:hover {
        border: 2px solid orange;
    }

</style>
