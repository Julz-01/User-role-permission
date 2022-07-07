import axios from 'axios';

const auth = {
    namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {
        async login({ }, payload) {
            const res = await axios.post('/login', payload)
            if (res.status === 204) {
                setTimeout(() => {
                    window.location.replace("/dashboard");
                }, 1000);
            }
            return res;
        },

        async register({ }, payload) {
            const res = await axios.post('/register', payload)
            console.log(res)
            if (res.status === 201) {
                setTimeout(() => {
                    window.location.replace("/dashboard");
                }, 1000);
            }
            return res;
        },

        async logout({ }) {
            const res = await axios.post('/logout')
            if (res.status === 204) {
                setTimeout(() => {
                    window.location.replace("/");
                }, 1000);
            }
            return res;
        }
    }
}

export default auth;
