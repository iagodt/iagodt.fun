import { createRouter, createWebHistory } from 'vue-router';
import Home from './Pages/Home.vue';
import Login from './Pages/Login.vue'
import ProductPage from './Pages/ProductPage.vue';
const routes = [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {name: 'ProductPage' ,path: '/product/:product', component: ProductPage}
];
  
const router = createRouter({
history: createWebHistory(),
routes
});

export default router;