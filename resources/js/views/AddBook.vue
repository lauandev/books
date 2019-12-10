<style>
    .shadow{
        text-align: center;
        padding: 20px;
        box-shadow: 1px 2px 2px 2px #2b2b2b47;
    }
</style>


<template>
    <div class="AddBook">
        <h2 class="shadow">Add book</h2>
        <div class="shadow col-md-12">
            <form @submit.prevent="onSubmit" class="offset-md-3 col-md-6">
                <ValidationProvider name="title" rules="required" v-slot="{ errors }" >
                    <input v-model="title" class="form-control" type="text" id="title" placeholder="Title">
                    <p>{{ errors[0] }}</p>
                </ValidationProvider>
                <ValidationProvider name="authors" rules="required" v-slot="{ errors }">
                    <input v-model="authors" class="form-control" type="text" id="authors" placeholder="Authors">
                    <p>{{ errors[0] }}</p>
                </ValidationProvider>
                <ValidationProvider name="preface" rules="required" v-slot="{ errors }">
                    <textarea v-model="preface" class="form-control" type="text" id="preface" placeholder="Preface"></textarea>
                    <p>{{ errors[0] }}</p>
                </ValidationProvider>
                <ValidationProvider name="language" rules="required" v-slot="{ errors }">
                    <input v-model="language" class="form-control" type="text" id="language" placeholder="Language">
                    <p>{{ errors[0] }}</p>
                </ValidationProvider>
                <button class="btn btn-primary" type="submit">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
    import { extend } from 'vee-validate';
    import { ValidationProvider } from 'vee-validate';
    import Cookies from 'js-cookie';

    extend('required', {
        validate: value => value.length > 0,
        message: 'This is not the magic word'
    });

    export default {
        data() {
            return {
                title: '',
                image: '',
                authors: '',
                preface: '',
                language: '',
                tags: ''
            }
        },
        methods: {
            onSubmit() {
                const data = {
                    ...this.$data
                };

                this.axios.get('/api/book', {
                    headers: {
                        Authorization: 'Bearer ' + Cookies.get('token')
                    }
                })
                .then(response => {
                    console.log(response);
                    this.data = response.data.data;
                }).catch(error => {

                })
            },
        },
        components:{
            ValidationProvider
        }
    };
</script>
