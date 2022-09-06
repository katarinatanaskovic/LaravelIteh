<?php

namespace App\Http\Controllers;

use App\Http\Resources\BooksCollection;
use App\Http\Resources\BooksResource;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::all();
        return new BooksCollection($books);
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
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'slug'=>'required|string|max:100',
            'edition'=>'required',
            'genre_id'=>'required',
        ]);

        if($validator->fails())
            return response()->json($validator->errors());

        $books = Books::create([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'edition'=>$request->edition,
            'user_id'=>Auth::user()->id,
            'genre_id'=>$request->genre_id
        ]);

        return response()->json(["Book is created successfully!", new BooksResource($books)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Books $books)
    {
        return new BooksResource($books);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Books  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Books $books)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $books)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'slug'=>'required|string|max:100',
            'edition'=>'required',
            'genre_id'=>'required',
        ]);

        if($validator->fails())
            return response()->json($validator->errors());

        $books ->name = $request->name;
        $books ->slug = $request->slug;
        $books ->edition = $request->edition;
        $books ->genre_id = $request->genre_id;

        $books->save();
        return response()->json(["Book is updated successfully", new BooksResource($books)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy($books_id)
    {
        Books::destroy($books_id);

        return response()->json("Book is deleted successfully!");
    }
}
