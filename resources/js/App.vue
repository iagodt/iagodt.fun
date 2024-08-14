<template>
    <div id="app">
      <router-view style="margin-top: 2rem;"></router-view>
      <div class="navbar-div">
        <NavBar />
        <div class="categories-container">
              <router-link to="/" class="cat-item">
                  <p>início</p>
              </router-link>
              <CategoriesCard 
                  v-for="(category) in categories"
                  :category="category"
              />
        </div>
      </div>
    </div>
    
  </template>
  
<script>
import NavBar from "@/components/NavBar.vue";
import CategoriesCard from "@/components/CategoriesCard.vue";
import axios from "axios";
  export default {
    name: 'App',
    components: {CategoriesCard,NavBar},
    data(){
    return{
        categories: null
    }


},
    methods: {
        getCategories: async function(){
            const _this = this;

            await axios({
                method: 'get',
                url: '/api/categories/get'
            }).then(function (response) {
                _this.categories = response.data
            })
        }
    },
    async created(){
        await this.getCategories();
    }
  };
</script>
  
<style>
  /* Seu estilo global aqui */
  @import url('https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
  body {
      font-family: "Raleway", sans-serif;
      font-style: italic;
      color: #fafafa;
      padding: 0px;
      margin: 0px;
      margin-top: 9.35rem;
  }
  .navbar-div {
  background-color: #fafafa;
  position: fixed; /* Set the navbar to fixed position */
  top: 0; /* Position the navbar at the top of the page */
  width: 100%;
  height: auto;
}
  .cat-item{
    font-style: normal;
    align-items: center;
    display: flex;
    color: #fafafa;
    text-decoration: none;
}
  .categories-container{
  margin-top: 2px;
  padding-left: 2.25em;
  padding-right: 2.25em;
  display: flex;
  justify-content: space-between;
  background-color: black;
  }
</style>
  