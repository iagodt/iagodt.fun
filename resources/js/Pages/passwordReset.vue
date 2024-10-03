<template>
    <div class="LoginPage">
        
        <div v-if="passwordChanged == false" id="login-popup" class="popup">
        <h2>Digite sua nova senha</h2>
        <div v-if="error == true" id="login-popup" class="popup">
            <h4>Algo deu errado na sua solicitação. Tente novamente.</h4>
            </div>
        <form class="login-form" @submit.prevent="resetPassword" >
            <div class="form-group">
                <input type="password" id="password" v-model="password" name="password" placeholder="Nova senha" required>
            </div>
            <div class="form-group">
                <input type="password" id="ConfirmPassword" v-model="ConfirmPassword" name="password" placeholder="Confirme a Senha" required>
            </div>
            <button type="submit" class="button">RESETAR SENHA</button>
        </form>
        
    </div>
    <div v-else id="login-popup" class="popup">
            <h2>Esqueci minha senha</h2>
            <h4>Sua senha foi alterada com sucesso</h4>
        </div>
        
    </div>
    
</template>
<script>
// auth/recovery-password

export default{
    data(){
        return{
            password:null,
            passwordChanged:false,
            ConfirmPassword:null,
            error:false
        }
    },
    methods:{
        async resetPassword(){
            const _this = this
            let token = this.$route.query.token ?? alert('Acesso nao permitido')
            let email = this.$route.query.email ?? alert('Acesso nao permitido')
            await axios({
                method: 'post',
                url: `/auth/recovery-password?token=${token}&email=${email}&password=${this.checkPassword()}`,

            }).then(function(response){
                if(response.status == 200){
                    _this.passwordChanged = true
                }
            }).catch(function(error){
                _this.error = true
            })
        },
        checkPassword(){
            if(this.password == this.ConfirmPassword){
                return this.password
            }
            else{
                alert('As senhas não coincidem')
            }
        },
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