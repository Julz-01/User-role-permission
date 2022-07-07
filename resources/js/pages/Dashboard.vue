<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-title>USER LIST

                        <v-spacer></v-spacer>
                        <Add />
                    </v-card-title>
                    <v-data-table :headers="headers" :items="users" :items-per-page="10" class="elevation-1">
                        <template v-slot:item.actions="{ item }">
                            <div class="d-inline-flex">
                                <Edit :data="item" />
                                <Delete v-if="auth.id !== item.id" :data="item" />
                            </div>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapState } from 'vuex';
import Add from '../components/User/AddComponent.vue';
import Edit from '../components/User/EditComponent.vue';
import Delete from '../components/User/DeleteComponent.vue';

export default {
    props: ['auth'],
    data() {
        return {
            headers: [
                {
                    text: 'Name',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                { text: 'Email', value: 'email' },
                { text: 'Role', value: 'role.role_name' },
                { text: 'Role Description', value: 'role.description' },
                { text: 'Actions', value: 'actions' },
            ],
        }
    },
    mounted() {
        this.findUsers();
    },
    computed: {
        ...mapState('user', ['users'])
    },
    methods: {
        async findUsers() {
            try {
                await this.$store.dispatch('user/all')
            } catch (err) {
                console.log(err.response)
            }
        },
    },
    components: {
        Add,
        Edit,
        Delete,
    }
}
</script>