<?php

namespace App\Http\Controllers;

use App\Models\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.profiles.create');
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
        $id = Auth::user()->id;

        $errorUser = request()->validate([
            'Nombres'=>'required',
            'apellidos'=>'required',
            'direccion'=>'required',
            'telefono'=>'required|integer',
            'cedula'=>'required|integer',
            'tipo_documento'=>'required',
        ]);
        
        profile::insert([
            'Nombres' => $request['Nombres'],
            'apellidos' => $request['apellidos'],
            'direccion' => $request['direccion'],
            'telefono'=> $request['telefono'],
            'cedula'=> $request['cedula'],
            'tipo_documento'=> $request['tipo_documento'],
            'id_user'=>$id
        ]);

        return redirect('home/profile')->with('mensaje','Perfil actualizado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idUser = Auth::user()->id;
        $profileUser['profile'] = DB::table('profiles')
        ->where('id_user',$idUser)
        ->first();
        

        $profile = json_decode(json_encode($profileUser),true);

        return view('home.profiles.edit',$profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id1)
    {
        $dataProfile = request()->except('_token','_method','updated_at');
        $id = Auth::user()->id;

        $errorUser = request()->validate([
            'Nombres'=>'required',
            'apellidos'=>'required',
            'direccion'=>'required',
            'telefono'=>'required|integer',
            'cedula'=>'required|integer',
            'tipo_documento'=>'required',
        ]);

        profile::where('id_user','=',$id)->update($dataProfile);

        return redirect('home/profile/editPerfil/edit')->with('mensaje','Perfil actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(profile $profile)
    {
        //
    }
}
