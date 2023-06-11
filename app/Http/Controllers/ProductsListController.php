<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Models\inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ListProducts['products']= DB::table('productos')        
        ->select('inventarios.id',
        'inventarios.id_productos',
        'productos.nombres_productos',
        'productos.descripcion',
        'productos.imagen',
        'categorias.nombre_catego',
        'productos.valor',
        'estados.id_estados')
        ->selectRaw('SUM(inventarios.cantidad_stock)as cantidad_stock')
        ->LeftJoin('inventarios','inventarios.id_productos','=','productos.id_productos')
        ->LeftJoin('categorias','categorias.id_categorias','=','productos.id_categorias')
        ->LeftJoin('estados','estados.id_estados','=','inventarios.id_estado')
        ->groupBy('inventarios.id_productos','productos.id_productos')
        ->orderBy('productos.nombres_productos')
        ->paginate(5);
        
        return view('home.products.index',$ListProducts);
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
     * @param  \App\Models\ProductsList  $productsList
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsList $productsList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductsList  $productsList
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsList $productsList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductsList  $productsList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsList $productsList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductsList  $productsList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsList $productsList)
    {
        //
    }
}
