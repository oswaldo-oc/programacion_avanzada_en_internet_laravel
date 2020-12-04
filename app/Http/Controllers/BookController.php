<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

use Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('view books')) {
            $books = Book::all();
            $categories = Category::all();
            return view('books.index', compact('books','categories'));
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
     * @return \Illuminate\Http\Respons
     */
    public function store(Request $request)
    {
        if (Auth::user()->hasPermissionTo('add books')) {   
            if ($book = Book::create($request->all())) {

                if ($request->file('cover')) {
                    
                    $file = $request->file('cover');
                    $file_name = 'book_cover_'.$book->id.'.'.$file->getClientOriginalExtension();
                    $path = $request->file('cover')->storeAs('img/books',$file_name);
                    $book->cover = $file_name;
                    $book->save();
                }
                return redirect()->back()->with('status','El libro se creó con éxito');
            }
            return redirect()->back()->with('error','No se pudo crear el libro');
        }else{
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        if (Auth::user()->hasPermissionTo('update books')) { 

            $book= Book::find($request->id);

            if($book)
            {
                if($book->update($request->all())) 
                {
                    if ($request->file('cover')) {
                    
                        $file = $request->file('cover');
                        $file_name = 'book_cover_'.$book->id.'.'.$file->getClientOriginalExtension();
                        $path = $request->file('cover')->storeAs('img/books',$file_name);
                        $book->cover = $file_name;
                        $book->save();
                    }
                    return redirect()->back()->with('status','El libro se modificó con éxito');
                }
            }
            return redirect()->back()->with('error','No se pudo editar el libro');
        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if (Auth::user()->hasPermissionTo('delete books')) {
          
            if ($book->delete())
            {
                return response()->json([

                    'message' => 'Libro eliminado con éxito',
                    'code' => '200'
                ]);
            }
            return response()->json([
                'message' => 'No se ha podido eliminar el libro',
                'code' => '400'
            ]);

        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }
}
