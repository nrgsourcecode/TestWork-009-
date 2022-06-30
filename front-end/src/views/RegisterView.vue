<template>
    <v-row>
        <v-col :lg="6" :cols="6">
            <h1>Hello, and Welcome to Mello<span v-if="!isGirl">, young fellow</span></h1>

            <v-switch v-model="isGirl" label="I'm a girl"></v-switch>
            <template v-if="isGirl">
                <h3>Sorry, here's a squirrel</h3>
                <div class="my-n3" style="width: 20%">
                    <v-img :src="require('../assets/images/squirrel.png')" :height="200" contain />
                </div>
            </template>
        </v-col>
        <v-col :cols="6">
            <h2>Register</h2>
            <v-col :cols="12">
                <v-text-field v-model="name" label="Full Name"></v-text-field>
            </v-col>
            <v-col :cols="12">
                <v-text-field v-model="email" label="Email"></v-text-field>
            </v-col>
            <v-col :cols="12">
                <v-text-field v-model="password" label="Password (8 characters minimum)"></v-text-field>
            </v-col>
            <v-col :cols="12">
                <v-btn @click="register">Register</v-btn>
            </v-col>
        </v-col>
    </v-row>
</template>

<script>
    import { defineComponent } from 'vue';

    export default defineComponent({
        name: 'LoginView',
        data() {
            return {
                name: null,
                email: null,
                password: null
            };
        },
        computed: {
            isGirl: {
                get() {
                    return this.$store.state.isGirl;
                },
                set() {
                    this.$store.commit('TOGGLE_IS_GIRL');
                }
            }
        },
        methods: {
            register() {
                window
                    .axios({
                        method: 'post',
                        url: 'register',
                        data: {
                            name: this.name,
                            password: this.password,
                            email: this.email,
                            is_girl: this.$store.state.isGirl
                        }
                    })
                    .then(() => {
                        this.$router.push('home');
                    });
            }
        }
    });
</script>
