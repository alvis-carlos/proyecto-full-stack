<?php

namespace App\Http\Controllers;

use App\Models\order_detail;
use Illuminate\Http\Request;

use App\Models\productos;
use App\Models\inventario;

use App\Models\shopping_cart_detail;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public static function create_detail_order()
    {
        $shopping_cart_id = \Session::get('shopping_cart_id');

        $ListShoppingCart = shopping_cart_detail::where('shopping_cart_id',$shopping_cart_id)
        ->get();

        foreach ($ListShoppingCart as $detail) {
            $result = order_detail::create([
                "id_productos"=>$detail->id_productos,
                "id_order"=>$detail->shopping_cart_id,
                "quantity"=>$detail->quantity
            ]);
            if($result){
                self::discount_inventory($detail->id_productos,$detail->quantity);
            } 
        }
    }

    private static function RoteInventory($id){
        $type= self::TypeRoteInventory($id);

        if($type){
            $detailInventory = DB::table('inventarios')
            ->select('id','cantidad_stock')
            ->orderBy('fecha_vencimiento')
            ->where('id_productos',$id)->first();

            return $detailInventory;
        }else{
            $detailInventory = DB::table('inventarios')
            ->select('id','cantidad_stock')
            ->orderBy('id')
            ->where('id_productos',$id)->first();

            return $detailInventory;
        }

    }

    private static function TypeRoteInventory($id){
        $expire_date = DB::table('inventarios')
        ->select('fecha_vencimiento')
        ->orderBy('id')
        ->where('id_productos',$id)->first();

        if( $expire_date->fecha_vencimiento != null ){
            return true;
        }else{
            return false;
        }
    }

    private static function discount_inventory($id_producto,$quantity){
        $missing_amount = $quantity;
        $subtract_quantities = 0;

        $detailInventory = self::RoteInventory($id_producto);
        $subtract_quantities = $detailInventory->cantidad_stock - $quantity;

        while ($missing_amount > 0) {

            if($subtract_quantities <= 0){
                DB::table('inventarios')->where('id', '=',$detailInventory->id)->delete();
                $missing_amount = abs($subtract_quantities);
                $detailInventory = self::RoteInventory($id_producto);
                $subtract_quantities = $detailInventory->cantidad_stock -$missing_amount;
            }else{
                DB::table('inventarios')
                ->where('id', $detailInventory->id)
                ->update(['cantidad_stock' =>$detailInventory->cantidad_stock - $missing_amount]);
                $missing_amount =0;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order_detail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function show(order_detail $order_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order_detail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(order_detail $order_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order_detail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order_detail $order_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order_detail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(order_detail $order_detail)
    {
        //
    }
}
