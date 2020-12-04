<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('view loans')) {
            $loans = Loan::all();
            $books = Book::all();
            $users = User::all();
            return view('loans.index', compact('loans','books','categories'));
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
        if (Auth::user()->hasPermissionTo('add loans')) {   
            if ($loan = Loan::create($request->all())) {
                return redirect()->back()->with('status','El préstamo se creó con éxito');
            }
            return redirect()->back()->with('error','No se pudo crear el préstamo');
        }else{
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        if (Auth::user()->hasPermissionTo('update loans')) { 

            $loan= Loan::find($request->id);

            if($loan)
            {
                if($loan->update($request->all())) 
                {
                    return redirect()->back()->with('status','El préstamo se modificó con éxito');
                }
            }
            return redirect()->back()->with('error','No se pudo editar el préstamo');
        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        if (Auth::user()->hasPermissionTo('delete loans')) {
          
            if ($loan->delete())
            {
                return response()->json([

                    'message' => 'Préstamo eliminado con éxito',
                    'code' => '200'
                ]);
            }
            return response()->json([
                'message' => 'No se ha podido eliminar el préstamo',
                'code' => '400'
            ]);

        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }
}
