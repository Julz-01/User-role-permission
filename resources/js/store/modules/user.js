import axios from "axios";
const resourse = '/api/user';

const user = {
    namespaced: true,
    state: {
        users: [],
        user: []
    },
    getters: {},
    mutations: {
        MUTATE_USERS(state, payload) {
            state.users = payload;
        },

        MUTATE_USER(state, payload) {
            state.user = payload;
        }
    },
    actions: {
        async all({ commit }) {
            const res = await axios.get(`${resourse}`)
            if (res.status === 200) {
                commit('MUTATE_USERS', res.data.users)
            }

            return res;
        },

        async store({ dispatch }, payload) {
            const res = await axios.post(`${resourse}`, payload)
            if (res.status === 201) {
                dispatch('all')
            }

            return res;
        },

        async findById({ commit }, payload) {
            const res = await axios.get(`${resourse}/${payload}`)
            console.log(res)
            if (res.status === 200) {
                commit('MUTATE_USER', res.data.user);
            }

            return res;
        },

        async update({ dispatch }, payload) {
            const res = await axios.put(`${resourse}/${payload.id}`, payload.data)
            if (res.status === 200) {
                dispatch('all');
            }

            return res;
        },

        async delete({ dispatch }, payload) {
            const res = await axios.delete(`${resourse}/${payload}`)
            if (res.status === 200) {
                dispatch('all');
            }

            return res;
        }
    }
}

export default user;