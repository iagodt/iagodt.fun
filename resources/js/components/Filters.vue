<template>
    <div class="filter-section">
        <h2>Filtrar por</h2>
        <h3>PREÇO</h3>
        <div class="filter-item">
            <div class="price-range">
            <div class="range-filter">
                <div>De</div>
                <input v-model="minFilter"  type="text" placeholder="119">
            </div>
            <div class="range-filter">   
                <div>Até</div>
                <input v-model="maxFilter" type="text" placeholder="690">
            </div>
            <button v-on:click="priceFilter"> ></button>
            </div>
        </div>
        <div v-on:click="filterClear" class="btn-view-all">LIMPAR FILTROS</div>

        <div v-for="filter, name in filters">
            <h3>{{ name }}</h3>
            <div class="filter-item" v-for="key in filter">
                <input v-on:click="Filter(key)" type="checkbox" :id="key">
                <label :for="key">{{ key }}</label>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            minFilter: null,
            maxFilter: null,
            filters: null,
            activeFilters: []
        }
    },
    methods: {
        filterClear(){
            this.activeFilters.forEach((element)=>{
                document.getElementById(element).checked = false
            })
            this.$emit('FilterClear')
        },

        priceFilter(){
            this.$emit('priceFilter',{min: this.minFilter,max:this.maxFilter})
        },

        async getFilters() {
            const _this = this
            await axios({
                method: 'get',
                url: '/api/attributes/get'
            }).then(function (response) {
                _this.filters = response.data
            })
        },
        async Filter(filter){
            if(!document.getElementById(filter).checked){
                this.activeFilters.splice(this.activeFilters.indexOf(filter),1)
            }else{
                this.activeFilters.push(filter)
            }
            if(this.activeFilters.length <= 0){
                this.$emit('updateFilters',null)
            }
            await axios({
                method: 'get',
                url: `/api/attributes/filter?filter=${this.activeFilters}`
            }).then((response)=>{
                this.$emit('updateFilters',response.data)
            })
        }
    },

    async created() {
        await this.getFilters()
    }
}
</script>

<style scoped>
.range-filter{
    font-style: normal;
    text-align: center;
}
.price-range {
    display: flex;
    align-items: flex-end;
}

.price-range div {
    margin-right: 10px;
    font-size: 12px;
}

.price-range input {
    width: 50px;
    height: 30px;
    border: 1px solid #ccc;
    border-radius: 10px;
    text-align: center;
    font-size: 14px;
}

.price-range button {
    width: 30px;
    height: 30px;
    border: 1px solid #ccc;
    border-radius: 50%;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.price-range button i {
    font-size: 14px;
    color: #ccc;
}

.filter-section {
    font-style: normal;
    width: 200px;
}

.filter-section h2 {
    font-size: 24px;
    font-weight: bold;
}

.filter-section h3 {
    font-size: 18px;
    margin-top: 20px;
}

.filter-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.filter-item input {
    margin-right: 10px;
}

.color-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    display: inline-block;
    margin-left: 5px;
}

.btn-view-all {
    display: inline-block;
    padding: 5px 10px;
    border: 1px solid black;
    border-radius: 20px;
    text-align: center;
    margin-top: 10px;
    cursor: pointer;
}
</style>