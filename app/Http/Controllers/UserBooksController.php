<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class UserBooksController extends Controller
{
    public function index($user_id)
    {
        $books = Books::get()->where('user_id',$user_id);
        if(is_null($books))
            return response()->json('Data not found', 404);
        return response()->json($books);
    }
}
