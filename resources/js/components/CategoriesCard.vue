<template>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <router-link :to="getRouterLink(category)" class="cat-item">
        
        <p>{{ category.title }}</p>

    </router-link>
   
</template>
<script>

export default {
    props: ['category'],
    methods:{
        getRouterLink(category){
            return `/category/${category.title}`
        }
    }
}
</script>
<style scoped>
.cat-item{
    align-items: center;
    display: flex;
    color: #fafafa;
    text-decoration: none;
}
.material-symbols-outlined {
    color: #fafafa;
    font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 48;
}
</style>
