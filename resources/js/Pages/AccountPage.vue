<template>
<div v-if="isAuthenticated">
    <h1 class="a1235152">{{ this.$store.state.user }}</h1>
    <button v-on:click="leave">logout</button>
</div>
</template>

<script>
import LoginPopUp from '@/components/loginPopUp.vue';
import { mapGetters,mapActions } from 'vuex';


export default{
components:{LoginPopUp},
computed: {
    ...mapGetters({
        isAuthenticated: 'isAuthenticated'
    })
},
methods:{
    ...mapActions({
        logout: 'logout'
    }),

    leave(){
        this.logout()
        this.$router.push('/login')
    }
}
}
</script>
<style scoped>
.a1235152{
    color: #000;
}
</style>