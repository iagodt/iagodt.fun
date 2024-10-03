<template>
    <h2>Redirecting...</h2>
</template>

<script>
import { mapActions } from 'vuex';

export default{
    methods:{
        ...mapActions({ googleLogin: 'googleLogin'})
    },

    async created(){
        const urlParams = new URLSearchParams(window.location.search);
        await this.googleLogin(urlParams.get('token'))
        this.$router.push('/account')
    }
}

</script>