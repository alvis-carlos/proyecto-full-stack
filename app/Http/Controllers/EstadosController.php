<?php

namespace App\Http\Controllers;

use App\Models\estados;
use App\Models\tipo_estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataState['states'] = DB::table('estados')
        ->select('estados.id_estados',
        'estados.nombre_esta',
        'estados.id_tipo_estado',
        'tipo_estados.nombre_tip_esta')
        ->leftJoin('tipo_estados','estados.id_tipo_estado','=','tipo_estados.id_tipo_estado')
        ->paginate(100);

        return view('state.index', $dataState);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $ListStateType = tipo_estado::All();
        return view('state.create',compact('ListStateType'));
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

        $errorState = request()->validate([
            'nombre_esta'=>'required|max: 45',
        ]);

        estados::insert($dataStateType);

        return redirect('dash/estados/create')->with('mensaje','Estado creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\estados  $estados
     * @return \Illuminate\Http\Response
     */
    public function show(estados $estados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\estados  $estados
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        
        $listEstato = DB::table('estados')
        ->where('id_estados',$id)->first();
    

        $ListStateType = DB::table('tipo_estados')->get();;
        
        $data= ['listEstato'=>$listEstato,'ListStateType'=>$ListStateType];

        $prod = json_decode(json_encode($data),true);

        return view('state.edit',$prod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\estados  $estados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $dataState = request()->except('_token','_method','updated_at');
        
        $errorState = request()->validate([
            'nombre_esta'=>'required|max: 45',
        ]);
        
        estados::where('id_estados','=',$id)->update($dataState);

        return redirect('dash/estados/'.$id.'/edit')->with('mensaje','Estado actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estados  $estados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('estados')->where('id_estados', '=', $id)->delete();

        return redirect('dash/estados')->with('mensaje','Estado eliminado');
    }
}
