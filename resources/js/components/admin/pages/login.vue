<template>
    <v-app id="inspire">
        <v-content>
            <v-container
                class="fill-height"
                fluid
            >
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-col
                        cols="12"
                        sm="8"
                        md="4"
                    >
                        <v-card class="elevation-12">
                            <v-toolbar
                                color="primary"
                                dark
                                flat
                            >
                                <v-toolbar-title>Login form</v-toolbar-title>
                                <v-spacer />
                            </v-toolbar>
                            <v-card-text>
                                <v-progress-linear
                                    :active="loading"
                                    :indeterminate="loading"
                                    absolute
                                    top
                                    color="deep-purple accent-4"
                                ></v-progress-linear>
                                <v-form>
                                    <v-text-field
                                        v-model="fb_email"
                                        :rules="fb_emailRules"
                                        label="Email"
                                        name="fb_email"
                                        prepend-icon="mdi-account"
                                        type="email"
                                    />

                                    <v-text-field
                                        id="password"
                                        v-model="password"
                                        :rules="passwordRules"
                                        label="Password"
                                        name="password"
                                        prepend-icon="mdi-lock"
                                        type="password"
                                    />
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer />
                                <v-btn color="primary" @click="login">Login</v-btn>
                            </v-card-actions>
                            <v-snackbar
                                v-model="snackbar"
                                :timeout="timeout"
                            >
                                {{ text }}
                                <v-btn
                                    :color="color"
                                    :top="y === 'top'"
                                    text
                                    @click="snackbar = false"
                                >
                                    Close
                                </v-btn>
                            </v-snackbar>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    import axios from 'axios';

    export default {
        data () {
            return {
                fb_email: '',
                fb_emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                ],
                password: '',
                passwordRules: [
                    v => !!v || 'Password is required',
                ],

                loading: false,
                snackbar: false,
                color: '',
                text: '',
                timeout: 3000,
                x: null,
                y: top,
            }
        },

        methods: {
            login: function () {
                // Add a request interceptor
                axios.interceptors.request.use( (config) => {
                    this.loading = true;
                    return config;
                }, (error) => {
                    // this.loading = false;
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

                axios.post('/api/login_web', {
                    'fb_email': this.fb_email,
                    'password': this.password
                }).then( res => {
                    localStorage.setItem('token', res.data.access_token);
                    this.$router.push('/admin').then( res => {
                        console.log(res)
                    }).catch( err => {
                        console.log(err)
                    })
                }).catch( err => {
                    this.color = ''
                    this.text = err.response.data.errors;
                    this.snackbar = true;
                })
            }
        }
    }
</script>
