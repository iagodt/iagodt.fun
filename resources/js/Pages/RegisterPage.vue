<template>
    <div class="LoginPage">
        <div id="login-popup" class="popup">
        <h2>Cadastre-se</h2>
        <form class="login-form" @submit.prevent="register" >
            <div class="form-group">
                <input type="text" id="username" v-model="username" name="username" placeholder="Nome de usuario" required>
            </div>
            <div class="form-group">
                <input type="text" id="emailTel" v-model="emailTel" name="username" placeholder="Email ou Telefone" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" v-model="password" name="password" placeholder="Senha" required>
            </div>
            <div class="form-group">
                <input type="password" id="ConfirmPassword" v-model="ConfirmPassword" name="password" placeholder="Confirme a Senha" required>
            </div>
            <button type="submit" class="button">Resgistrar</button>
        </form>
        <div class="oauth">
          <h2 class="oauth-text">Entrar com:</h2>
          <img class="oauth-img" src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg">
        </div>
    </div>
    </div>
    
</template>

<script>
import axios from 'axios';
import { mapActions } from 'vuex';

export default{
    data(){
        return{
            username: '',
            emailTel: '',
            password: '',
            ConfirmPassword: ''
        }
    },
    methods: {
        ...mapActions({ Login: 'login' }),
        async register(){
            await axios({
                method: 'post',
                url: '/auth/register',
                data: this.registerData()

            }).then(function(response){
                if(response.status == 200){

                }
            })
            let userdata = this.registerData()
            await this.Login({email: userdata.email, password: userdata.password})
            this.$router.push('/account')
        },
        verifyEmailOrTel() {
            let k = document.getElementById('emailTel').value.toString()
            if (k.toLowerCase().match(
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )) {
                // email valido
                return true
            }
            if (!isNaN(k) && k != '') {
                if(k.match(/^[1-9]{2}(?:[2-8]|9[0-9])[0-9]{3}[0-9]{4}$/)){
                    //tel valido
                    return true
                }
            }
            alert('Email ou telefone invalido, para telefones ultilize apenas numeros')

        },
        registerData(){
            if(this.checkPassword()){
                if(this.verifyEmailOrTel()){
                    return {
                    username: this.username,
                    email: this.emailTel,
                    password: this.password
                }
                }
                
            }
        },  
        checkPassword(){
            if(this.password == this.ConfirmPassword){
                return true
            }
            else{
                alert('As senhas não coincidem')
                return false
            }
        }
    }
}
</script>

<style scoped>
.LoginPage{
    zoom: 1.5;
    display: flex;
    height: 32em;
    justify-content: center;
}

.register-link:hover{
  cursor: pointer;
}
.oauth-img:hover{
  cursor: pointer;
}
.login-form,.oauth{
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