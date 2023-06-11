<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ListUser['users']= User::All();
        return view('users.index',$ListUser);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errorUser = request()->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'is_admin'=>'required|max:1'
        ]);

        $result = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'is_Admin' => $request['is_admin']
        ]);

        if($result){
            User::where('email','=',$request['email'])
            ->update([
                'is_Admin' => $request['is_admin']
            ]);
        }

        return redirect('dash/users/create')->with('mensaje','Usuario creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datauser['datauser'] = DB::table('users')
        ->where('id',$id)->first();

        $arrayData = json_decode(json_encode($datauser),true);

        return view('users.edit',$arrayData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $dataStateType = request()->except('_token','_method','updated_at');

        if( self::validateEmailUpdate($id,$request['email'] == true) ){
            $errorUser = request()->validate([
                'name'=>'required',
                'email'=>'required|email',
                'is_admin'=>'required|max:1'
            ]);
        }

        if( isset($request['password']) != null ){
            User::where('id','=',$id)
            ->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'is_Admin' => $request['is_admin']
            ]);

            return redirect('dash/users/'.$id.'/edit')->with('mensaje','Usuario actualizado');
        }else{
            User::where('id','=',$id)
            ->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'is_Admin' => $request['is_admin']
            ]);
            return redirect('dash/users/'.$id.'/edit')->with('mensaje','Usuario actualizado');
        }

    }

    private function validateEmailUpdate($id, $email){
        $datauser = DB::table('users')
        ->select('email')
        ->where('id',$id)->first();

        $band= false;

        if($datauser->email == $email){
            return true;
        }

        return $band;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect('dash/users')->with('mensaje','Usuario eliminado');

    }
}
