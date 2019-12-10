<style>
    .Navbar{
        margin-bottom: 20px!important;
    }
</style>
<template>
    <div class="Navbar">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Books</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <router-link class="nav-item nav-link" :to="{ name: 'repository' }">Repository</router-link>
                    <router-link class="nav-item nav-link" :to="{ name: 'addBook' }">New Book</router-link>
                    <router-link class="nav-item nav-link mr-md-2" :to="{ name: 'Logout' }">Logout</router-link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {}
</script>
