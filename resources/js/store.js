import { createStore } from 'vuex';
import createPersistedState from "vuex-persistedstate";

const store = createStore({
  plugins: [createPersistedState()],
  state() {
    return {
      user: null,
      isAuthenticated: false,
      cart: [],
    }
  },

  mutations: {
    setUser(state, user) {
      state.user = user
      state.isAuthenticated = !!user
    },
    logout(state) {
      state.user = null
      state.isAuthenticated = false
    }

  },

  actions: {
    async login(context, credentials) {
      try {
        const response = await fetch('/auth/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(credentials),
        });
        const data = await response.json();
        if (data.Token) {
          // Salvar o token em localStorage
          localStorage.setItem('token', data.Token);
          // Disparar a mutação setUser para atualizar o estado
          context.commit('setUser', data.user);

          await fetch(`/api/usercart/sync?cart=${localStorage.cart}`,{
            method: 'post',
            headers: {Authorization: `Bearer ${data.Token}`}
          })


        } else {
          console.log('erro de login')
          // Tratar erros de login
          // ...
        }
      } catch (error) {
        console.log('erro de req')
        // Tratar erros da requisição
        // ...
      }
    },
    logout(context) {
      localStorage.removeItem('cart')
      localStorage.removeItem('token')
      context.commit('logout')
    },
    
    async googleLogin(context, token) {
      const response = await fetch('/auth/google/login', {
        method: 'get',
        headers: {Authorization: `Bearer ${token}`},
      });

      const data = await response.json()

      if (data.Token) {
        // Salvar o token em localStorage
        localStorage.setItem('token', data.Token);
        // Disparar a mutação setUser para atualizar o estado
        context.commit('setUser', data.user);

        await fetch(`/api/usercart/sync?cart=${localStorage.cart}`,{
          method: 'post',
          headers: {Authorization: `Bearer ${data.Token}`}
        })
      }
      

    }
  },
  getters: {
    user(state) {
      return state.user
    },
    isAuthenticated(state) {
      return state.isAuthenticated
    }

  }

})

export default store