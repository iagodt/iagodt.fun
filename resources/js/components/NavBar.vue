<template>
  <nav class="navbar">
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <div class="navbar-container">
      <div class="brand-div">
        <a v-on:click="setHome" class="navbar-brand">Tedy</a>
        <a v-on:click="setHome" class="navbar-brand">Winter</a>
      </div>
      <div class="search-bar">
        <input type="search" class="search-input" name="item-search" id="search"
          placeholder="O que você está buscando?">

        <span id="searchButton" class="material-symbols-outlined">search</span>
      </div>

      <ul class="navbar-nav">
        <li class="nav-item">
          <div v-on:click="loginSet" class="nav-link">
            <span id="account" class="material-symbols-outlined">person</span>
          </div>
        </li>
        <li class="nav-item">
          <div id="cartSwitch" class="nav-link" v-on:click="cartSwitch">
            <span id="cart" class="material-symbols-outlined">local_mall</span>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="cart-container" id="cart-container" v-on:focusout="" tabindex="0" v-if="cartStatus == true">
    <div id="cartSwitch" class="cart-back" v-on:click="cartSwitch">
      <h2>Carrinho</h2>
      <span id="cart" class="material-symbols-outlined">close</span>
    </div>
    <div class="cart-content">
      <div class="cart-itens" v-if="Cart.length > 0">
        <div v-for="item in Cart" class="cart-content-item">
          <img :src="'/storage/' + item.images[0].image" class="cart-image">
          <div class="cart-item-info">
            <div class="title">{{ item.name }}</div>
            <div class="prices">
              <div v-if="item.discount != null" class="price">R$ {{
                (item.price - (item.price * (1 * (item.discount / 100)))).toFixed(2) }}</div>
              <div v-else class="price">R$ {{ item.price.toFixed(2) }}</div>
            </div>

          </div>
          <span id="delete-item" v-on:click="deleteItemCart(item.id)" class="material-symbols-outlined">delete</span>
        </div>
      </div>
      <div class="cart-empty" v-else>
        Seu carrinho esta vazio
        <button class="start-shopping">COMECE A COMPRAR</button>
      </div>
    </div>
    <div v-if="Cart.length > 0" class="cart-finish">
      <div class="cart-price">
        <div class="cartValue">
          <span>VALOR DO CARRINHO: </span>
          <span class="cart-value">R$ {{ cartPrice }}</span>
        </div>
        <div class="cartDiscont">
          <span>DESCONTO APLICADO: </span>
          <span id="highlight-value" class="cart-value">-R$ {{ cartDiscount }}</span>
        </div>
        <div class="cartTotal">
          <span>TOTAL A PAGAR: </span>
          <span id="highlight-value" class="cart-value">R$ {{ cartTotalPrice }}</span>
        </div>
      </div>
      <div class="finish-purchase">
        FINALIZAR COMPRA
        <span id="cart-finish" class="material-symbols-outlined">arrow_forward</span>
      </div>

    </div>
  </div>
</template>

<script>
import CategoriesCard from "@/components/CategoriesCard.vue";
import axios from "axios";
export default {
  name: 'Navbar',
  components: { CategoriesCard },
  data() {
    return {
      loginstatus: null,
      cartStatus: false,
      Cart: [],
      cartPrice: 0,
      cartTotalPrice: 0,
      cartDiscount: 0
    }
  },
  methods: {
    loginSet() {
      this.$router.push('/account')
    },
    setHome() {
      this.$router.push('/')
    },
    handleFocusOut() {
      const _this = this
      if (_this.cartStatus != false) {
        _this.cartStatus = false
      }
    },
    cartSwitch: async function () {
      const _this = this
      if (_this.cartStatus == false) {
        _this.cartStatus = true
      } else {
        _this.cartStatus = false
      }


      if (JSON.parse(localStorage.vuex).isAuthenticated) {
        await this.getUserCart()
      } else {
        await this.getCart()
      }


      if (_this.cartStatus == true) {
        this.$nextTick(function () {
          document.getElementById('cart-container').focus()

        })
      }
    },

    async deleteItemCart(productId) {
      if (JSON.parse(localStorage.vuex).isAuthenticated) {
        await axios({
        method: 'post',
        url: `/api/usercart/remove?product_id=${productId}`,
        headers: {
          'Authorization': 'Bearer ' + localStorage.token
        }
      }).then((response) => {
        this.getUserCart()
      })
      } else {
        if (localStorage.getItem('cart')) {
          let cart = JSON.parse(localStorage.getItem('cart'));

          cart = cart.filter(item => item.product_id !== productId);

          localStorage.setItem('cart', JSON.stringify(cart));
        }

        await this.getCart()
      }
    },
    getCartPrice() {
      let cartPrice = 0;
      let cartTotalPrice = 0;
      let cartDiscount = 0;

      this.Cart.forEach(element => {
        const price = parseFloat(element.price) || 0;
        const discount = parseFloat(element.discount) || 0;
        const discountValue = price * (discount / 100);

        cartPrice += price;
        cartDiscount += discountValue;
        cartTotalPrice += price - discountValue;
      });

      this.cartPrice = cartPrice.toFixed(2);
      this.cartDiscount = cartDiscount.toFixed(2);
      this.cartTotalPrice = cartTotalPrice.toFixed(2)
    },
    async getCart() {
      //cartUpdate
      await axios({
        method: 'post',
        url: `/api/cart/getItens?cart=${localStorage.getItem('cart')}`
      }).then((response) => {
        this.Cart = response.data
      })

      this.getCartPrice()
    },

    async getUserCart() {
      //cartUpdate
      await axios({
        method: 'get',
        url: `/api/usercart/get`,
        headers: {
          'Authorization': 'Bearer ' + localStorage.token
        }
      }).then((response1) => {

        axios({
          method: 'post',
          url: `/api/cart/getItens?cart=${JSON.stringify(response1.data)}`
        }).then((response) => {
          this.Cart = response.data
        })
      })

      this.getCartPrice()
    }
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Bodoni+Moda:opsz,wght@6..96,400..900&display=swap');

#highlight-value {
  font-weight: 900;
}

.nav-link:hover,
.navbar-brand:hover {
  cursor: pointer;
}

.cart-image {
  height: 100%;
  border-radius: 20px;
}

.prices {
  justify-content: flex-end;
  display: flex;
}

.price {
  padding-bottom: 0.2em;
  display: flex;
  justify-content: flex-end;
}

.title {
  display: flex;
  overflow: hidden;
  text-wrap: wrap;
  width: 13em;
  text-overflow: ellipsis;
}

#delete-item {
  display: none;
  color: red
}

.cart-content-item:hover {
  #delete-item {
    font-size: 62px;
    cursor: pointer;
    display: flex;
    justify-content: flex-end;
    color: red
  }
}

.cart-item-info {
  justify-content: center;
  width: 100%;
  margin-left: 1em;
  margin-right: 1em;
}

.cartValue {
  font-size: medium;
}

.cart-itens {
  overflow: auto;
  display: flex;
  flex-direction: column;
}

.cart-content-item {
  margin-bottom: 1em;
  margin-left: 1em;
  margin-right: 1em;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  align-items: center;
  display: flex;
  max-height: 122px;
  background-color: #fafafa;
  color: #000;
  border-radius: 20px;
  font-size: 28px;
  font-weight: 600;
}

.cart-value {
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.cart-price {
  display: flex;
  flex-direction: column;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 1.4em;
  gap: 0.5em;
  font-style: normal;
  font-weight: bolder;
}

.cart-finish {
  justify-content: space-between;
  align-items: center;
  display: flex;
}

.start-shopping:hover {
  cursor: pointer;
}

.start-shopping {
  background-color: #000;
  color: #fafafa;
  font-size: large;
  padding: 1em;
}

.cart-empty {
  height: 100%;
  justify-content: center;
  align-items: center;
  font-style: normal;
  gap: 1em;
  color: #000;
  display: flex;
  flex-direction: column;
}

.cart-content {
  display: flex;
  flex-direction: column;
  height: 55.5em;

}

.cart-finish {
  background-color: #000;
  padding: 1em;
}

.finish-purchase:hover {
  cursor: pointer;
  background-color: #000;
  color: #fafafa;

  #cart-finish {
    color: #fafafa;
  }
}

#cart-finish {
  color: #000;
}

.finish-purchase {
  padding: 0.2em;
  color: #000;
  background-color: #fafafa;
  border: transparent;
  border-radius: 10px;
  gap: 0.2em;
  font-style: normal;
  font-weight: 700;
  display: flex;
  align-items: center;
  font-size: larger;
}


#account,
#cart {
  color: #fafafa;
}

#searchButton:hover {
  cursor: pointer;
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

.search-bar {
  height: 2;
  width: 50%;
  display: flex;
  padding: 0px;
  border: #000 solid;
  background-color: #fafafa;
  border-radius: 12px;
}

.search-input:focus-visible {
  outline: none;
}

.search-input,
.search-input::placeholder {
  font-size: larger;
  margin-left: 1em;
}

.search-input {
  width: 100%;
  background-color: transparent;
  border: #000;
}

.brand-div {
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

.nav-text {
  margin: 0px;
}

@-webkit-keyframes scale-up-tr {
  0% {
    -webkit-transform: scale(.5);
    transform: scale(.5);
    -webkit-transform-origin: 100% 0;
    transform-origin: 100% 0
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    -webkit-transform-origin: 100% 0;
    transform-origin: 100% 0
  }
}

@keyframes scale-up-tr {
  0% {
    -webkit-transform: scale(.5);
    transform: scale(.5);
    -webkit-transform-origin: 100% 0;
    transform-origin: 100% 0
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    -webkit-transform-origin: 100% 0;
    transform-origin: 100% 0
  }
}

.cart-container {
  -webkit-animation: scale-up-tr .3s cubic-bezier(.39, .575, .565, 1.000) both;
  animation: scale-up-tr .1s cubic-bezier(.39, .575, .565, 1.000) both
}

.cart-back {
  padding-left: 1em;
  padding-right: 1em;
  font-style: normal;
  justify-content: space-between;
  align-items: center;
  display: flex;
  height: 5em;
  background-color: #000;
}

.cart-container {
  background-color: aliceblue;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  right: 0;
  top: 0;
  position: absolute;
  width: 42em;
  height: 67.5em
}

#cartSwitch:hover {
  cursor: pointer;
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
  text-decoration: none;
}
</style>
