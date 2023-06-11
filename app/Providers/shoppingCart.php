<?php

namespace App\Providers;

use App\Models\ShoppingCart as ShoppingCartModel;
use Illuminate\Support\ServiceProvider;

class shoppingCart extends ServiceProvider
{

    public static function findOrCreateBySessionID($shopping_cart_id){

        if($shopping_cart_id){
            return shoppingCart::findBySession($shopping_cart_id);
        }else{
            return shoppingCart::createWithoutSession();
        }
    }
    public static function findBySession($shopping_cart_id){
        return ShoppingCartModel::find($shopping_cart_id);
    }

    public static function createWithoutSession(){
        return ShoppingCartModel::create([
            "status"=>'incompleted'
        ]);
    }

    public function boot(){
        view()->composer('home/*',function($view){
            
                $shopping_cart_id = \Session::get('shopping_cart_id');

                $shopping_cart = shoppingCart::findOrCreateBySessionID($shopping_cart_id);
                \Session::put('shopping_cart_id', $shopping_cart->id);
    
                $view->with("shopping_cart",$shopping_cart);   
        
                        
        });
    }
}
