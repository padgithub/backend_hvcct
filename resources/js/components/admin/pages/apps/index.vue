<template>

    <v-card>
        <v-card-title>
            Apps
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
            :items="apps"
            :search="search"
        ></v-data-table>
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
                    { text: 'Version IOS', value: 'version_ios' },
                    { text: 'Version Android', value: 'version_android' },
                    { text: 'Prize', value: 'prize' },
                    { text: 'Plan Text', value: 'plan_test' },
                    { text: 'Plan Win', value: 'plan_show_win' },
                    { text: 'Action', value: 'action', sortable: false },
                ],
                apps: [],
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

                axios.get('/api/info_apps', {})
                .then(res => {
                    this.apps = res.data.content.data
                })
                .catch(err => {
                    console.log(err)
                })
            }
        }

    }
</script>
