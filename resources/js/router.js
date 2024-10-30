import { createRouter, createWebHistory } from 'vue-router';
import Home from './Pages/Home.vue';
import Login from './Pages/Login.vue'
import ProductPage from './Pages/ProductPage.vue';
import CategoryPage from './Pages/CategoryPage.vue';
import LoginPopUp from './components/loginPopUp.vue';
import RegisterPage from './Pages/RegisterPage.vue';
import AccountPage from './Pages/AccountPage.vue';
import store from './store';
import RecoveryPage from './Pages/recoveryPage.vue';
import PasswordReset from './Pages/passwordReset.vue';
import Redirectpage from './components/redirectpage.vue';
import CheckoutShippingPage from './Pages/checkoutShippingPage.vue';
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
      component: AccountPage,
      meta: {
        requiresAuth: true,
      }
    },
    {
      path: '/register',
      name: 'AccountRegister',
      component: RegisterPage
    },
    {
      path: '/passwordrecovery',
      name: 'PasswordRecovery',
      component: RecoveryPage
    },
    {
      path: '/auth/recovery-password',
      name: 'ResetPassword',
      component: PasswordReset
    },
    {
      path: '/auth/google-redirect',
      name: 'googleRedirect',
      component: Redirectpage
    },
    {
      path:'/checkout/shipping',
      name:'CheckoutPage',
      component: CheckoutShippingPage
    },
    {name: 'ProductPage' ,path: '/product/:product', component: ProductPage},
    {name: 'CategoryPage' ,path: '/category/:category', component: CategoryPage},
    
];
  
const router = createRouter({
history: createWebHistory(),
routes
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.getters.isAuthenticated) {
    // Se a rota precisa de autenticação e o usuário não está autenticado, redireciona para a página de login
    next({ name: 'Login' });
  } else {
    next(); // Permitir acesso à rota
  }
});

export default router;