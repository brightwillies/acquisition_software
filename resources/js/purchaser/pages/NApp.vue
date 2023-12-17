<template>
  <div>
    <router-view :key="key"></router-view>
  </div>
</template>

<script>
import { computed, watch } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex'; // Import useStore function from Vuex

import store from "./../store";
export default {
  setup() {
    const router = useRouter();
    const store = useStore(); // Access the Vuex store

    // Watch for changes in the isLoggedIn state
    const isLoggedIn = computed(() => store.getters.isLoggedIn);
    watch(isLoggedIn, (newValue) => {
      if (newValue && router.currentRoute.value.path === '/superadmin-login') {
        router.push('/administrator-dashboard'); // Redirect to home, for example
      }
    });

    // Create a reactive key that changes when the route changes
    const key = computed(() => router.currentRoute.value.fullPath);

    return { key };
  },
};
</script>
