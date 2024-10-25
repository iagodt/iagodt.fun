<template>
    <div class="product-card">
        <div v-if="Item.discount != null" class="discount">{{ Item.discount + '% OFF' }}</div>
        <a :href="$router.resolve({ name: 'ProductPage', params: { product: Item.id } }).href" class="product-link">
            <img v-if="Item.discount != null" :src="'/storage/' + Item.images[0].image" :alt="Item.name"
                class="product-image" />
            <img v-else :src="'/storage/' + Item.Icon" :alt="Item.name" class="product-image"
                style="border-top-left-radius: 10px; border-top-right-radius: 10px;" />
            <div class="product-info">
                <h3 class="product-name">{{ Item.name }}</h3>
                <div class="prices">
                    <span v-if="Item.discount != null" class="original-price">{{ 'R$ ' + Item.price }}</span>
                    <span class="discounted-price">{{ 'R$ ' + (Item.price - (Item.price * (1 * (Item.discount /
                        100)))).toFixed(2)
                        }}</span>
                </div>
                <div class="installments">{{ Item.installment }}</div>

            </div>
        </a>
        <div class="buttons-container">
            <div class="buttons-div">
                <button class="buy-button">COMPRAR</button>
                <button v-on:click="addToCart(Item.id)" class="cart-button">ADICIONAR AO CARRINHO</button>
            </div>
        </div>



    </div>
</template>


<script>
import axios from "axios";
export default {
    props: ['Item'],
    methods: {
        addToCart: async function (item) {
            if (JSON.parse(localStorage.vuex).isAuthenticated) {
                await axios({
                    method: 'post',
                    url: `/api/usercart/add?product_id=${item}`,
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.token
                    }
                }).then((response) => {
                    // aqui vc da uma polida e coloca uns popup noticacao esses frufru pra avisar que o item ja esta no carrinho :)
                })
            } else {
                await axios({
                    method: 'post',
                    url: `/api/cart/add?id=${item}`
                }).then((response) => {
                    if (!localStorage.getItem('cart')) {
                        const cart = [{ ...response.data, quantity: 1 }];
                        localStorage.setItem('cart', JSON.stringify(cart));
                    } else {
                        let tempLocalStorage = JSON.parse(localStorage.getItem('cart'));
                        const productIndex = tempLocalStorage.findIndex(element => element.product_id === response.data.product_id);

                        if (productIndex !== -1) {
                            tempLocalStorage[productIndex].quantity += 1;
                        } else {
                            tempLocalStorage.push({ ...response.data, quantity: 1 });
                        }

                        localStorage.setItem('cart', JSON.stringify(tempLocalStorage));
                    }
                })
            }
        }
    }
}
</script>


<style scoped>
.prices {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-wrap: nowrap;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
}

.buttons-container {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    height: 100%;
}

.buttons-div {
    display: flex;
}

.product-link {
    color: #1a1a1a;
    text-decoration: none;
}

.product-card {
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    display: flex;
    font-style: normal;
    color: #1a1a1a;
    border-radius: 10px;
    max-width: 350px;
    text-align: center;
    flex-direction: column;
    padding-bottom: 2em;
}


.product-image {
    width: 100%;
    height: auto;
}

.product-info {
    margin-top: 20px;
}

.product-name {
    padding-left: 1em;
    padding-right: 1em;
    font-size: 1.2em;
    margin-bottom: 10px;
}

.original-price {
    font-size: 24px;
    text-decoration: line-through;
    color: #888;
}

.discounted-price {
    font-weight: 600;
    font-size: 36px;
    color: #1a1a1a;
}

.installments {
    margin-bottom: 2.5em;
}

.discount {
    color: #fafafa;
    background-color: #000;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.cart-button,
.buy-button {
    background-color: #000;
    color: #fff;
    padding: 1em;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    width: 100%;
    margin-left: 0.5em;
    margin-right: 0.5em;
}
</style>