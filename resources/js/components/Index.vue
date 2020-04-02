<template>
    <div class="container">

        <div class=" py-3">
            <div v-if="loading" class="loading">
                Загрузка...
            </div>

            <div v-if="error" class="error">
                {{ error }}
            </div>
        </div>

        <template v-if="data">

            <router-link class="btn btn-sm btn-success" to="/create">Add +</router-link>


            <div class="text-lg-center">
                <div class="form-group col-sm-2 offset-md-10">
                    <label for="order">Order by</label>
                    <select class="form-control" id="order" v-model="order" @change="fetchData">
                        <option v-for="option in options" v-bind:value="option.value">
                            {{ option.text }}
                        </option>
                    </select>
                </div>
            </div>

            <p class="text-lg-center py-3">
                <a v-if="current_page > 1" class=""
                   @click.prevent="goToPage(current_page-1)" href="#">prev</a>

                <template v-for="page in last_page">
                    <span v-if="current_page === page" class="p-1 h5">[{{page}}]</span>
                    <a class="p-1" v-else @click.prevent="goToPage(page)" href="#">[{{page}}]</a>
                </template>

                <a v-if="current_page < last_page" class=""
                   @click.prevent="goToPage(current_page+1)" href="#">next</a>
            </p>

            <div class="album bg-light">
                <div class="container">

                    <div class="row">

                        <div class="col-md-4" v-for="item in data">
                            <div class="card mb-4 shadow-sm">
                                <a @click.prevent="goToDetail(item.id)" href="#">
                                    <img width="338" height="240" :src="item.photo" alt="">
                                </a>
                                <div class="card-body">
                                    <p>
                                        <a @click.prevent="goToDetail(item.id)" href="#">{{item.name}}</a>
                                    </p>
                                    <p class="card-text">{{item.description}}</p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-lg">${{item.price | withSpaces}}</div>
                                        <small class="text-muted">{{item.created_at | formatDate}}</small>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <p class="text-lg-center py-3">
                <a v-if="current_page > 1" class=""
                   @click.prevent="goToPage(current_page--)" href="#">prev</a>

                <template v-for="page in last_page">
                    <span v-if="current_page === page" class="p-1 h5">[{{page}}]</span>
                    <a class="p-1" v-else @click.prevent="goToPage(page)" href="#">[{{page}}]</a>
                </template>

                <a v-if="current_page < last_page" class=""
                   @click.prevent="goToPage(current_page++)" href="#">next</a>
            </p>
        </template>


    </div>
</template>

<script>
    export default {
        name: "Index",
        data() {
            return {
                loading: false,
                data: null,
                error: null,
                current_page: 1,
                last_page: 1,
                order: null,
                options: [
                    {text: '', value: null},
                    {text: 'Price up', value: 'price,asc'},
                    {text: 'Price down', value: 'price,desc'},
                    {text: 'Name up', value: 'name,asc'},
                    {text: 'Name down', value: 'name,desc'}
                ]
            }
        },
        created() {
            this.current_page = this.$route.query.page ?? 1;
            this.fetchData()
        },
        watch: {
            $route: 'fetchData'
        },
        methods: {
            goToDetail(id) {
                this.$router.push({name: 'details', params: {id: id}})
            },
            goToPage(page) {
                this.current_page = page;
                this.$router.push({name: 'index', query: {page: page}})
            },
            fetchData() {

                this.error = this.data = null;
                this.loading = true;

                var
                    $this = this;

                axios.get('/api/goods?per_page=9&fields=id,description,price&page=' +
                    this.current_page + (this.order ? '&order=' + this.order : ''))
                    .then(function (response) {
                        $this.loading = false;
                        $this.data = response.data.data;

                        $this.current_page = response.data.meta.current_page;
                        $this.last_page = response.data.meta.last_page;

                    }).catch(function (error) {
                    console.log(error);
                });

            }
        }
    }
</script>

<style scoped>

</style>
