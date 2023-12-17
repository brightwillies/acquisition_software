import { createRouter, createWebHistory } from 'vue-router';
// import { createStore } from './../state/store'; // Import the store using Vue 3 composition API syntax
import store from './store.js'; // Import the store


import Login from './pages/Login.vue';
import Overview from './pages/Overview.vue';
import Dashboard from './pages/Dashboard.vue';
import NewAcquisition from './pages/NewAcquisition.vue';
import PendingAcquisition from './pages/PendingAcquisition.vue';
import otherAcquisition from './pages/otherAcquisition.vue';

const routes = [
  {
    path: '/hod-login',
    name: 'login',
    component: Login,
  },
  {
    path: '/hod-dashboard',
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
          path: "pending-acquisition",
          name: "pending",
          component: PendingAcquisition
      },
      {
          path: "other-acquisition",
          name: "other",
          component: otherAcquisition
      },

    {
        path: "acquisition/:id",
        name: "viewAcquisition",
        component: NewAcquisition
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
      next("/administrator-login");
    }
  } else {
    next();
  }
});



export  default router ; // Export the router and store so they can be used in the main Vue app file.
