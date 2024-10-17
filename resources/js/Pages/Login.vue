<template>
    <div class="LoginPage">
        <div id="login-popup" class="popup">
            <h2>Login</h2>
            <form class="login-form" @submit.prevent="Logon">
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email"
                        required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Senha"
                        required>
                </div>
                <button type="submit" class="button">LOGIN</button>
            </form>
            <h6><a class="register-link" href="/passwordrecovery">Esqueceu a senha?</a></h6>
            <div class="oauth">
                <h2 class="oauth-text">Entrar com:</h2>
                <a href="/auth/google/redirect"><img class="oauth-img"
                    src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg">
                </a>
                </div>
            <h4>Não cadastrado? <a href="/register" class="register-link">Cadastre-se</a></h4>
        </div>
    </div>

</template>
<script>
import { mapActions } from 'vuex';
export default {
    data(){
        return{
        }
    },
    methods: {
        ...mapActions({ Login: 'login' }),
        async Logon() {
            await this.Login({email: document.getElementById('email').value.toString(), password: document.getElementById('password').value.toString()})
            this.$router.push('/account')
        },

    },

}
</script>

<style scoped>
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
    height: 32em;
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