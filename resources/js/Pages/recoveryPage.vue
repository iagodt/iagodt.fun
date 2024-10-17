<template>
    <div class="LoginPage">
        <div v-if="emailsended == false" id="login-popup" class="popup">
            <h2>Esqueci minha senha</h2>
            <p class="recovery-text">Para recuperar sua senha, por favor, digite seu email abaixo. Vamos enviar um email com o link de recuperação de senha para você.</p>
            <form class="login-form" @submit.prevent="sendResetLink">
                <div class="form-group">
                    <input type="email" v-model="email" id="emailTel" name="emailTel" placeholder="E-mail"
                        required>
                </div>
                <button type="submit" class="button">ENVIAR LINK</button>
            </form>
        </div>
        <div v-else id="login-popup" class="popup">
            <h2>Esqueci minha senha</h2>
            <h4>O e-mail para resetar a sua senha foi enviado com sucesso</h4>
        </div>
    </div>

</template>
<script>
import axios from 'axios';

export default{
    data(){
        return{
            emailsended:false,
            email:null
        }
    },
    methods:{
        async sendResetLink(){
            const _this = this
            await axios({
                method: 'post',
                url: `/auth/forgot-password?email=${this.email}`,

            }).then(function(response){
                if(response.status == 200){
                    _this.emailsended = true
                }
            })
        }
    }
}
</script>


<style scoped>
.recovery-text{
    width: 32em;
    text-wrap: pretty;
    font-style: normal;
    font-size: 12px;
}
a{
    color: #000;
    text-decoration: none;
}
h6{
    margin-bottom: 0px;
    margin-top: 1em;
}
.LoginPage {
    zoom: 1.5;
    font-size: 16px;
    display: flex;
    height: 36em;
    justify-content: center;
}

.register-link:hover {
    cursor: pointer;
}

.oauth-img:hover {
    cursor: pointer;
}

.login-form,
.oauth {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.popup {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #000;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
}


.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input {
    width: 30em;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

.button {
    background-color: #000;
    color: #fafafa;
    padding: 10px 20px;
    border: none;
    width: 30em;
    border-radius: 20px;
    cursor: pointer;
}
</style>