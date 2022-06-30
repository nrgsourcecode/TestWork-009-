process.env.VUE_APP_API_BASE_URL = '/api';
process.env.VUE_APP_API_PORT = 8000;

const { defineConfig } = require('@vue/cli-service');
module.exports = defineConfig({
    transpileDependencies: true,

    pluginOptions: {
        vuetify: {
            // https://github.com/vuetifyjs/vuetify-loader/tree/next/packages/vuetify-loader
        }
    }
});
