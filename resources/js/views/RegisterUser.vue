<template>
    <div class="RegisterUser">
        <form>
            <div class="shadow col-md-12">
                <form @submit.prevent="onSubmit" class="offset-md-3 col-md-6">
                    <label for="name">
                        <input type="text" id="name" v-model="name" required>
                    </label>
                    <label for="email">
                        <input type="email" id="email" v-model="email">
                    </label>
                    <label for="password">
                        <input type="password" id="password" v-model="password">
                    </label>
                    <label for="c_password">
                        <input type="password" id="c_password" v-model="c_password">
                    </label>
                    <label for="profile_image">
                        <input type="file" id="profile_image" v-model="profile_image">
                    </label>
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </form>
    </div>
</template>

<script>
    export default {}
</script>
