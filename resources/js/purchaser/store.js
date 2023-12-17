// store.js
import { createStore } from 'vuex';

const store = createStore({
  state() {
    return {
      isLoggedIn: !!localStorage.getItem('acidms_platform_purchaser_pass'),
    };
  },

  mutations: {
    loginUser(state) {
      state.isLoggedIn = true;
    },
    logoutUser(state) {
      state.isLoggedIn = false;
    },
  },

  getters: {
    isLoggedIn: (state) => !!state.isLoggedIn,
  },
});

export default store;
