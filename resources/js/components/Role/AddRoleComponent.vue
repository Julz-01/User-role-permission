<template>
    <v-dialog v-model="dialog" width="500">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="green lighten-2" dark v-bind="attrs" v-on="on">
                + ADD ROLE
            </v-btn>
        </template>

        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                + ADD ROLE
            </v-card-title>

            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-text-field v-model="role.role_name" label="Role name" :rules="nameRules" required></v-text-field>
                    <v-text-field v-model="role.description" label="Description" :rules="descRules" required>
                    </v-text-field>
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
export default {
    data() {
        return {
            dialog: false,
            valid: true,
            role: {
                role_name: '',
                description: '',
            },
            snackbar: false,
            sbColor: null,
            msg: '',
            nameRules: [
                (v) => {
                    return !!v || "Role Name is required";
                },
            ],
            descRules: [
                (v) => {
                    return !!v || "Description is required";
                },
            ],
        }
    },
    methods: {
        async store() {
            try {
                const res = await this.$store.dispatch('role/store', this.role)
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
        clearForm() {
            this.$refs.form.reset()
        },
    }
}
</script>