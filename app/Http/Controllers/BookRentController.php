<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->get();
        $books = Book::all();

        return view('dashboard.bookrents.index', [
            'users' => $users,
            'books' => $books,
        ]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        $bookStatus = Book::findOrFail($request->book_id)->only('status');

        if($bookStatus['status'] != 'in stock'){
            Session::flash('message', 'Cannot rent, the book is not available');
            Session::flash('alert-class', 'alert-danger');
            
            return redirect('/dashboard/book-rents');
        }else{
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

            if($count >= 3){
                Session::flash('message', 'Cannot rent, user has reach limit of books');
                Session::flash('alert-class', 'alert-danger');
                
                return redirect('/dashboard/book-rents');
            }else{
                try {
                    DB::beginTransaction();
                    //process insert to rent_logs table
                    RentLogs::create($request->all());
                    //process update book status
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not available';
                    $book->save();
                    DB::commit();

                    Session::flash('message', 'Rent book is successfuly');
                    Session::flash('alert-class', 'alert-success');
                    
                    return redirect('/dashboard/book-rents');
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }
    }
}
