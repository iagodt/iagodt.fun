<template>
    <nav class="navbar">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
      <div class="navbar-container">
        <div class="brand-div">
            <a href="/" class="navbar-brand">Tedy</a>
            <a href="/" class="navbar-brand">Winter</a>
        </div>
        <div class="search-bar">
          <input type="search" class="search-input" name="item-search" id="search" placeholder="O que você está buscando?">

          <span class="material-symbols-outlined">search</span>
        </div>
        
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link to="/account" class="nav-link">
              <span id="account" class="material-symbols-outlined">person</span>
              <P class="nav-text">Minha</P> <p class="nav-text">conta</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/cart" class="nav-link">
              <span id="cart" class="material-symbols-outlined">shopping_cart</span>
              <p class="nav-text">Meu</p>
              <p class="nav-text">Carrinho</p>
            </router-link>
          </li>
        </ul>
      </div>
      
    </nav>
</template>

<script>
import CategoriesCard from "@/components/CategoriesCard.vue";

export default {
name: 'Navbar',
components: {CategoriesCard},

};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Bodoni+Moda:opsz,wght@6..96,400..900&display=swap');
#account,#cart{
  color: #fafafa;
}
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 48;
  font-size: 3em;
  color: #000000;
  display: flex;
  align-items: center;
}
.navbar {
background-color: #000000;
color: #fafafa;
padding: 0px;
padding-bottom: 0px;
padding-top: 0px;
}
.navbar-container {
display: flex;
justify-content: space-between;
align-items: center;
padding-right: 2.25rem;
padding-left: 2.25rem;
}

.search-bar{
height: 2;
width: 50%;
display: flex;
padding: 0px;
background-color: #fafafa;
border-radius: 12px;
}
.search-input{
width: 100%;
background-color: transparent;
border: transparent;
}
.brand-div{
padding-top: 0px;
}
.navbar-brand {
display: flex;
justify-content: center;
font-family: "Bodoni Moda", serif;
color: #fafafa;
text-decoration: none;
font-size: 2rem;
font-style: italic;
}
.navbar-nav {
list-style: none;
display: flex;
gap: 1em;
padding: 0;
margin: 0;
}
.nav-item {
margin: 0;
}
.nav-text{
  margin: 0px;
}
.nav-link {
margin: 0px;
padding: 0px;
flex-direction: column;
align-items: center;
display: flex;
color: #fafafa;
text-decoration: none;
font-size: 1em;
}
.nav-link:hover {
text-decoration: underline;
}
</style>
