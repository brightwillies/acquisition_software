import { createRouter, createWebHistory } from 'vue-router';
// import { createStore } from './../state/store'; // Import the store using Vue 3 composition API syntax
import store from './store.js'; // Import the store


import Login from './pages/Login.vue';
import Overview from './pages/Overview.vue';
import Dashboard from './pages/Dashboard.vue';
import Department from './pages/Department.vue';
import DepartmentHead from './pages/DepartmentHead.vue';
import User from './pages/User.vue';
import Purchaser from './pages/Purchaser.vue';
import Order from './pages/Order.vue';
import PendingAcquisition from './pages/PendingAcquisition.vue';
import otherAcquisition from './pages/otherAcquisition.vue';
import NewAcquisition from './pages/NewAcquisition.vue';
const routes = [
  {
    path: '/administrator-login',
    name: 'login',
    component: Login,
  },
  {
    path: '/administrator-dashboard',
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
        path: "User",
        name: "User",
        component: User
      },
      {
        path: "orders",
        name: "order",
        component: Order
      },

      {
        path: "department",
        name: "department",
        component: Department
      },
      {
        path: "purchaser",
        name: "purchaser",
        component: Purchaser
      },

      {
        path: "department-head",
        name: "department-head",
        component: DepartmentHead
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



export default router; // Export the router and store so they can be used in the main Vue app file.
