<?php

namespace App\Http\Controllers;

use App\Models\facture;
use App\Models\order;
use App\Models\order_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; 

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $id_user = Auth::user()->id;

        $ListFactures['factures'] = DB::table('orders')
        ->select('orders.id',
                'orders.status',
                'orders.created_at'
                )
        ->leftJoin('order_details','order_details.id_order','=','orders.id')
        ->leftJoin('productos','productos.id_productos','=','order_details.id_productos')


        ->where('orders.id_user',$id_user)
        ->where('orders.status','approved')
        ->groupBy('orders.id')
        ->distinct()
        ->paginate(10);

        return view('facturas.index',$ListFactures);
    }

    public function listAdmin(){
        $ListFactures['factures'] = DB::table('orders')
        ->select('orders.id',
                'orders.status',
                'orders.created_at',
                'profiles.Nombres',
                'profiles.apellidos',
                'profiles.cedula',
                'profiles.tipo_documento'
                )
        ->Join('profiles','profiles.id_user','=','orders.id_user')
        ->where('orders.status','approved')
        ->get();

        return view('facturas.admin_factures',$ListFactures);
    }

    public function create_pdf($id){

        $list=[
            'order'=> self::order($id),
            'details'=> self::Order_detail($id),
            'total'=> self::ShowTotalOrder($id),
            'profile'=>self::profile($id)
        ];
        $lists = json_decode(json_encode($list),true);

        $pdf = Pdf::loadView('facturas.pdf',$lists);
        return $pdf->stream();
    }

    private function Order($id){
        $order = DB::table('orders')   
        ->where('orders.id',$id)->first(); 

        return $order;
    }

    private function profile($id){
        $profile = DB::table('profiles')
        ->select('profiles.*')
        ->Join('orders','orders.id_user','=','profiles.id_user')
        ->where('orders.id',$id)->first(); 

        return $profile;
    }
    
    private function Order_detail($id){
        $order_detail = DB::table('order_details')
        ->select(
            'order_details.id',
            'order_details.quantity',
            'productos.nombres_productos',
            'productos.valor',
        )
        ->selectRaw(
            'SUM(order_details.quantity * productos.valor) as total')
        ->leftJoin('productos','productos.id_productos','=','order_details.id_productos') 
        ->groupBy('order_details.id')
        ->where('order_details.id_order',$id)->get(); 

        return $order_detail;
    }

    
    private function ShowTotalOrder($id){
        $totalprice = DB::table('order_details')
        ->selectRaw('SUM( productos.valor * order_details.quantity ) as total_price')
        ->leftJoin('productos','productos.id_productos','=','order_details.id_productos')
        ->leftJoin('orders','orders.id','=','order_details.id_order')
        ->where('order_details.id_order',$id)
        ->get();
        
        return $totalprice[0]->total_price;
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(facture $facture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(facture $facture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(facture $facture)
    {
        //
    }
}
