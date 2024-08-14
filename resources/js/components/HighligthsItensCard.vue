<template>
    <div class="item-card">
        <a class="item-container" :href="Highlight.Link">
            
            <img class="item-img" v-bind:src="'/storage/'+Highlight.Image" alt="">
            <div class="item-infos">
                <p class="item-name">{{ Highlight.name }}</p>
                <p class="item-desc">{{Highlight.Description}}</p>
            </div>
        </a>
    </div>
</template>
<script>
export default{
    props: ['Highlight'],
}

</script>

<style scoped>
.item-link{
    display: flex;
    color: #fafafa;
    text-decoration: none;
    width: 100%;
    height: 100%;
}
.item-img{
    width: 100%;
    height: 70%;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.item-card{
    margin-left: 0px;
    padding-left: 0px;
    width: 20em;
    height: 33em;
    border-radius: 10px;

}
.item-container{
    color: #fafafa;
    text-decoration: none;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.item-infos{
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    background-color: black;
    height: 30%;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
.item-name, .item-desc{
    display: flex;
    justify-content: center;
}
.item-name{
    font-size: x-large;
    margin-bottom: 0px;
}
.item-desc{
    margin-top: 0px;
    text-align: center;
    font-size: small;

}
</style>