import { createStore } from 'vuex';
import VuexPersistence from 'vuex-persist';

const options = {
    state() {
        return {
            token: null,
            isGirl: false
        };
    },
    mutations: {
        TOGGLE_IS_GIRL(state) {
            state.isGirl = !state.isGirl;
        }
    },
    plugins: [new VuexPersistence().plugin]
};

const store = createStore(options);

export default store;
