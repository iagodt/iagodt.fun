import { createRouter, createWebHistory } from 'vue-router';
import Home from './Pages/Home.vue';
import Login from './Pages/Login.vue'
import ProductPage from './Pages/ProductPage.vue';
import CategoryPage from './Pages/CategoryPage.vue';
import LoginPopUp from './components/loginPopUp.vue';
import RegisterPage from './Pages/RegisterPage.vue';
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
    {
      path: '/account',
      name: 'Account',
      component: LoginPopUp
    },
    {
      path: '/account/register',
      name: 'AccountRegister',
      component: RegisterPage
    },
    {name: 'ProductPage' ,path: '/product/:product', component: ProductPage},
    {name: 'CategoryPage' ,path: '/category/:category', component: CategoryPage},
    
];
  
const router = createRouter({
history: createWebHistory(),
routes
});

export default router;