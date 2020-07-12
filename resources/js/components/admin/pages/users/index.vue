<template>

    <v-card>
        <v-card-title>
            Users
            <v-spacer></v-spacer>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
        </v-card-title>
        <v-data-table
            :headers="headers"
            :items="users"
            :search="search"
        >
            <template v-slot:item.action="{ item }">
                <v-icon small class="mr-2" v-text="'$vuetify.values.playListEdit'"></v-icon>
                <v-icon small class="mr-2" v-text="'$vuetify.values.delete'"></v-icon>
            </template>
        </v-data-table>
    </v-card>

</template>

<script>
    import axios from "axios";

    export default {
        data () {
            return {
                search: '',
                headers: [
                    {
                        text: '#ID',
                        align: 'start',
                        sortable: false,
                        value: 'id',
                    },
                    { text: 'Name', value: 'name' },
                    { text: 'Phone', value: 'phone' },
                    { text: 'FB-ID', value: 'fb_id' },
                    { text: 'FB-Email', value: 'fb_email' },
                    { text: 'FB-Url', value: 'fb_url' },
                    { text: 'Action', value: 'action', sortable: false },
                ],
                users: [],
            }
        },
        created() {
            this.initialize();
        },

        methods: {
            initialize() {
                // Add a request interceptor
                axios.interceptors.request.use( (config) => {
                    this.loading = true;
                    return config;
                }, (error) => {
                    this.loading = false;
                    return Promise.reject(error);
                });

                // Add a response interceptor
                axios.interceptors.response.use((response) => {
                    this.loading = true;
                    return response;
                }, (error) => {
                    this.loading = false;
                    return Promise.reject(error);
                });

                axios.get('/api/info_users', {})
                .then(res => {
                    this.users = res.data.content.data
                })
                .catch(err => {
                    console.log(err)
                })
            }
        }

    }
</script>
