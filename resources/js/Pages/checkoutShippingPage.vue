<template>
<body class="bg-gray-100">
  <div class="max-w-7xl mx-auto p-4">
   <!-- Progress Bar -->
   <div class="flex items-center justify-between mb-4">
    <div class="flex items-center space-x-2">
     <div class="flex items-center">
      <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
       1
      </div>
      <span class="ml-2">
       Carrinho
      </span>
     </div>
     <div class="w-8 h-1 bg-gray-300">
     </div>
     <div class="flex items-center">
      <div class="w-8 h-8 rounded-full bg-gray-800 text-white flex items-center justify-center">
       2
      </div>
      <span class="ml-2">
       Entrega
      </span>
     </div>
     <div class="w-8 h-1 bg-gray-300">
     </div>
     <div class="flex items-center">
      <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
       3
      </div>
      <span class="ml-2">
       Pagamento
      </span>
     </div>
    </div>
   </div>
   <!-- Notification Bar -->
   <div class="bg-black text-white text-center py-2 mb-4">
    <span>
     PARABÉNS! VOCÊ GANHOU MAIS 2% OFF
    </span>
    <span class="block">
     Continue sua compra para liberar
     <span class="text-red-500">
      00:17:58
     </span>
    </span>
   </div>
   <!-- Main Content -->
   <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <!-- Left Column -->
    <div class="lg:col-span-2">
     <!-- Contact Information -->
     <div class="bg-white p-4 mb-4 rounded shadow">
      <h2 class="text-xl font-bold mb-4">
       Dados de contato
      </h2>
      <input class="w-full p-2 border border-gray-300 rounded mb-2" placeholder="E-mail" type="email"/>
      <div class="flex items-center">
       <input class="mr-2" id="newsletter" type="checkbox"/>
       <label for="newsletter">
        Receber ofertas e novidades por e-mail
       </label>
      </div>
     </div>
     <!-- Delivery Information -->
     <div class="bg-white p-4 mb-4 rounded shadow">
      <h2 class="text-xl font-bold mb-4">
       Entrega
      </h2>
      <div class="border border-gray-300 rounded p-4 flex items-center justify-between">
       <div class="flex items-center">
        <div class="w-6 h-6 rounded-full bg-black text-white flex items-center justify-center mr-2">
         <i class="fas fa-check">
         </i>
        </div>
        <div>
         <p class="font-bold">
          Frete Especial - Correios
         </p>
         <p class="text-sm">
          Chega entre quinta-feira 07/11 e terça-feira 19/11
         </p>
        </div>
       </div>
       <span class="font-bold">
        Grátis
       </span>
      </div>
     </div>
     <!-- Delivery Address -->
     <div class="bg-white p-4 mb-4 rounded shadow">
      <h2 class="text-xl font-bold mb-4">
       Dados para entrega
      </h2>
      <input class="w-full p-2 border border-gray-300 rounded mb-2" placeholder="Nome" type="text"/>
      <input class="w-full p-2 border border-gray-300 rounded mb-2" placeholder="Sobrenome" type="text"/>
      <input class="w-full p-2 border border-gray-300 rounded mb-2" placeholder="Telefone com DDD" type="text"/>
      <div class="flex items-center mb-2">
       <div class="w-6 h-6 rounded-full bg-black text-white flex items-center justify-center mr-2">
        <i class="fas fa-map-marker-alt">
        </i>
       </div>
       <div class="flex-1">
        <p class="font-bold">
         CEP 1420000
        </p>
        <p class="text-sm">
         Dumont - São Paulo
        </p>
       </div>
       <button class="text-blue-500">
        Alterar
       </button>
      </div>
      <input class="w-full p-2 border border-gray-300 rounded mb-2" placeholder="Endereço" type="text"/>
      <div class="flex space-x-2 mb-2">
       <input class="w-1/2 p-2 border border-gray-300 rounded" placeholder="Número" type="text"/>
       <div class="flex items-center">
        <input class="mr-2" id="sem-numero" type="checkbox"/>
        <label for="sem-numero">
         Sem número
        </label>
       </div>
      </div>
      <input class="w-full p-2 border border-gray-300 rounded mb-2" placeholder="Complemento (opcional)" type="text"/>
      <input class="w-full p-2 border border-gray-300 rounded mb-2" placeholder="Bairro" type="text"/>
     </div>
     <!-- Invoice Information -->
     <div class="bg-white p-4 mb-4 rounded shadow">
      <h2 class="text-xl font-bold mb-4">
       Dados para nota fiscal
      </h2>
      <input class="w-full p-2 border border-gray-300 rounded mb-2" placeholder="CPF ou CNPJ" type="text"/>
      <div class="flex items-center">
       <input class="mr-2" id="same-info" type="checkbox"/>
       <label for="same-info">
        Usar as mesmas informações da entrega
       </label>
      </div>
     </div>
     <!-- Continue Button -->
     <div class="text-right">
      <button class="bg-black text-white py-2 px-4 rounded">
       CONTINUAR PARA PAGAMENTO
      </button>
     </div>
    </div>
    <!-- Right Column -->
    <div class="bg-white p-4 rounded shadow">
     <!-- Cart Items -->
     <div class="mb-4">
      <div class="flex items-center justify-between mb-2">
       <div class="flex items-center">
        <img alt="Imagem de Brinco Prata 925 - Sixpoint" class="w-12 h-12 rounded mr-2" height="50" src="https://storage.googleapis.com/a1aa/image/hSAu9OvMjZ4KO9Z4GeyjKtcHbxaNsSfmxNLBIreeGWdQMLvOB.jpg" width="50"/>
        <div>
         <p>
          Brinco Prata 925 - Sixpoint
         </p>
         <p class="text-sm">
          x 1
         </p>
        </div>
       </div>
       <span>
        Grátis
       </span>
      </div>
      <div class="flex items-center justify-between mb-2">
       <div class="flex items-center">
        <img alt="Imagem de Corrente Riviera Ice Premium 4mm/5mm (Prata, 45cm, 5mm)" class="w-12 h-12 rounded mr-2" height="50" src="https://storage.googleapis.com/a1aa/image/YudBH7sa12rGLtgqz4jjaxWWOtewyLflQ1vjcu98A4vDzyrTA.jpg" width="50"/>
        <div>
         <p>
          Corrente Riviera Ice Premium 4mm/5mm (Prata, 45cm, 5mm)
         </p>
         <p class="text-sm">
          x 1
         </p>
        </div>
       </div>
       <span>
        R$ 227,90
       </span>
      </div>
      <div class="flex items-center justify-between mb-2">
       <div class="flex items-center">
        <img alt="Imagem de Brinco Masculino Redondo Ice Cravejado Prata 925 GP24 (Prata 925, 7 MM)" class="w-12 h-12 rounded mr-2" height="50" src="https://storage.googleapis.com/a1aa/image/AVjZIUcWqE4AJtte1s8gRgQU0PececIlMmyu4HBYe5AWMLvOB.jpg" width="50"/>
        <div>
         <p>
          Brinco Masculino Redondo Ice Cravejado Prata 925 GP24 (Prata 925, 7 MM)
         </p>
         <p class="text-sm">
          x 1
         </p>
        </div>
       </div>
       <span>
        R$ 87,00
       </span>
      </div>
      <div class="flex items-center justify-between mb-2">
       <div class="flex items-center">
        <img alt="Imagem de Pulseira Masculina Riviera Verde - Prata GP24 (Verde)" class="w-12 h-12 rounded mr-2" height="50" src="https://storage.googleapis.com/a1aa/image/zCBnb6bOY856Mh5rljcd8GDEUffZnfSGSt3mwJ0Rf2QcMLvOB.jpg" width="50"/>
        <div>
         <p>
          Pulseira Masculina Riviera Verde - Prata GP24 (Verde)
         </p>
         <p class="text-sm">
          x 1
         </p>
        </div>
       </div>
       <span>
        R$ 167,90
       </span>
      </div>
     </div>
     <!-- Summary -->
     <div class="border-t border-gray-300 pt-4">
      <div class="flex justify-between mb-2">
       <span>
        Subtotal
       </span>
       <span>
        R$ 482,80
       </span>
      </div>
      <div class="flex justify-between mb-2">
       <span>
        Desconto do cupom (10%)
       </span>
       <span>
        - R$ 48,28
       </span>
      </div>
      <div class="flex justify-between mb-2">
       <span>
        Custo de frete
       </span>
       <span>
        Grátis
       </span>
      </div>
      <div class="flex justify-between font-bold text-lg">
       <span>
        Total
       </span>
       <span>
        R$ 434,52
       </span>
      </div>
     </div>
     <!-- Coupon -->
     <div class="border-t border-gray-300 pt-4">
      <div class="flex items-center justify-between">
       <div class="flex items-center">
        <span class="bg-gray-200 p-2 rounded-l">
         Cupom: MAX10
        </span>
        <button class="bg-gray-200 p-2 rounded-r">
         <i class="fas fa-trash">
         </i>
        </button>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </body>
</template>
