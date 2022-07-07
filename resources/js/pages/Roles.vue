<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-title>ROLES

                        <v-spacer></v-spacer>
                        <Add />
                    </v-card-title>
                    <v-data-table :headers="headers" :items="roles" :items-per-page="10" class="elevation-1">
                        <template v-slot:item.actions="{ item }">
                            <div class="d-inline-flex">
                                <Edit :data="item" />
                                <Delete :data="item" />
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
import Add from '../components/Role/AddRoleComponent.vue';
import Edit from '../components/Role/EditRoleComponent.vue';
import Delete from '../components/Role/DeleteRoleComponent.vue';

export default {
    data() {
        return {
            headers: [
                {
                    text: 'Name',
                    align: 'start',
                    sortable: false,
                    value: 'role_name',
                },
                { text: 'Description', value: 'description' },
                { text: 'Actions', value: 'actions' },
            ],
        }
    },
    mounted() {
        this.findRoles();
    },
    computed: {
        ...mapState('role', ['roles'])
    },
    methods: {
        async findRoles() {
            try {
                await this.$store.dispatch('role/all')
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