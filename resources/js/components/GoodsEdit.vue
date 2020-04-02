<template>

    <div class="container" v-if="data">

        <div class="py-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link to="/">Home</router-link>
                    </li>

                    <li class="breadcrumb-item">
                        <router-link :to="{ name: 'details', params: { id: data.id }}">{{ data.name }}</router-link>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">edit</li>
                </ol>
            </nav>
        </div>

        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" v-model="data.name" class="form-control" id="name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="description">Description</label>
                    <textarea rows="7" v-model="data.description" class="form-control" id="description"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" min="1" max="999999999.99" v-model="data.price" class="form-control" id="price">
                </div>
            </div>
            <template v-for="(item, index) in data.photos">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label :for="'photo-'+index">{{index + 1}} photo</label>
                        <input type="text" v-model="data.photos[index]" class="form-control" :id="'photo-'+index">
                    </div>
                </div>
            </template>

            <button @click.prevent="sendForm()" type="submit" class="btn btn-primary">update</button>
            <button @click.prevent="goToDetail(data.id)" type="submit" class="btn btn-outline-info">cansel</button>
        </form>

        <div v-if="loading" class="loading py-3">
            Загрузка...
        </div>

        <div v-if="error" class="error">
            {{ error }}
        </div>


    </div>
</template>

<script>
    export default {
        name: "GoodsEdit",
        data() {
            return {
                loading: false,
                data: null,
                error: null
            }
        },
        created() {
            this.fetchData()
        },
        watch: {
            $route: 'fetchData'
        },
        methods: {
            goToDetail(id) {
                this.$router.push({name: 'details', params: {id: id}})
            },
            sendForm() {

                const $this = this;

                this.data.photos = this.data.photos.filter(function (i) {
                    return i.length > 0;
                });

                this.error = null;
                this.loading = true;

                axios({
                    method: 'put',
                    url: '/api/goods/' + this.$route.params.id,
                    data: {
                        'name': this.data.name,
                        'description': this.data.description,
                        'price': this.data.price,
                        'photos': this.data.photos
                    },
                })
                    .then(function (response) {
                        $this.fetchData();
                        console.log(response);
                        $this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                        $this.error = error;
                    });

            },
            fetchData() {
                this.error = this.data = null;
                this.loading = true;

                var
                    $this = this;

                axios.get('/api/goods/' + this.$route.params.id + '?fields=photos,description,id').then(function (response) {
                    $this.loading = false;
                    $this.data = response.data.data;

                    $this.data.photos = _.merge(new Array(3).fill(''), $this.data.photos);

                }).catch(function (error) {
                    console.log(error);
                    $this.error = error;
                });

            }
        }
    }
</script>

<style scoped>

</style>
