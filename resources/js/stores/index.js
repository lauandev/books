import Vue from 'vue'
import Vuex from 'vuex'
import Cookies from 'js-cookie'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        isLoggedIn: !!Cookies.get('token')
    },
    mutations: {
        loginUser (state) {
            state.isLoggedIn = true;
        },
        logoutUser (state) {
            state.isLoggedIn = false;
        },
    }
})
