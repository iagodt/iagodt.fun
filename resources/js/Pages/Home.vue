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
.highlight-container{
    display: flex;
    gap: 2em;
    margin: 2em;
    flex-wrap: wrap;
    justify-content: center;
}

</style>