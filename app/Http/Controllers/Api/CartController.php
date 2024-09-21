<?php

namespace App\Http\Controllers\Api;
use App\Models\Itens;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                array_push($itensOnCart,Itens::where("id",$i)->get()->first());
            }
            return $itensOnCart;
        }else{
            return response(['error'=>'cart is empty'],200);
        }
        
        
    }
}