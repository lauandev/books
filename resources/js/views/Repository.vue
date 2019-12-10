<style>
    .shadow{
        text-align: center;
        padding: 20px;
        box-shadow: 1px 2px 2px 2px #2b2b2b47;
    }
</style>

<template>
    <div class="container">
        <h2 class="shadow">Repository</h2>
        <div class="shadow col-md-12">
            <BoxMyBooks></BoxMyBooks>
        </div>
    </div>
</template>

<script>
    import BoxMyBooks from '@/js/components/BoxMyBooks';
    import Cookies from 'js-cookie';

    export default {
        components: {
            BoxMyBooks
        },
        mounted() {
            if(!Cookies.get('token')){
                $this.$router.push({name: login});
            }
        }
    }
</script>
