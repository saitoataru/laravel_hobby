<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
use Validator;
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
				//自分のuser_idが付与されている投稿だけ取得する
        $books = Book::where('user_id',Auth::id())->orderBy('created_at', 'asc')->get();
        return view('books', [
            'books' => $books
        ]);
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
             'item_name' => 'required|min:3|max:255',
             'item_number' => 'required|min:1|max:3',
             'item_amount' => 'required|max:6',
             'published'   => 'required',
            ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        $books = new Book;
        $books->item_name   = $request->item_name;
	    $books->item_number = $request->item_number;
	    $books->item_amount = $request->item_amount;
	    $books->published   = $request->published;
	    $books->updated_at   = $request->updated_at;
	    $books->image   = $request->image;
	    $books->user_id = Auth::id();
	   // dd($request->all());
	   // dd($request->file('image'));
	    
	    $savedImagePath = $request->file('image')->store('image','public');
     
        $books->image =$savedImagePath;
       
        $books->save(); 
	    return redirect('/');
        

	    
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
        return view('booksedit', ['book' => $book]);
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
                //バリデーション
         $validator = Validator::make($request->all(), [
             'id' => 'required',
             'item_name' => 'required|min:3|max:255',
             'item_number' => 'required|min:1|max:3',
             'item_amount' => 'required|max:6',
             'published' => 'required',
        ]);
        //バリデーション:エラー
         if ($validator->fails()) {
             return redirect('/booksedit/'.$request->id)
                 ->withInput()
                 ->withErrors($validator);
        }
        
        //データ更新
        $books = Book::where('user_id',Auth::id())->find($request->id);
        $books->item_name   = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published   = $request->published;
        $books->save();
        return redirect('/');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();       //追加
        return redirect('/');  //追加
    }
}
