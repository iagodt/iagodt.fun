<template>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <div class="Register-page">
        <div class="register-form">
            <h1>Criar uma conta</h1>
            <form class="form-container" @submit.prevent="register">
                <div>
                    <input type="text" id="username" v-model="formData.name" placeholder="Nome de usuario:" required></input>
                </div>
                <div>
                    <input type="email" id="email" placeholder="Email:" v-model="formData.email" required>
                </div>
                <div class="password-div">
                    <input type="password" id="password" placeholder="Senha:" v-model="formData.password" required>
                    <div class="show-password" id="show-password">
                        
                    <span v-on:click="ViewPassword('password')" id="viewPasword" class="material-symbols-outlined">visibility</span> Mostrar senha
                    </div>
                </div>
                <div id="confirmation-div" class="password-div">
                    <input type="password" id="password_confirmation" placeholder="Confirmar Senha:"
                        v-model="formData.password_confirmation" required>
                        <div class="show-password">
                            
                    <span v-on:click="ViewPassword('password_confirmation')" id="viewPasword" class="material-symbols-outlined">visibility</span> Mostrar senha
                        </div>
                </div>
                <button type="submit">Criar conta</button>
            </form>
            <div v-if="errors.length">
                <h2>Erros:</h2>
                <ul>
                    <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            errors: [],
        };
    },
    methods: {
        async register() {
            try {
                const response = await axios.post('/register', this.formData);

                // Se o registro for bem-sucedido, redirecione para a página inicial
                window.location.href = '/';
            } catch (error) {
                // Se houver erros, exiba-os na tela
                this.errors = error.response.data.errors;
            }
        },
        ViewPassword: function(id){
            if(document.getElementById(id).type == 'password'){
                document.getElementById(id).type = 'text'
            }else{
                document.getElementById(id).type = 'password'
            }
        }
    },
};
</script>

<style scoped>
.show-password{
    font-weight: 700;
    display: flex;
    align-items: center;
}
#show-password{
    margin-bottom: 1em;
}
#email,#username,#confirmation-div{
    margin-bottom: 2em;
}
#viewPasword{
    width: fit-content;
    font-size: 2em;
}
#viewPasword:hover{
    cursor: pointer;
}
.password-div{
    margin-bottom: 0px;
    display: flex;
    flex-direction: column;
}
.form-container{
    display: flex;
    flex-direction: column;
    font-size: 24px;
}
.Register-page {
    display: flex;
    flex-direction: column;
    height: 56em;

}

.register-form {
    display: flex;
    flex-direction: column;
    color: #000;
    margin: 0 auto;
    padding: 20px;
    border-radius: 5px;
    gap: 4em;
}

.register-form h1 {
    text-align: center;
    font-size: 58px;
    margin-bottom: 20px;
}

.register-form input {
    box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
    font-size: larger;
    width: 45em;
    padding: 10px;
    border-radius: 15px;
}

.register-form button {
    font-size: 36px;
    background-color: #000;
    color: #fafafa;
    padding: 10px 20px;
    border: transparent 5px solid;
    border-radius: 25px;
    cursor: pointer;
}

.register-form button:hover {
    background-color: #fafafa;
    color: #000;
    border: #000 5px solid;
}

.register-form ul {
    list-style: none;
    padding: 0;
}
</style>