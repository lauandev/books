<template>
</template>

<script>
    import store from '../stores'
    import Cookies from 'js-cookie';

    export default {
        create () {
            Cookies.set('token', '');
            store.commit('logoutUser');
            this.$router.push({ name: 'login' });
        }
    }
</script>
