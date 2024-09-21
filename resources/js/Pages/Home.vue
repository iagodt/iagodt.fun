<template>
    <div class="carousel-container">
        <CarouselBanner/>
    </div>
    <div class="highlight-container">
        <HighligthsItensCard 
            v-for="Highlight in  Highlights"
            :Highlight="Highlight"
        />
    </div>
    <div class="vipNewsletter">
        <div class="NLtitle">NEWSLETTER</div>
        <div class="NLText1">Vem ser cliente VIP!</div>
        <div class="NLText2">Quer receber as melhores ofertas? Cadastre-se e as receba direto no seu e-mail</div>
        <div class="NLemail">
            <input class="NLemail-input" type="email" placeholder="E-mail">
            <span id="NLemail-icon" class="material-symbols-outlined">
            arrow_forward
            </span>
        </div>
    </div>
    
    <ItemCard v-for="Item in Itens"
    :Item="Item"/>
</template>
<script>
import HighligthsItensCard from '@/components/HighligthsItensCard.vue';
import axios from 'axios';
import CarouselBanner from '@/components/CarouselBanner.vue';
import ItemCard from '@/components/ItemCard.vue';
export default {
    components: { HighligthsItensCard, CarouselBanner, ItemCard },
    data(){
        return{
            Highlights: null,
            Itens: null
        }
    },
    methods:{
        getHighlights: async function(){
            const _this = this;

            await axios({
                method: 'get',
                url: '/api/highlights/get'
            }).then(function(response){
                _this.Highlights = response.data
            })
        },
        getItens: async function(){
            const _this = this;

            await axios({
                method: 'get',
                url: '/api/itens/index'
            }).then(function(response){
                _this.Itens = response.data
            })
        }
    },
    async created(){
        await this.getHighlights();
        await this.getItens();
    }
}


</script>

<style scoped>
#NLemail-icon:hover{
    cursor: pointer;
}
#NLemail-icon{
    font-size: 36px;
    margin-right: 1em;
    color: #000;
}
.NLemail-input{
    font-size: 24px;
    margin-left: 1em;
    border: #fafafa solid;
    width: 100%;
}
.NLemail-input:focus-visible{
    outline: none;
}
.NLemail{
    height: 3em;
    align-items: center;
    display: flex;
    justify-content: space-between;
    background-color: #fafafa;
    width: 50%;
    border-radius: 10px;
}
.NLText2{
    margin-bottom: 3em;
}
.NLText1{
    margin-top: 1em;
    margin-bottom: 1em;
    font-size: xx-large;
    font-weight: bold;
}
.vipNewsletter{
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 4em;
    font-style: normal;
    text-align: center;
    background-color: #000;
}
.highlight-container{
    display: flex;
    gap: 2em;
    margin: 2em;
    flex-wrap: wrap;
    justify-content: center;
}

</style>