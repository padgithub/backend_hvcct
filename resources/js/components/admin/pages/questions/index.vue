<template>

    <v-card>
        <v-card-title>
            Questions
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
                    { text: 'ID App', value: 'app_id' },
                    { text: 'Details', value: 'details' },
                    { text: 'A', value: 'a' },
                    { text: 'B', value: 'b' },
                    { text: 'C', value: 'c' },
                    { text: 'D', value: 'd' },
                    { text: 'Answer', value: 'answer' },
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

                axios.get('/api/info_questions', {})
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
