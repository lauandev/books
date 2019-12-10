<template>
    <div class="App">
        <Navbar></Navbar>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import store from '../stores';
    import Navbar from '@/js/components/Navbar';
    import Cookies from 'js-cookie';

    export default {
        created() {
            if(Cookies.get('token')){
                this.axios.get('/api/user', {
                        headers: {
                            Authorization: 'Bearer ' + Cookies.get('token')
                        }
                    },
                ).then(response => {
                    store.commit('loginUser')
                }).catch(error => {
                    if (error.response.status === 401 || error.response.status === 403) {
                        store.commit('logoutUser');
                        Cookies.set('token', '');
                        this.$router.push({name: 'login'});
                    }
                });
            }
        },
        components: {
            Navbar
        }
    }
</script>
