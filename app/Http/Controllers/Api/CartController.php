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
    public function getCart(Request $request){
        return $request->session()->get('cart');
    }       
    public function addOnCart(Request $request){
        $item = $request->item;
        if($request->session()->exists('cart')){
            $CartArray = $request->session()->get('cart');
            array_push($CartArray,$item);
        }else{
            $CartArray = [];
            array_push($CartArray,$item);
           
        }
        $request->session()->put('cart',$CartArray);

    }
    public function removeOfCart(Request $request){
        $item = $request->item;
        if($item){
            $CartArray = $request->session()->get('cart');
            unset($CartArray[array_search($item,$CartArray)]);
            $request->session()->remove('cart');
            $request->session()->put('cart',$CartArray);
        }else{
            return response(json_encode(['Error' => 'Payload is required']),400) ;
        }
    }
    public function clearCart(Request $request){
        $request->session()->forget('cart');
        
    }
    public function getItensOnCart(Request $request) {
        if($request->session()->exists('cart')){
            $itensOnCart = [];
            $sessionItens = $request->session()->get('cart');
            foreach($sessionItens as $i){
                array_push($itensOnCart,products::where("id",$i)->get()->first());
            }
            return $itensOnCart;
        }else{
            return response(['error'=>'cart is empty'],200);
        }
        
        
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