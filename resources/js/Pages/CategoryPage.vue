<template>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <h1 class="header">{{ categoryName }}</h1>
    <div class="main">
        <div class="filter">
            <span class="filter-label">Filtrar por</span>
            <span class="filter-name">Preço</span>
            <div class="filter-input-container">
                <div class="filter-input-div">
                    <span class="filter-input-label">De</span>
                    <input class="filter-input" type="number" step="0.01" placeholder="0,00">
                </div>
                <div class="filter-input-div">
                    <span class="filter-input-label">Até</span>
                    <input class="filter-input" type="number" step="0.01" placeholder="0,00">
                </div>
                <span id="submit-filter" class="material-symbols-outlined">arrow_forward_ios</span>
            </div>
        </div>
        <div class="grid-container">
            <div class="itens-container">
                <ItemCard v-for="Item in categoryData" :Item="Item"/>
                <ItemCard v-for="Item in categoryData" :Item="Item"/>
                <ItemCard v-for="Item in categoryData" :Item="Item"/>
                <ItemCard v-for="Item in categoryData" :Item="Item"/>
            </div>  
        </div>
    </div>
    
    
    
</template>

<script>
import ItemCard from '@/components/ItemCard.vue';

export default {
    components:{ItemCard},
    data(){
        return{
            categoryName: null,
            categoryData: null,
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

        }
    },
    async created(){

        await this.getCategory()
    }
}
</script>
<style scoped>
#submit-filter:hover{
    cursor: pointer;
}
#submit-filter{
    background-color: #ccc;
    padding: 0.2em;
    border-radius: 100%;
}
.filter-input-label{
    font-weight: 600;
    font-size: 24px;
    font-style: normal;
}

.filter-input::-webkit-inner-spin-button,
.filter-input::-webkit-outer-spin-button{
    -webkit-appearance: none; 
    margin: 0;
}
.filter-input:focus-visible{
    outline: none;
}
.filter-input{
    border-radius: 1em;
    border: transparent;
    background-color: #ccc;
    font-size: 24px;
    padding-left: 1em;
    padding-top: 0.2em;
    padding-bottom: 0.2em;
    width: 4em;
}
.filter-input-div{
    display: flex;
    flex-direction: column;
    align-items: center
}
.filter-input-container{
    gap: 1em;
    align-items: last baseline;
    display: flex;
    justify-content: space-between;
}
.header{
    color: #000;
    display: flex;
    justify-content: center;
    font-size: 72px;

}
.filter-label{
    font-weight: 700;
    font-size: 50px;
}
.filter-name{
    font-weight: 700;
    font-size: 32px;
}
.filter{
    display: flex;
    flex-direction: column;
    gap: 1em;
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
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24
}

</style>