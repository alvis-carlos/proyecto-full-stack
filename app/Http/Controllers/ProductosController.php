<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Models\categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataProduct['products'] = DB::table('productos')
        ->select('productos.id_productos',
                'productos.nombres_productos',
                'productos.descripcion',
                'productos.imagen',
                'categorias.nombre_catego')
        ->leftJoin('categorias','productos.id_categorias','=','categorias.id_categorias')
        ->get();

        return view('products.index', $dataProduct);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ListCategoria = categorias::All();
        return view('products.create', compact('ListCategoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataProduct = request()->except('_token');

        $errorProducts = request()->validate([
            'nombres_productos'=>'required|max: 75',
            'descripcion'=>'required|max: 170',
            'valor'=>'required|min: 100|integer',
            'imagen'=>'image|mimes:jpeg,png|max:3000',
        ]);

        if($request->hasFile('imagen')){
            $dataProduct['imagen'] = $request->file('imagen')->store('uploads','public');
        }

        productos::insert($dataProduct);

        return redirect('dash/productos/create')->with('mensaje','Producto creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show(productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit($id_productos)
    {
        $productos1 = DB::table('productos')
        ->where('id_productos',$id_productos)->first();

        $ListCategoria = categorias::All();
        
        $list = [
            'productos'=>$productos1,
            'categorias'=>$ListCategoria
        ];

        $prod = json_decode(json_encode($list),true);

        return view('products.edit', $prod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $dataProduct = request()->except('_token','_method','updated_at');

        $errorProducts = request()->validate([
            'nombres_productos'=>'required|max: 75',
            'descripcion'=>'required|max: 170',
            'valor'=>'required|min: 100|integer',
            'imagen'=>'image|mimes:jpeg,png|max:3000',
        ]);

        if($request->hasFile('imagen')){
            Storage::delete('public/'.self::SearchStorage($id));
            $dataProduct['imagen'] = $request->file('imagen')->store('uploads','public');
        }

        $productos1['productos'] = DB::table('productos')
        ->where('id_productos',$id)->first();
        $prod = json_decode(json_encode($productos1),true);
        
        productos::where('id_productos','=',$id)->update($dataProduct);

        $productos1['productos'] = DB::table('productos')
        ->where('id_productos',$id)->first();
    

        return redirect('dash/productos/'.$id.'/edit')->with('mensaje','Producto actualizado con exito');
    }

    
    private function SearchStorage($id){

        $productos1['productos'] = DB::table('productos')->
        select('imagen')
        ->where('id_productos',$id)->first();
        $prod = json_decode(json_encode($productos1),true);

        return $prod['productos']['imagen'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::delete('public/'.self::SearchStorage($id));
        DB::table('productos')->where('id_productos', '=', $id)->delete();

        return redirect('dash/productos')->with('mensaje','Producto eliminado con exito');
    }
}
