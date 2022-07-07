<template>
    <v-app>
        <v-navigation-drawer app absolute dark class="gradient" permanent height="100%">
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title>
                        <p>{{ auth_data.name }}</p>
                        <small>{{ auth_data.email }}</small>
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-list>
                <v-list-item v-for="item in items" :key="item.title" link :to="item.link">
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar app color="blue darken-4" class="white--text">
            <v-toolbar-title>User Role</v-toolbar-title>
            <v-spacer></v-spacer>
            <div class="text-center">
                <v-dialog transition="dialog-bottom-transition" v-model="dialog" width="410">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn color="blue--text" small v-bind="attrs" v-on="on">
                            Logout
                        </v-btn>
                    </template>

                    <v-card>
                        <v-card-title class="text-h5 grey lighten-2">
                            Are you sure you want to logout?
                        </v-card-title>

                        <v-divider></v-divider>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" text @click="dialog = false">
                                close
                            </v-btn>
                            <v-btn color="blue darken-4 white--text" small @click="logout()">
                                LOGOUT
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </div>
        </v-app-bar>

        <!-- Sizes your content based upon application components -->
        <v-main>
            <v-container fluid>
                <!-- If using vue-router -->
                <v-slide-x-transition mode="out-in">
                    <router-view :auth="auth_data"></router-view>
                </v-slide-x-transition>
            </v-container>
        </v-main>

        <v-footer app>
            <!-- -->
        </v-footer>
    </v-app>
</template>

<script>
export default {
    props: ['auth_data'],
    data: () => ({
        items: [
            { title: "Dashboard", icon: "mdi-view-dashboard", link: "/dashboard" },
            { title: "Roles", icon: "mdi-view-list", link: "/roles" },

        ],
        dialog: false
    }),
    methods: {
        async logout() {
            await this.$store.dispatch('auth/logout')
        }
    },
};
</script>

<style>
.gradient {
    background: rgb(2, 0, 36);
    background: linear-gradient(180deg,
            rgba(2, 0, 36, 1) 0%,
            rgba(9, 9, 121, 1) 35%,
            rgba(0, 212, 255, 1) 100%);
}
</style>