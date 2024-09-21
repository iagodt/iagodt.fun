<template>
    <div id="login-popup" class="popup">
        <span class="close-button" onclick="closePopup()">&times;</span>
        <h2>Login</h2>
        <form class="login-form">
            <div class="form-group">
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Email ou Telefone" required>
            </div>
            <div class="form-group">
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Senha" required>
            </div>
            <button type="submit" class="button">LOGIN</button>
        </form>
        <div class="oauth">
          <h2 class="oauth-text">Entrar com:</h2>
          <img class="oauth-img" src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg">
        </div>
        <h4>Não cadastrado? <a class="register-link">Cadastre-se</a></h4>
    </div>
</template>

<style scoped>
@-webkit-keyframes scale-up-ver-top{0%{-webkit-transform:scaleY(.4);transform:scaleY(.4);-webkit-transform-origin:100% 0;transform-origin:100% 0}100%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0}}@keyframes scale-up-ver-top{0%{-webkit-transform:scaleY(.4);transform:scaleY(.4);-webkit-transform-origin:100% 0;transform-origin:100% 0}100%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0}}

.popup{-webkit-animation:scale-up-ver-top .2s cubic-bezier(.39,.575,.565,1.000) both;animation:scale-up-ver-top .2s cubic-bezier(.39,.575,.565,1.000) both}

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
  position: fixed;
  left: 37.5%;
  top: 37.5%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  z-index: 1000;
}

.close-button {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 20px;
  cursor: pointer;
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