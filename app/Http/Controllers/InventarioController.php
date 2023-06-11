<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use Illuminate\Http\Request;
use App\Models\estados;
use App\Models\productos;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataInventory['inventorys'] = DB::table('inventarios')
        ->select('inventarios.id',
                'inventarios.id_productos',
                'productos.nombres_productos',
                'productos.descripcion',
                'productos.imagen',
                'categorias.nombre_catego',
                'inventarios.fecha_vencimiento',
                'inventarios.talla',
                'inventarios.peso',
                'inventarios.marca',
                'inventarios.color',
                'inventarios.lote',
                'productos.valor',
                'inventarios.cantidad_stock')
        ->Join('productos','productos.id_productos','=','inventarios.id_productos')
        ->Join('categorias','categorias.id_categorias','=','productos.id_categorias')
        ->Join('estados','estados.id_estados','=','inventarios.id_estado')
        ->get();


        return view('inventory.index',$dataInventory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        $ListState = estados::All();
        $ListProducts = productos::All();
        return view('inventory.create', compact('ListState','ListProducts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataInventory = request()->except('_token');

        $errorInventory = request()->validate([
            'fecha_vencimiento'=>'date',
            'talla'=>'max: 5',
            'marca'=>'required|max: 45',
            'color'=>'max: 15',
            'lote'=>'required|max: 191',
            'cantidad_stock'=>'required|integer|min:1',
            'id_productos'=>'required',
            'id_estado'=>'required',
        ]);

        inventario::insert($dataInventory);
        return redirect('dash/inventario/create')->with('mensaje','Inventario asignado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listInventory = DB::table('inventarios')
        ->select('inventarios.id',
                'inventarios.id_productos',
                'productos.nombres_productos',
                'productos.descripcion',
                'productos.imagen',
                'categorias.nombre_catego',
                'inventarios.fecha_vencimiento',
                'inventarios.talla',
                'inventarios.peso',
                'inventarios.marca',
                'inventarios.color',
                'inventarios.lote',
                'inventarios.cantidad_stock',
                'inventarios.id_estado')
        ->Join('productos','productos.id_productos','=','inventarios.id_productos')
        ->Join('categorias','categorias.id_categorias','=','productos.id_categorias')
        ->Join('estados','estados.id_estados','=','inventarios.id_estado')
        ->where('inventarios.id',$id)->first();
    

        $ListState = DB::table('estados')->get();
        $ListProduct = DB::table('productos')->get();
        
        $data= ['listInventory'=>$listInventory,
                'ListProduct'=>$ListProduct,
                'ListState'=>$ListState
            ];

        $prod = json_decode(json_encode($data),true);

        return view('inventory.edit',$prod);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $dataState = request()->except('_token','_method','updated_at');

        $errorInventory = request()->validate([
            'fecha_vencimiento'=>'date',
            'talla'=>'max: 5',
            'marca'=>'required|max: 45',
            'color'=>'max: 15',
            'lote'=>'required|max: 191',
            'cantidad_stock'=>'required|integer|min:1',
            'id_productos'=>'required',
            'id_estado'=>'required',
        ]);
        
        inventario::where('id','=',$id)->update($dataState);

        return redirect('dash/inventario/'.$id.'/edit')->with('mensaje','inventario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('inventarios')->where('id', '=', $id)->delete();

        return redirect('dash/inventario')->with('mensaje','inventario eliminado con exito');
    }
}
