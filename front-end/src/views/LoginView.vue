<template>
    <v-row>
        <v-col :lg="6" :cols="12">
            <v-text-field v-model="name" label="Full Name"></v-text-field>
        </v-col>
        <v-col :lg="6" :cols="12">
            <v-text-field v-model="email" label="Email"></v-text-field>
        </v-col>
        <v-col :lg="6" :cols="12">
            <v-text-field v-model="password" label="Password"></v-text-field>
        </v-col>
    </v-row>
    <v-row><v-btn @click="login"></v-btn> </v-row>
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
        methods: {
            login() {
                window.axios({
                    method: 'post',
                    url: 'register',
                    data: {
                        name: this.name,
                        password: this.password,
                        email: this.email,
                        is_girl: this.$store.state.isGirl
                    }
                });
            }
        }
    });
</script>
