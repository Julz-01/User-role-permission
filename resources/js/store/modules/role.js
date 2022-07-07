import axios from "axios";
const resourse = '/api/role';

const role = {
    namespaced: true,
    state: {
        roles: [],
        open_roles: [],
    },
    getters: {},
    mutations: {
        MUTATE_ROLES(state, payload) {
            state.roles = payload;
        },

        MUTATE_OPEN_ROLES(state, payload) {
            state.open_roles = payload;
        }
    },
    actions: {
        async store({ dispatch }, payload) {
            const res = await axios.post(`${resourse}`, payload)
            if (res.status === 201) {
                dispatch('all');
            }

            return res;
        },

        async all({ commit }) {
            const res = await axios.get(`${resourse}`)
            console.log(res)
            if (res.status === 200) {
                commit('MUTATE_ROLES', res.data.roles)
            }

            return res;
        },

        async update({ dispatch }, payload) {
            const res = await axios.put(`${resourse}/${payload.id}`, payload.data)
            if (res.status === 200) {
                dispatch('all')
            }

            return res;
        },

        async delete({ dispatch }, payload) {
            const res = await axios.delete(`${resourse}/${payload}`)
            if (res.status === 200) {
                dispatch('all')
            }

            return res;
        },

        async openRoles({ commit }) {
            const res = await axios.get(`${resourse}/open`)
            console.log(res);
            if (res.status === 200) {
                commit('MUTATE_OPEN_ROLES', res.data.roles);
            }

            return res;
        }
    }
}

export default role;