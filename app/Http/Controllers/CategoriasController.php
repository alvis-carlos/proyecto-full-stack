<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function ShowAll(){
        $ListCategories['categories']= DB::table('categorias')->get();

        return $ListCategories;
    }

    public function index()
    {

        $List = self::ShowAll();
        return view('categories.index',$List);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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

        $errorCategories = request()->validate([
            'nombre_catego'=>'required|max: 65',
        ]);


        categorias::insert($dataProduct);

        return redirect('dash/categorias/create')->with('mensaje','categoria creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function show(categorias $categorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function edit($id_categorias)
    {

        $categories['categories'] = DB::table('categorias')
        ->where('id_categorias',$id_categorias)->first();
    

        $prod = json_decode(json_encode($categories),true);

        return view('categories.update', $prod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $dataProduct = request()->except('_token','_method','updated_at');

                $errorCategories = request()->validate([
            'nombre_catego'=>'required|max: 65',
        ]);

        
        categorias::where('id_categorias','=',$id)->update($dataProduct);
        $List = self::ShowAll();

        return redirect('dash/categorias/'.$id.'/edit')->with('mensaje','categoria creada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('categorias')->where('id_categorias', '=', $id)->delete();

        return redirect('dash/categorias')->with('mensaje','categoria eliminada con exito');
    }
}
