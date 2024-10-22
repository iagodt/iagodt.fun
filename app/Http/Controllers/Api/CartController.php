<?php

namespace App\Http\Controllers\Api;
use App\Models\cart_itens;
use App\Models\carts;
use App\Models\products;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller{   
    public function addCart(Request $request){
        $item = $request->id;
        
        $quantity = (int) ($request->quantity ?? 1);
        return [
            'product_id' => products::where('id',$item)->value('id'),
            'quantity' => $quantity
        ];
 



    }

    public function getItensCart(Request $request){
        $cart =json_decode($request->cart);
        $itensOnCart = [];
        foreach($cart as $i){
            $product = products::where('id',$i->product_id)->get()->toArray();
            $product['quantity'] = $i->quantity;

            array_push($itensOnCart,$product);
        }
        
        
        return $itensOnCart;
    }

    public function userAdd(Request $request){
        $userCart = carts::firstOrCreate(['user_id' => Auth::id()]);
        $quantity = $request->quantity ?? 1;
        cart_itens::updateOrCreate(
            [
                'cart_id' => $userCart->id,
                'product_id' => $request->product_id
            ],
            ['quantity' => DB::raw("quantity + {$quantity}")]
            );
        

    }
    public function userRemove(Request $request){
        $userCart = carts::where('user_id', Auth::id())->value('id');
        cart_itens::where('cart_id', $userCart)
        ->where('product_id', $request->product_id)->delete();
    }
    public function userGet(Request $request){
        $userCart = carts::where('user_id', Auth::id())->value('id');
        $itensOnCart = cart_itens::where('cart_id',$userCart)->get();
        $itensArray = [];

        foreach($itensOnCart as $item){
            $item = [
                'id' => $item->id,
                'product_id' =>$item->product_id,
                'quantity' =>$item->quantity,

            ];

            array_push($itensArray,$item);
        }
        return $itensArray;
    }
}