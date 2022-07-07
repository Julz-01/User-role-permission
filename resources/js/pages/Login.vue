<template>
    <v-app>
        <v-main>
            <v-container class="fill-height" fluid>
                <v-row class="justify-center align-center">
                    <v-col cols="12" sm="12" md="6" lg="6">
                        <v-card elevation="7" tile class="mx-auto animate__animated animate__bounceInUp" width="350">
                            <v-row no-gutters wrap class="justify-center">
                                <v-col cols="6" sm="6" md="6" lg="6">
                                    <v-img src="https://cdn.cdnlogo.com/logos/v/50/vuetify.svg" width="90"
                                        class="mx-auto my-5">
                                    </v-img>
                                </v-col>
                            </v-row>
                            <v-card-text>
                                <v-form>
                                    <v-text-field v-model="credentials.email" :rules="emailRules" type="email" outlined
                                        label="Email" append-icon="mdi-email" required></v-text-field>
                                    <v-text-field v-model="credentials.password" :rules="pwRules"
                                        :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                                        :type="show ? 'text' : 'password'" outlined label="Password"
                                        @click:append="show = !show"></v-text-field>
                                </v-form>
                            </v-card-text>

                            <v-row class="justify-center">
                                <v-col cols="6" sm="6" md="6" lg="6" class="text-center pt-0">
                                    <v-btn color="indigo darken-4" class="font-weight-bold" @click="login()" text dark>
                                        Login
                                        <template v-slot:loader>
                                            <span>Loading...</span>
                                        </template>
                                    </v-btn>
                                        <v-btn color="green darken-4" href="/registration" class="font-weight-bold" text dark>
                                            REGISTER</v-btn>
                                </v-col>
                            </v-row>
                        </v-card>
                        <v-snackbar v-model="snackbar" class="text-center" :color="sbColor" top right>
                            <div class="text-center"> {{ msg }} </div>
                        </v-snackbar>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>


<script>
export default {
    data() {
        return {
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
            ],
            show: false,
            credentials: {
                email: "",
                password: "",
            },
            isLoading: false,
            snackbar: false,
            sbColor: null,
            msg: null,
            errors: [],
            dialog: true
        }
    },
    methods: {
        async login() {
            try {
                const res = await this.$store.dispatch('auth/login', this.credentials)
                if (res.status === 204) {
                    this.sbColor = 'green';
                    this.msg = 'LOGIN SUCCESS!';
                    this.snackbar = true;
                }
            } catch (err) {
                this.sbColor = 'red';
                if (err.response.status === 422) {
                    this.msg = err.response.data.message;
                    this.snackbar = true;
                } else {
                    this.msg = 'SOMETHING WENT WRONG PLEASE TRY AGAIN!';
                    this.snackbar = true;
                }
            }
        }
    }
}
</script>