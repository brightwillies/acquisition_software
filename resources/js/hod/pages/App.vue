<template>
  <div>

    
    <router-view></router-view>
  </div>
</template>

<script>
import { useRoute, useRouter } from 'vue-router'
import { onMounted } from 'vue'
import store from './../store.js';
export default {
  setup() {
    const route = useRoute()
    const router = useRouter()

    onMounted(async () => {
      await router.isReady()
      if (store.getters.isLoggedIn && route.path === "/hod-login") {
    router.push("/hod-dashboard"); // redirect to home, for example
  }
    })

    return { route }
  },
}
</script>
 
