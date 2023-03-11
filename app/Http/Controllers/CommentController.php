<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Good;
use Validator;
use Auth;

class CommentController extends Controller
{
    public function index(){
        // return view('comment');
        return view('comment');
        
    }
}
