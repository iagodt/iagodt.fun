<template>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=local_shipping" />
    <div class="shippingPage">
        <div class="progress-container">
            <div class="progress-step">
                <div class="circle">
                    <span class="material-symbols-outlined">local_mall</span>
                </div>
                <div class="label">Carrinho</div>
            </div>
            <div class="progress-step active">
                <div class="circle">
                    <span class="material-symbols-outlined active">local_shipping</span>
                </div>
                <div class="label">Entrega</div>
            </div>
            <div class="progress-step">
                <div class="circle">
                    <span class="material-symbols-outlined ">credit_card</span>
                </div>
                <div class="label">Pagamento</div>
            </div>
        </div>
        <div class="main-container">
            <div class="info-container">
                <div class="email-container">
                    <h1>Dados de contato</h1>
                    <div class="input-group">
                        <input type="email" placeholder="E-mail" required>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="offers">
                        <label for="offers">Receber ofertas e novidades por e-mail</label>
                    </div>
                </div>
                <div class="shipping-container">
                    <h1>Entrega</h1>
                    <form class="cep-form" action="frete">
                    <div class="input-group">
                        <input type="text" placeholder="CEP" required>
                    </div>
                    <button class="btn" type="submit">continuar</button>
                </form>
                </div>
            </div>
            <div class="cart-container">
                    
            </div>

        </div>

    </div>

</template>


<style scoped>
.cep-form{
    display: flex;
    flex-direction: column;
    
}
.btn {
    margin-top: 1em;
    align-self: flex-end;
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #000;
    border: none;
    border-radius: 25px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
}

.shipping-container {
    width: 50%;
    margin: 0 auto;
    padding-top: 20px;
}
.email-container {
    width: 50%;
    margin: 0 auto;
    padding-top: 20px;
}

h1 {
    font-size: 24px;
    font-weight: bold;
}

.input-group {
    margin-top: 20px;
}

.input-group input[type="email"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.input-group input[type="text"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.checkbox-group {
    margin-top: 10px;
}

.checkbox-group input[type="checkbox"] {
    margin-right: 10px;
}

.material-symbols-outlined{
    color: #666;
}
.shippingPage{
    padding-top: 1em;
    color: #000;
}
.progress-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 80%;
    margin: 50px auto;
}

.progress-step {
    text-align: center;
    position: relative;
    flex: 1;
}

.progress-step::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #ccc;
    z-index: -1;
}

.progress-step:first-child::before {
    left: 50%;
}

.progress-step:last-child::before {
    right: 50%;
}

.progress-step .circle {
    width: 30px;
    height: 30px;
    border: 2px solid #ccc;
    border-radius: 50%;
    background-color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
}

.progress-step.active .circle {
    border-color: #000;
}

.progress-step.active .label {
    font-weight: bold;
    color: #000;
}

.label {
    font-size: 14px;
    color: #666;
}
</style>