import { createRouter, createWebHistory } from 'vue-router';
// import { createStore } from './../state/store'; // Import the store using Vue 3 composition API syntax
import store from './store.js'; // Import the store


import Login from './pages/Login.vue';
import Overview from './pages/Overview.vue';
import Dashboard from './pages/Dashboard.vue';
import NewAcquisition from './pages/NewAcquisition.vue';
import PendingAcquisition from './pages/PendingAcquisition.vue';
import CompletedAcquisition from './pages/CompletedAcquisition.vue';

const routes = [
  {
    path: '/purchaser-login',
    name: 'login',
    component: Login,
  },
  {
    path: '/purchaser-dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: { requiresAuth: true },
    children: [
      {
        path: "",
        name: "Overview",
        component: Overview
      },

      {
        path: "new-acquisition",
        name: "new-acquisition",
        component: NewAcquisition
      },
      {
        path: "pending-acquisition",
        name: "pendingAcquisition",
        component: PendingAcquisition
      },
      {
        path: "approved-acquisition",
        name: "completedAcquisition",
        component: CompletedAcquisition
      },

      



    ]
  },

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  //Inject the store from the root app  instance


  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (store.getters.isLoggedIn) {
      next();
    } else {
      next("/purchaser-login");
    }
  } else {
    next();
  }
});



export default router; // Export the router and store so they can be used in the main Vue app file.
