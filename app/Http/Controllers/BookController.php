<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.books.index', [
            'books' => Book::with('categories')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.books.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
            'cover' => 'image|file|max:1024',
        ]);

        if($request->file('image')){
            $validated['cover'] = $request->file('image')->store('cover');
        }

        $book = Book::create($validated);
        $book->categories()->sync($request->category_id);

        return redirect('/dashboard/books')->with('success', 'New Book has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();

        return view('dashboard.books.edit', [
            'book' => $book,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $rules = [
            'book_code' => 'required|max:255',
            'title' => 'required|max:255',
            'cover' => 'image|file|max:1024',
        ];

        if ($request->slug != $slug) {
            $rules['slug'] = 'required|unique:books';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['cover'] = $request->file('image')->store('cover');
        }

        $book = Book::where('slug', $slug)->first();
        $book->update($validatedData);

        if ($request->category_id) {
            $book->categories()->sync($request->category_id);
        }

        return redirect('/dashboard/books')->with('success', 'Book has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $sofdelBook = Book::where('slug', $slug)->first();
        $sofdelBook->delete();

        return redirect('/dashboard/books')->with('success', 'Book has been deleted!');
    }

    public function deleted()
    {
        return view('dashboard.books.deleted', [
            'books' => Book::onlyTrashed()->get()
        ]);
    }

    public function restore($slug)
    {
        $restoreBook = Book::withTrashed()->where('slug', $slug)->first();
        $restoreBook->restore();

        return redirect('/dashboard/books')->with('success', 'Book has been restored!');
    }

    public function forceDelete($slug)
    {
        $forcdelBook = Book::withTrashed()->where('slug', $slug)->first();

        if ($forcdelBook->cover) {
            Storage::delete($forcdelBook->cover);
        }
        
        if ($forcdelBook->categories()) {
            $forcdelBook->categories()->detach();
            $forcdelBook->categories()->sync([]);
        }

        $forcdelBook->forceDelete();

        return redirect('/dashboard/books/deleted')->with('success', 'Book has been force deleted!');
    }


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Book::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
