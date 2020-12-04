<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Auth::user()->hasPermissionTo('crud users')) {
            $users = User::all();
            return view('users.index', compact('users'));
        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }    
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
        if (Auth::user()->hasPermissionTo('crud users')) {

            if ($user = User::create($request->all())) {

                if ($user->role_id!=null) {
                    $user->assignRole($user->role_id);
                }
                return redirect()->back()->with('status','El usuario se registró con éxito');
            }
            return redirect()->back()->with('error','No se pudo registrar al usuario');

        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Auth::user()->hasPermissionTo('crud users')) {

            $user= User::find($request->id);

            if($user)
            {
                if($user->update($request->all())) 
                {
                    if ($user->role_id!=null) {
                        $user->assignRole($user->role_id);
                    }
                    return redirect()->back()->with('status','El usuario se modificó con éxito');
                }
            }
            return redirect()->back()->with('error','No se pudo editar al usuario');

        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->hasPermissionTo('crud users')) {
          
            if ($user->delete())
            {
                return response()->json([

                    'message' => 'Usuario eliminado con éxito',
                    'code' => '200'
                ]);
            }
            return response()->json([
                'message' => 'No se ha podido eliminar al usuario',
                'code' => '400'
            ]);

        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }
}
