<template>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <div class="main-container">
        <div class="gallery-container">
            <Carousel id="gallery" :items-to-show="1" :wrap-around="false" v-model="currentSlide">
                <Slide class="slide-main" v-for="slide in ItemImages" :key="slide">
                    <div class="carousel__item">
                        <img class="main-image" :src="ItemImages[currentSlide]" alt="">
                    </div>
                </Slide>
            </Carousel>

            <Carousel id="thumbnails" :items-to-show="4" :wrap-around="true" v-model="currentSlide" ref="carousel">
                <Slide class="slide-nav" v-for="slide in ItemImages" :key="slide" style="width: fit-content;">
                    <div id="nav-items" class="carousel__item" @click="slideTo(ItemImages.indexOf(slide))"><img
                            class="nav-images" :src="slide" alt=""></div>
                </Slide>
                <template #addons>
                    <Navigation />
                </template>
            </Carousel>

        </div>
        <div class="infos-container">
            <div class="Title">
                <span class="Item-name">{{ ItemData.name }}</span>
                <span v-if="ItemData.discount < 0 || ItemData.discount != ''" class="Item-discount">{{ ItemData.discount
                    +
                    '%OFF' }}</span>
            </div>
            <div class="Prices">
                <div v-if="ItemData.discount < 0 || ItemData.discount != ''" class="Item-price">{{ 'R$ ' +
                    ItemData.Price }}
                </div>
                <div class="Item-discountedPrice">{{ 'R$ ' + (ItemData.Price-(ItemData.Price*(1*(ItemData.discount/100)))).toFixed(2) }}</div>
            </div>
            <div class="Item-installment">
                <span class="material-symbols-outlined" style="font-size: 36px; margin-right: 0.2em;">
                    credit_card
                </span>
                <p class="Item-installmentText">{{ ItemData.installment }}</p>
            </div>
            <div class="Buy-container">
                <div class="qnt-container">
                    <button class="subQnt" v-on:click="subQuantity">-</button>
                    <input class="inputQnt" type="number" name="qnt" id="qnt" :value="quantity" min="1">
                    <button class="addQnt" v-on:click=" quantity -= -1">+</button>
                </div>
                <button type="button" class="Buy-Button">COMPRAR</button>
            </div>
            <div class="shipping-container">
                <div class="shipping-label">
                    <span class="material-symbols-outlined" style="font-size: 36px; margin-right: 0.2em;">
                        local_shipping
                    </span>
                    <p class="shipping-label-text">Formas de envio</p>
                </div>
                <div class="shipping-button">
                    <input class="cep-input" type="number" name="cep" id="cep" placeholder="Seu CEP" required
                        pattern="\d{5}-\d{3}">
                    <button class="cep-button" :onClick="getCEP">CALCULAR</button>
                </div>
                <div v-if="cepInfo != null && cepError == false" class="shipping-info">
                    <h1 class="shipping-gift">parabens vc ganhou frete gratis</h1>
                    <div>
                        <h3 class="shipping-title">Entregar em</h3>
                        <div class="shipping-item">
                            <div class="shipping-item-container">
            
                                <div class="shipping-item-label">
                                    <p class="shipping-type">FRETE ESPECIAL - {{ cepInfo.localidade+', '+cepInfo.uf }}</p>
                                </div>
                                    <!--  colocar que o frete é 15-25 dias mas com a data tipo 19/10 até 25/10 -->
                                <div class="shippingPrices">
                                    <p class="shipping-price">{{ 'R$ '+shippingPrice }}</p>
                                    <p class="shipping-priceDisconted">{{ 'R$ '+(shippingPrice-shippingPrice) }}</p>
                                </div>
                                    <!-- <input type="checkbox" checked="true" disabled/>  --> 
                            </div>
                            <div class="shipping-estimedTime">
                                <span id="estimedTimeIcon" class="material-symbols-outlined">
                                history
                                </span>
                                <p class="estimedTimeText">chega entre quinta 22/08 e segunda 02/09</p>
                            </div>
                        </div>
                        
                        
                        
                    </div>

                </div>
                <div class="shipping-error" v-if="cepError == true">
                    Desculpe o cep fornecido nao foi encontrado
                </div>
            </div><!--                                            TRUE TRUE                  TRUE FALSE          FALSE FALSE  -->
            <div class="store-infos" :style=" [cepError ? (shipping ? {'margin-top': '3em'} : {'margin-top': '10em'}) : (shipping ? {'margin-top': '2em'} : {'margin-top': '11em'})]">
                <div class="store-item">
                    <span id="store-icon" class="material-symbols-outlined">
verified_user
</span>
                    <div class="store-label">
                        <p class="store-title">SITE SEGURO</p>
                        <p class="store-text">Certificado SSL de Segurança</p>
                    </div>
                </div>
                <div class="store-item">
                    <span id="store-icon" class="material-symbols-outlined">
                        replay
                    </span>
                    <div class="store-label">
                        <p class="store-title">TROCA E DEVOLUÇÃO</p>
                        <p class="store-text">Política de troca e devolução fácil</p>
                    </div>
                </div>
                <div class="store-item">
                    <span id="store-icon" class="material-symbols-outlined">
                        package_2
                    </span>
                    <div class="store-label">
                        <p class="store-title">COMPRA GARANTIDA</p>
                        <p class="store-text">Seu dinheiro está seguro até a entrega do produto.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ItemDescription-Container">
        <div v-html="ItemData.Description"></div>
    </div>
</template>
<script>
import { Carousel, Slide, Navigation } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import axios from 'axios';
export default {
    props: [],
    components: {
        Carousel,
        Slide,
        Navigation,
    },
    data() {
        return {
            currentSlide: 0,
            ItemData: null,
            ItemImages: null,
            quantity: 1,
            shipping: false,
            cepInfo: null,
            cepError: null,
            shippingPrice: 32.50

        }

    },
    methods: {
        teste2(){
            if(this.cepError){
                if(this.shipping){
                    return {'background-color': 'red'} // true true
                }else{
                    return {'background-color': 'green'} // true false
                }
            }else{
                if(this.shipping){
                    return {'background-color': 'blue'} // false true
                }
                return {'background-color': 'yellow'} // false false
            }
        },
        async getCEP(){
            const _this = this
            let cep = document.getElementById('cep').value
            await axios({
                    method: 'get',
                    url: `https://viacep.com.br/ws/${cep}/json/`,
            
                }).then(function (response) {
                    _this.shipping = true
                    _this.cepInfo = response.data
                    _this.cepError = false

                }).catch(function (error){
                    _this.shipping = false
                    _this.cepError = true
                })
            
            console.log(this.shipping,this.cepError)
        },

        subQuantity(){
            if(this.quantity > 1){
                this.quantity += -1
            }
        },
        slideTo(val) {
            this.currentSlide = val
        },
        getImages() {
            const _this = this

            _this.ItemImages = []
            var dataToArray = []
            dataToArray.push(this.ItemData.Icon,
                this.ItemData.Image1,
                this.ItemData.Image2,
                this.ItemData.Image3,
                this.ItemData.Image4,
                this.ItemData.Image5,
                this.ItemData.Image6)

            dataToArray.forEach(element => {
                if (element != null) {
                    let elementlink = '/storage/' + element

                    _this.ItemImages.push(elementlink)
                }
            });


        },
        getItem: async function () {
            const _this = this
            var id = this.$route.params.id
            var product = await globalThis.location.pathname.split('/')[2]
            if (id == null) {
                console.log('by name')
                await axios({
                    method: 'get',
                    url: `/api/itens/get?name=${product}`
                }).then(function (response) {
                    _this.ItemData = response.data

                })
            } else {
                console.log('by id')
                await axios({
                    method: 'get',
                    url: `/api/itens/get?id=${id}`
                }).then(function (response) {
                    _this.ItemData = response.data
                })
            }

        }
    },
    async created() {
        await this.getItem()
        this.getImages()
    }
}
</script>

<style scoped>
.shipping-title{
    margin: 0px;
    font-style: normal;
}
.shipping-gift{
    font-size: medium;
    display: flex;
    margin-top: 0.5em;
    border-radius: 10px;
    background-color: #2cbc63;
    color: #fafafa;
    padding: 0.5em;
    text-align: center;
    justify-content: center;
}
.shipping-type{
    margin: 0px;
    font-style: normal;
}
.shipping-item{
    padding: 1em;
    border-radius: 10px;
    -webkit-box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
-moz-box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;

}
#estimedTimeIcon{
    color: #888;
}
.estimedTimeText{
    color: #888;
    margin: 0px;
}
.shipping-estimedTime{
    display: flex;
    align-items: center;
    gap: 0.2em;
}
.shippingPrices{
    display: flex;
    gap: 0.5em;
    align-items: center;
}
.shipping-priceDisconted{
    font-weight: bold;
    font-size: x-large;
}
.shipping-price{
    color: #888;
    text-decoration: line-through;
}
.shipping-priceDisconted,
.shipping-price{
    font-family: ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
    font-style: normal;
    margin: 0px;
}
.shipping-item-container{
    justify-content: space-between;
    align-items: center;
    display: flex;
}
.shipping-error{
    display: flex;
    margin-top: 0.5em;
    border-radius: 10px;
    background-color: #e75252;
    color: #fafafa;
    padding: 0.5em;
    text-align: center;
    justify-content: center;
}

#store-icon{
    font-size: 64px;
}
.store-text{
    margin-top: 0.2em;
    font-size: small;
    margin-left: 0.5em;
}
.store-title{
    margin-bottom: 0px;
    margin-left: 0.5em;
    font-weight: bolder;
}
.store-item{
    display: flex;
    align-items: center;
    max-width: 15em;
    min-width: 10em;
}
.store-infos{
    display: flex;
    gap: 1em;
}

.shipping-button{
    display: flex;
}
.cep-button:hover{
    background-color: #000;
    color: #fafafa;
    cursor: pointer;
}
.cep-button{
    width: 40%;
    font-size: large;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-top: 0px;
    border-bottom: 0px;
    border-right: 0px;
    border: #000 solid 2px;
    background-color: transparent;
}
.cep-input:focus-visible{
    outline: none;
}

.cep-input::-webkit-inner-spin-button,
.cep-input::-webkit-outer-spin-button{
    -webkit-appearance: none; 
    margin: 0;
}
.cep-input{
    padding-left: 1em;
    background-color: transparent;
    height: 2em;
    width: 60%;
    font-size: large;
    border: #888 solid 1px;
    border-right: 0px;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.shipping-label{
    display: flex;
    align-items: center;
    margin-top: 1em;
}
.inputQnt{
    width: 3em;
    text-align: center;
    color: #888;
}
.inputQnt:focus-visible{
    outline: none;
}
.inputQnt::-webkit-inner-spin-button, 
.inputQnt::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
.addQnt,
.inputQnt,
.subQnt{
    margin: 0px;
    border: none;
    background-color: transparent;
    font-size: x-large;

}
.addQnt,.subQnt{
    cursor: pointer;
    width: 1em;
}
.qnt-container{
    border: #888 solid 1px;
    width: fit-content;
    border-radius: 15px;
    display: flex;
    margin-right: 1em;
}
.Buy-Button{
    background-color: #000;
    color: #fafafa;
    border: #000 solid;
    width: 100%;
    border-radius: 25px;
    padding-top: 0.2em;
    padding-bottom: 0.2em;

    font-size: x-large;
}
.Buy-Button:hover{
    background-color: #fafafa;
    color: #000;
    cursor: pointer;    

}
.Buy-container{
    margin-top: 2em;
    display: flex;
}
.Item-installmentText{
    font-size: larger;
    font-weight: 800;
    font-style: normal;
    font-family: system-ui;
}
.ItemDescription-Container {
    color: black;
}

.Item-discountedPrice {
    font-size: 46px;
    font-weight: bolder;
}
.Item-installment{
    display: flex;
    align-items: center;
}
.Item-price {
    font-size: 32px ;
    margin-right: 1em;
    color: #888;
    text-decoration: line-through;
}

.Prices {
    align-items: baseline;
    margin-top: 1em;
    display: flex
}

.Item-price,
.Item-discountedPrice {
    font-family: ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
    font-style: normal;
}

.infos-container {
    width: 32em;
    margin: 2em;
    margin-top: 0px;
}

.Title {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}

.Item-discount {
    margin-top: -3.5em;
    background-color: black;
    color: #fafafa;
    border-radius: 15px;
    font-weight: 1000;
    padding: 0.5em;
    font-family: system-ui;
    margin-inline-start: 7em;;
}

.Item-name {
    font-size: 3em;
    font-style: normal;
    font-weight: bolder;
}

.main-container {
    display: flex;
    color: #1a1a1a;
    justify-content: center;
    margin-top: 11em
}

.gallery-container {
    width: 40em;
    margin-left: 1em;
}

.main-image {
    width: 100%;
    height: 40em;
    border-radius: 10px;
}

.nav-images {
    opacity: 70%;
    border-radius: 10px;
    height: 6em;
}

.nav-images:hover {
    opacity: 100%;
    cursor: pointer;
}

.slide-nav {
    margin-right: 5%;
    margin-left: 5%;
}
</style>
<style>
.carousel__prev,
.carousel__next {
    margin: 0px;
    background-color: #000;
    color: #fafafa;
}

.carousel__prev {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

.carousel__next {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.carousel__prev:hover,
.carousel__next:hover {
    background-color: #fafafa;
    color: #000;
}
</style>