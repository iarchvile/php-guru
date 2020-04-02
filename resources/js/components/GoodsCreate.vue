<template>

    <div class="container">

        <div class="py-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link to="/">Home</router-link>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">create</li>
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

            <button @click.prevent="sendForm()" type="submit" class="btn btn-primary">create</button>
            <button @click.prevent="goToIndex()" type="submit" class="btn btn-outline-info">cansel</button>
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
                data: {
                    'name': null,
                    'description': null,
                    'price': null,
                    'photos': [
                        [], [], []
                    ]
                },
                error: null
            }
        },
        methods: {
            goToIndex() {
                this.$router.push({name: 'index'})
            },
            sendForm() {

                const $this = this,
                    photos = this.data.photos.filter(function (i) {
                        return i.length > 0;
                    });

                this.error = null;
                this.loading = true;

                axios({
                    method: 'post',
                    url: '/api/goods/',
                    data: {
                        'name': this.data.name,
                        'description': this.data.description,
                        'price': this.data.price,
                        'photos': photos
                    },
                })
                    .then(function (response) {
                        $this.goToIndex();
                    })
                    .catch(function (error) {
                        console.log(error);
                        $this.error = error;
                    });

            },
        }
    }
</script>

<style scoped>

</style>
