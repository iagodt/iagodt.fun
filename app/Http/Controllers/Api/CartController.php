<?php

namespace App\Http\Controllers\Api;
use App\Models\cart_itens;
use App\Models\carts;
use App\Models\products;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartController extends Controller{   

    // not auth users
    public function addCart(Request $request){
        try {
            // Verificar se o ID do produto foi enviado
            if (!isset($request->id)) {
                return response()->json(['error' => 'ID do produto não fornecido'], 400);
            }

            // Buscar o produto e garantir que ele exista
            $product = products::where('id', $request->id)->value('id');
            if (!$product) {
                return response()->json(['error' => 'Produto não encontrado'], 404);
            }

            // Validar a quantidade e definir valor padrão
            $quantity = (int) ($request->quantity ?? 1);
            if ($quantity <= 0) {
                return response()->json(['error' => 'Quantidade inválida'], 400);
            }

            // Retornar os dados no formato esperado
            return [
                'product_id' => $product,
                'quantity' => $quantity
            ];

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao adicionar o produto ao carrinho: ' . $e->getMessage()], 500);
        }
    }

    public function getItensCart(Request $request){
        try {
            // Decodificar e validar o JSON do carrinho
            $cart = json_decode($request->cart, true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($cart)) {
                return response()->json([], 200);
            }

            // Extrair os IDs dos produtos
            $productIds = array_column($cart, 'product_id');

            // Buscar os produtos em uma única consulta
            $products = products::whereIn('id', $productIds)->get()->keyBy('id')->toArray();

            $itensOnCart = [];
            foreach ($cart as $i) {
                // Verificar se a quantidade é válida
                if (!is_numeric($i['quantity']) || $i['quantity'] <= 0) {
                    return response()->json(['error' => 'Quantidade inválida'], 400);
                }

                // Verificar se o produto existe
                if (!isset($products[$i['product_id']])) {
                    return response()->json(['error' => "Produto com ID {$i['product_id']} não encontrado"], 404);
                }

                // Montar os dados do item no carrinho
                $product = $products[$i['product_id']];
                $product['quantity'] = $i['quantity'];

                array_push($itensOnCart, $product);
            }

            return $itensOnCart;

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao obter os itens do carrinho: ' . $e->getMessage()], 500);
        }
    }

    // auth users
    public function userAdd(Request $request){
        try {
            // Verificar se o usuário está autenticado
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuário não autenticado'], 401);
            }

            // Verificar se o carrinho do usuário existe
            $userCart = carts::where('user_id', $user->id)->value('id');
            if (!$userCart) {
                return response()->json(['error' => 'Carrinho não encontrado'], 404);
            }

            // Verificar se o produto existe
            $product = products::find($request->product_id);
            if (!$product) {
                return response()->json(['error' => 'Produto não encontrado'], 404);
            }

            // Definir a quantidade como 1 se não for informada
            $quantity = is_numeric($request->quantity) ?    $request->quantity : 1;

            // Atualizar ou criar item no carrinho
            cart_itens::updateOrCreate(
                [
                    'cart_id' => $userCart,
                    'product_id' => $request->product_id
                ],
                ['quantity' => DB::raw("quantity + {$quantity}")]
            );

            return response()->json(['success' => 'Produto adicionado ao carrinho'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao adicionar o produto: ' . $e->getMessage()], 500);
        }
    }

    public function userGet(){
        try {
            // Verificar se o usuário está autenticado
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuário não autenticado'], 401);
            }

            // Verificar se o carrinho do usuário existe
            $userCart = carts::where('user_id', $user->id)->value('id');
            if (!$userCart) {
                return response()->json(['error' => 'Carrinho não encontrado'], 404);
            }

            // Buscar itens no carrinho
            $itensOnCart = cart_itens::where('cart_id', $userCart)->get();

            // Verificar se o carrinho tem itens
            if ($itensOnCart->isEmpty()) {
                return response()->json([], 200);
            }

            // Criar um array de itens do carrinho
            $itensArray = [];
            foreach ($itensOnCart as $item) {
                // Verificar se o produto existe antes de adicionar ao array
                $product = products::find($item->product_id);
                if (!$product) {
                    return response()->json(['error' => "Produto com ID {$item->product_id} não encontrado"], 404);
                }

                // Montar o array de resposta
                $itemData = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    //'product_name' => $product->name, // Se quiser adicionar informações do produto, como nome
                    // Adicionar outros dados do produto conforme necessário
                ];

                array_push($itensArray, $itemData);
            }

            // Retornar os itens no carrinho
            return response()->json($itensArray, 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao buscar o carrinho: ' . $e->getMessage()], 500);
        }
    }

    public function userRemove(Request $request){
        try {
            // Verificar se o usuário está autenticado
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuário não autenticado'], 401);
            }

            // Verificar se o carrinho do usuário existe
            $userCart = carts::where('user_id', $user->id)->value('id');
            if (!$userCart) {
                return response()->json(['error' => 'Carrinho não encontrado'], 404);
            }

            // Verificar se o produto existe na tabela products
            $product = products::find($request->product_id);
            if (!$product) {
                return response()->json(['error' => 'Produto não encontrado'], 404);
            }

            // Verificar se o produto está no carrinho do usuário antes de tentar remover
            $item = cart_itens::where('cart_id', $userCart)
                ->where('product_id', $request->product_id)
                ->first();

            if (!$item) {
                return response()->json(['error' => 'Produto não encontrado no carrinho'], 404);
            }

            // Remover o item do carrinho
            $item->delete();

            return response()->json(['success' => 'Produto removido do carrinho com sucesso'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao remover o produto: ' . $e->getMessage()], 500);
        }
    }

    public function userSync(Request $request){
        // Recupera o usuário autenticado via JWT
        $user = JWTAuth::parseToken()->authenticate();
    
        // Verifica se o usuário tem um carrinho existente na tabela 'carts'
        $cart = carts::where('user_id', $user->id)->first();
    
        // Caso o usuário não tenha um carrinho, cria um novo
        if (!$cart) {
            $cart = carts::create(['user_id' => $user->id]);
        }
    
        // Verifica se o carrinho do usuário já tem itens na tabela 'cart_items'
        $cartItems = cart_itens::where('cart_id', $cart->id)->count();
    
        // Se o carrinho já tem itens, não faz nada
        if ($cartItems > 0) {
            return response()->json(['message' => 'O carrinho já possui itens. Nenhuma alteração foi feita.']);
        }
    
        // Caso o request contenha itens no carrinho não autenticado
        $items = $request->cart;

        $items = json_decode($items, true);
    
        // Verifica se o array de itens está presente e não está vazio
        if (!empty($items)) {
            // Itera sobre os itens do request e adiciona ao carrinho
            foreach ($items as $item) {
                cart_itens::create([
                    'cart_id' => $cart->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity']
                ]);
            }
            return response()->json(['message' => 'Itens adicionados ao carrinho.']);
        }
    
        // Caso o carrinho não autenticado esteja vazio ou undefined
        return response()->json(['message' => 'Nenhum item foi adicionado, o carrinho não autenticado está vazio.']);
    }
}