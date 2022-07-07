<template>
    <v-dialog v-model="dialog" width="500">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="green lighten-2" dark v-bind="attrs" v-on="on" @click="openRoles()">
                + ADD USER
            </v-btn>
        </template>

        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                + ADD USER
            </v-card-title>

            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-text-field v-model="user.name" label="Name" :rules="nameRules" required></v-text-field>
                    <v-text-field v-model="user.email" label="E-mail" :rules="emailRules" required></v-text-field>
                    <v-text-field v-model="user.password" label="Pasword" type="password" :rules="pwRules" required>
                    </v-text-field>
                    <v-text-field v-model="user.password_confirmation" label="Pasword Confirmation" type="password"
                        :rules="pwRules" required>
                    </v-text-field>
                    <v-select v-model="user.role" :items="open_roles" :item-text="RoleText" item-value="id"
                        label="Assign Role" required></v-select>
                </v-form>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn :disabled="!valid" color="primary" text @click="store">
                    + SAVE
                </v-btn>
            </v-card-actions>
        </v-card>
        <v-snackbar v-model="snackbar" class="text-center" :color="sbColor" top right>
            <div class="text-center"> {{ msg }} </div>
        </v-snackbar>
    </v-dialog>
</template>

<script>
import { mapState } from 'vuex';

export default {
    data() {
        return {
            dialog: false,
            valid: true,
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                role: ''
            },
            snackbar: false,
            sbColor: null,
            msg: '',
            nameRules: [
                (v) => {
                    return !!v || "Name is required";
                },
            ],
            emailRules: [
                (v) => {
                    return !!v || "E-mail is required";
                },
                (v) =>
                    /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
                    "E-mail must be valid",
            ],
            pwRules: [
                (v) => {
                    return !!v || "Password is required";
                },
                (v) => {
                    return (v && v.length > 7) || "Password must be 8 characters above";
                },
            ],
        }
    },
    computed: {
        ...mapState('role', ['open_roles'])
    },
    methods: {
        async store() {
            try {
                const res = await this.$store.dispatch('user/store', this.user)
                if (res.status === 201) {
                    this.msg = 'SUCCESS!';
                    this.sbColor = 'green';
                    this.snackbar = true;
                    this.clearForm();
                }
            } catch (err) {
                this.msg = err.response.data.message;
                this.sbColor = 'red';
                this.snackbar = true;
            }
        },
        async openRoles() {
            try {
                const res = await this.$store.dispatch('role/openRoles')
            } catch (err) {
                console.log(err.response)
            }
        },
        RoleText(item) {
            if (item) {
                return `${item.role_name}`;
            } else {
                return "No role Available";
            }
        },
        clearForm() {
            this.$refs.form.reset()
        },
    }
}
</script>