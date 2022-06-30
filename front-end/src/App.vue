<template>
    <v-app>
        <v-toolbar :color="barColor">
            <v-img :src="require('./assets/images/logo.svg')" class="my-3" contain />
            <v-toolbar-title>Mello Interactive</v-toolbar-title>
        </v-toolbar>
        <v-main>
            <v-container>
                <router-view />
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        name: 'App',
        computed: {
            barColor() {
                return this.isGirl ? 'pink lighten-5' : 'blue lighten-5';
            },
            isGirl: {
                get() {
                    return this.$store.state.isGirl;
                }
            }
        }
    };
</script>
