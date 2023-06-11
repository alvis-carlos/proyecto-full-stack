<?php

namespace App\Http\Controllers;

use App\Models\tipo_estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoEstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function ShowAll(){
        $ListCategories['tipo_estados']= DB::table('tipo_estados')->paginate(5);

        return $ListCategories;
    }

    public function index()
    {
        $List = self::ShowAll();
        return view('state_type.index',$List);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('state_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataStateType = request()->except('_token');

        $errorTypeState = request()->validate([
            'nombre_tip_esta'=>'required|max: 45',
        ]);

        tipo_estado::insert($dataStateType);

        return redirect('dash/TipoEstado/create')->with('mensaje','Tipo estado creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tipo_estado  $tipo_estado
     * @return \Illuminate\Http\Response
     */

    public function List(){
        $List = self::ShowAll();
        return view('state_type.List',$List);
    } 
    
    public function show(tipo_estado $tipo_estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipo_estado  $tipo_estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoestado['tipoestado'] = DB::table('tipo_estados')
        ->where('id_tipo_estado',$id)->first();
    

        $prod = json_decode(json_encode($tipoestado),true);

        return view('state_type.edit', $prod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tipo_estado  $tipo_estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $dataStateType = request()->except('_token','_method','updated_at');

        $errorTypeState = request()->validate([
            'nombre_tip_esta'=>'required|max: 45',
        ]);

        
        tipo_estado::where('id_tipo_estado','=',$id)->update($dataStateType);

        return redirect('dash/TipoEstado/'.$id.'/edit')->with('mensaje','Tipo estado actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tipo_estado  $tipo_estado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tipo_estados')->where('id_tipo_estado', '=', $id)->delete();

        return redirect('dash/TipoEstado')->with('mensaje','Tipo de estado eliminado');
    }
}
