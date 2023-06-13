<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookReturnController extends Controller
{
    public function index(){
        $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();

        return view('dashboard.bookreturn.index', [
            'users' => $users,
            'books' => $books,
        ]);
    }

    public function store(Request $request){
        $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null);

        $rentData = $rent->first();
        $countData = $rent->count();

        if ($countData == 1) {
            try {
                DB::beginTransaction();

                // Update actual return date
                $rentData->actual_return_date = Carbon::now()->toDateString();
                $rentData->save();
                //update stock book
                $book = Book::findOrFail($request->book_id);
                $book->status = 'in stock';
                $book->save();

                DB::commit();

                Session::flash('message', 'Return book is successfully');
                Session::flash('alert-class', 'alert-success');
                
                return redirect('/dashboard/book-return');
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        } else {
            Session::flash('message', 'Return book is failed');
            Session::flash('alert-class', 'alert-danger');
            
            return redirect('/dashboard/book-return');
        }
        
    }
}
