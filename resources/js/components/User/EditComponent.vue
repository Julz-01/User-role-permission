<template>
    <v-dialog v-model="dialog[data.id]" width="500">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark v-bind="attrs" v-on="on" @click="all(); findById(data.id)">
                EDIT
            </v-btn>
        </template>

        <v-card v-show="loader == false">
            <v-card-title class="text-h5 grey lighten-2">
                EDIT USER
            </v-card-title>

            <v-card-text>
                <v-text-field v-model="user.name" label="Name" required></v-text-field>
                <v-text-field v-model="user.email" label="E-mail" readonly></v-text-field>
                <v-select v-model="user.role" :items="openRoles" :item-text="RoleText" item-value="id"
                    label="Assign Role" required></v-select>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="red" text @click="$set(dialog, data.id, false)">
                    CLOSE
                </v-btn>
                <v-btn color="primary" :loading="loading" text @click="update(data.id)">
                    SAVE
                </v-btn>
            </v-card-actions>
        </v-card>

        <v-skeleton-loader v-show="loader == true" class="mx-auto" type="card">
        </v-skeleton-loader>

    </v-dialog>
</template>

<script>
import { mapState } from 'vuex';

export default {
    props: ['data'],
    data() {
        return {
            dialog: [],
            user: {
                name: '',
                email: '',
                role: ''
            },
            loading: false,
            loader: false,
        }
    },
    computed: {
        ...mapState('role', ['roles']),
        openRoles() {
            return this.roles.filter(
                (role) =>
                    role.user_id === null || role.user_id === this.data.id
            )
        }
    },
    methods: {
        RoleText(item) {
            if (item) {
                return `${item.role_name}`;
            } else {
                return "No role Available";
            }
        },

        async findById(id) {
            this.loader = true;
            try {
                const res = await this.$store.dispatch('user/findById', id);
                if (res.status === 200) {
                    this.user.name = res.data.user.name;
                    this.user.email = res.data.user.email;
                    if (res.data.user.role !== null) {
                        this.user.role = res.data.user.role.id
                    } else {
                        this.user.role = null;
                    }
                    this.loader = false;
                }
            } catch (err) {
                console.log(err.response)
            }
        },

        async all() {
            try {
                const res = await this.$store.dispatch('role/all')
            } catch (err) {
                console.log(err.response)
            }
        },

        async update(id) {
            this.loading = true;
            try {
                const res = await this.$store.dispatch('user/update', { id: id, data: this.user })
                if (res.status === 200) {
                    this.loading = false;
                    this.dialog[id] = false;
                }
            } catch (err) {
                console.log(err.response)
            }
        }
    }
}
</script>