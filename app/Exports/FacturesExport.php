<?php

namespace App\Exports;

use App\Models\order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FacturesExport implements FromView
{

    private $start_date;
    private $final_date;
    public function __construct($start_date,$final_date)
    {
        $this->final_date = $final_date; 
        $this->start_date = $start_date;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): view
    {
        $factures['facturas'] = DB::table('orders')
        ->select(
            'profiles.Nombres',
            'profiles.apellidos',
            'profiles.direccion',
            'profiles.telefono',
            'profiles.cedula',
            'profiles.tipo_documento',
            'orders.id',
            'orders.created_at',
            'orders.status',
            'productos.nombres_productos',
            'productos.valor',
            'order_details.quantity',
            'categorias.nombre_catego'
            )
        ->Join('order_details','order_details.id_order','=','orders.id')
        ->Join('productos','productos.id_productos','=','order_details.id_productos')
        ->Join('categorias','categorias.id_categorias','=','productos.id_categorias')
        ->join('users','users.id','=','orders.id_user')
        ->join('profiles','profiles.id_user','=','users.id')
        ->where('orders.created_at','>=', $this->start_date)
        ->where('orders.created_at','<=', $this->final_date)
        ->get();

        return view('dash.report_factures',$factures);
    }
}
