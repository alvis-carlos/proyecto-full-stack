<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FacturesExport;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; 

class reports extends Controller
{
    public function factures(){
        return view('reports.report_factura');
    }

    
    public function create_report_facture(Request $request){

        $errorUser = request()->validate([
            'start_date'=>'required|date',
            'final_date'=>'required|date',
            'type'=>'required'
        ]);

        if($request->start_date > $request->final_date){
            return redirect('dash/reports/factures')->with('mensaje_error','Fecha desde no puede ser superior a fecha hasta');
        }

        if($request->type =='excel'){
            return Excel::download(
                new FacturesExport($request->start_date,$request->final_date),'factures.xlsx'
            );
        }
        if($request->type =='csv'){
            return Excel::download(
                new FacturesExport($request->start_date,$request->final_date),'factures.csv'
            );
        }
        if($request->type  == 'pdf'){
            $pdf = self::create_pdf($request->start_date,$request->final_date);

            return $pdf->download('facturas.pdf');
        }
    }

    public static function create_pdf($start_date,$final_date){

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
        ->leftJoin('order_details','order_details.id_order','=','orders.id')
        ->leftJoin('productos','productos.id_productos','=','order_details.id_productos')
        ->leftJoin('categorias','categorias.id_categorias','=','productos.id_categorias')
        ->leftJoin('users','users.id','=','orders.id_user')
        ->leftJoin('profiles','profiles.id_user','=','users.id')
        ->where('orders.created_at','>=', $start_date)
        ->where('orders.created_at','<=', $final_date)
        ->get();

        $pdf = Pdf::loadView('dash.report_factures',$factures);
        $pdf->setOptions(['debugCss'=>true]);
        $pdf->setPaper('a4','landscape');
        return $pdf;
        
    }
}
