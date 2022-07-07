<template>
    <v-dialog v-model="dialog[data.id]" width="500">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark v-bind="attrs" v-on="on">
                EDIT
            </v-btn>
        </template>

        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                EDIT USER
            </v-card-title>

            <v-card-text>
                <v-text-field v-model="role.role_name" label="Role Name" required></v-text-field>
                <v-text-field v-model="role.description" label="Description" required></v-text-field>
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
    </v-dialog>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            dialog: [],
            role: {
                role_name: '',
                description: '',
            },
            loading: false
        }
    },
    mounted() {
        this.fillIn();
    },
    methods: {
        fillIn() {
            this.role.role_name = this.data.role_name;
            this.role.description = this.data.description;
        },
        async update(id) {
            this.loading = true;
            try {
                const res = await this.$store.dispatch('role/update', { id: id, data: this.role })
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