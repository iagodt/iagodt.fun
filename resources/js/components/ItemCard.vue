<template>
    <div class="product-card">
        <div v-if="Item.discount != ''|| Item.discount > 0" class="discount">{{ Item.discount+'% OFF' }}</div>
        <RouterLink :to="{ name: 'ProductPage', params: { product: Item.name, id: Item.id }}" class="product-link">
            <img v-if="Item.discount != ''|| Item.discount > 0" :src="'/storage/'+Item.Icon" :alt="Item.name" class="product-image" />
            <img v-else :src="'/storage/'+Item.Icon" :alt="Item.name" class="product-image" style="border-top-left-radius: 10px; border-top-right-radius: 10px;"/>
            <div class="product-info">
                <h3 class="product-name">{{ Item.name }}</h3>
                <div class="prices">
                    <span v-if="Item.discount < 0 || Item.discount != ''" class="original-price">{{ 'R$ '+Item.Price }}</span>
                    <span class="discounted-price">{{'R$ '+(Item.Price-(Item.Price*(1*(Item.discount/100)))).toFixed(2) }}</span>
                </div>
                <div class="installments">{{ Item.installment }}</div>

            </div>
        </RouterLink>
        <div  class="buttons-div">
            <button class="buy-button">COMPRAR</button>
            <button class="cart-button">ADICIONAR AO CARRINHO</button>
        </div>
        

    </div>
</template>


<script>
export default {
    props: ['Item'],

}
</script>


<style scoped>
.prices{
    font-family: 'Times New Roman', Times, serif;
}
.buttons-div {
    display: flex;
}

.product-link {
    color: #1a1a1a;
    text-decoration: none;
}

.product-card {
    display: flex;
    font-style: normal;
    color: #1a1a1a;
    border: 1px solid #a8a8a8;
    border-radius: 10px;
    max-width: 300px;
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
    font-size: 1.2em;
    margin-bottom: 10px;
}


.prices {
    margin: 10px 0;
}

.original-price {
    text-decoration: line-through;
    color: #888;
    margin-right: 1em;
}

.discounted-price {
    font-size: 1.5em;
    color: #1a1a1a;
}

.installments {
    margin-bottom: 2.5em;
}
.discount{
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