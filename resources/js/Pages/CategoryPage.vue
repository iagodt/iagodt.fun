<template>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <h1 class="header">{{ categoryName }}</h1>
    <div class="main">
        <Filters @FilterClear="FilterClear" @updateFilters="Filtered" @priceFilter="PriceFilter" class="filters-body"/>
        <div class="grid-container">
            <div class="itens-container">
                <ItemCard v-for="Item in categoryData" :Item="Item"/>
            </div>  
        </div>
    </div>
    
    
    
</template>

<script>
import ItemCard from '@/components/ItemCard.vue';
import Filters from '../components/Filters.vue';

export default {
    components:{ItemCard,Filters},
    data(){
        return{
            categoryName: null,
            categoryData: [],
        }
    },
    methods:{
        async getCategory(){
            const _this = this
            var category = await globalThis.location.pathname.split('/')[2]
            _this.categoryName = category
            await axios({
                    method: 'get',
                    url: `/api/category/get?category=${category}`
                }).then(function (response) {
                    _this.categoryData = response.data

                })
        },

        async FilterClear(){
            await this.getCategory();
        },

        async PriceFilter(filter) {
            const min = Number(filter.min) || 0;
            const max = Number(filter.max) || 100000000;

            await this.getCategory();

            this.categoryData = this.categoryData.filter(element => {
                const price = Number(element.price);
                return price > min && price < max;
            });
        },

        async Filtered(array){
            if(array == null){
                await this.getCategory()
            }else{
                this.categoryData = array
            }
        }
    },
    async created(){
        await this.getCategory()
    }
}
</script>
<style scoped>
.filters-body{
    color: #000;

}
.main{
    display: flex;
    justify-content: center;
    gap: 2em;
}
.grid-container{
    
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}
.itens-container{
    display: grid;
    grid-template-columns: repeat(4,18em);
    gap: 1em;
}
</style>