<template>
    <v-dialog transition="dialog-bottom-transition" v-model="dialog[data.id]" width="410">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="red" class="ml-2" dark v-bind="attrs" v-on="on">
                DELETE
            </v-btn>
        </template>

        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                Are you sure you want to delete <br> {{ data.role_name }}?
            </v-card-title>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary darken-4" text @click="$set(dialog, data.id, false)">
                    close
                </v-btn>
                <v-btn color="red white--text" small @click="deleteUser(data.id)">
                    Yes, DELETE
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
            dialog: []
        }
    },
    methods: {
        async deleteUser(id) {
            try {
                const res = await this.$store.dispatch('role/delete', id)
                if (res.status === 200) {
                    this.dialog[id] = false;
                }
            } catch (err) {
                console.log(err.response)
            }
        }
    }
}
</script>