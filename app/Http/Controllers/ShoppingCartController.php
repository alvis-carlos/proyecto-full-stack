<?php

namespace App\Http\Controllers;

use App\Models\shopping_cart_detail as shoppingCartModel;
use App\Models\ShoppingCart as ShoppingCartM;
use Illuminate\Http\Request;

use App\Providers\shoppingCart;
use Illuminate\Support\Facades\DB;
use App\Models\shopping_cart_detail;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shopping_cart_id = \Session::get('shopping_cart_id');

        $ListProducts = DB::table('shopping_cart_details')
        ->select('shopping_cart_details.id',
                'shopping_cart_details.id_productos',
                'shopping_cart_details.quantity',
                'productos.imagen',
                'productos.nombres_productos',
                'productos.valor as precio',
                'inventarios.cantidad_stock',
                )
        ->selectRaw(
                'productos.valor * shopping_cart_details.quantity as total')
        ->leftJoin('productos','productos.id_productos','=','shopping_cart_details.id_productos')

        ->leftJoin('inventarios','inventarios.id_productos','=','shopping_cart_details.id_productos')

        ->leftJoin('shopping_carts','shopping_carts.id','=','shopping_cart_details.shopping_cart_id')

        ->groupBy('shopping_carts.id','productos.id_productos')
        ->where('shopping_cart_id',$shopping_cart_id)
        ->where('shopping_carts.status','incompleted')
        ->get();
        
       
        $list = [
            'products'=>$ListProducts,
            'total'=>self::ShowTotalShoppingCart($shopping_cart_id)
        ];

        return view('home/shopping_cart.index',$list);
    }

    public static function ShowTotalShoppingCart($shopping_cart_id){
        $totalprice = DB::table('shopping_cart_details')
        ->selectRaw('SUM( productos.valor * shopping_cart_details.quantity ) as total_price')
        ->leftJoin('productos','productos.id_productos','=','shopping_cart_details.id_productos')
        ->leftJoin('shopping_carts','shopping_carts.id','=','shopping_cart_details.shopping_cart_id')
        ->where('shopping_cart_id',$shopping_cart_id)
        ->where('shopping_carts.status','incompleted')
        ->groupBy('shopping_carts.id')
        ->get();
        
        if( isset($totalprice[0]->total_price) ){
            return $totalprice[0]->total_price;
        }else{
            return 0;
        }
    }


    public static function PaidCart($status){

        $shopping_cart_id = \Session::get('shopping_cart_id');

        $dataStateType = request()->except('_token','_method');
        ShoppingCartM::where('id','=',$shopping_cart_id)
        ->update([
            'status' => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shopping_cart_id = \Session::get('shopping_cart_id');

        $shopping_cart = shoppingCart::findOrCreateBySessionID($shopping_cart_id);

        if(self::validateProducts($request->id_productos)){
            shoppingCartModel::create([
                "shopping_cart_id"=>$shopping_cart_id,
                "id_productos"=>$request->id_productos,
                "quantity"=>$request->quantity
            ]);
    
            return redirect('home/products')->with('mensaje','Producto agregado con extio al carrito');
    
        }else{
            return redirect('home/products')->with('mensaje_error','Producto ya esta agregado al carrito');
        }
    }

    private static function validateProducts($id){
        $shopping_cart_id = \Session::get('shopping_cart_id');

        $ListProducts = DB::table('shopping_cart_details')
        ->where('id_productos','=',$id)
        ->where('shopping_cart_id','=',$shopping_cart_id)
        ->first();

        if( empty($ListProducts) ){
            return true;
        }
        else{
            return false;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(shoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(shoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $dataStateType = request()->except('_token','_method');
        shoppingCartModel::where('id','=',$id)
        ->update([
            'quantity' => $request['quantity']
        ]);

        return redirect('home/shoppingcart')->with('mensaje','Cantidades actualizadas con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        DB::table('shopping_cart_details')->where('id', '=', $id)->delete();
        return redirect('home/shoppingcart')->with('mensaje','Producto eliminado con exito');
    }
}
