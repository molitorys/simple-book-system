<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateReader;
use App\Models\Reader;
use App\Models\Book;
use Carbon\Carbon;

class BookController extends Controller
{
    /**
     * Show list of all readers
     */
    public function list(Request $request)
    {
        $readers = Reader::getList();
        $status = $request->session()->get('status', null);
     
        return view('pages.list', [
            'readers' => $readers,
            'status' => $status
        ]);     
    }

    /**
     * Create a new reader and books form
     */
    public function create(Request $request)
    {
        $nick = $request->session()->get('reader_nick', '');

        return view('pages.create', [
            'nick' => $nick
        ]); 
    }

    /**
     * Receive request from create form and save data in database
     */
    public function store(CreateReader $request)
    {
        $status = null;
        if (Reader::create($request->only(['nick', 'book']))) {
            $status = 'created';
        }

        $nick = $request->get('nick');
        $request->session()->put('reader_nick', $nick);

        return view('pages.create', [
            'status' => $status,
            'nick' => $nick
        ]); 
    }

    /**
     * Show reader and attached books
     */
    public function reader(Request $request, $slug, $id)
    {
        $reader = Reader::getWithBooks((int) $id);

        if (!$reader->isSlugCorrect($slug)) {
            abort(404);
        }

        $status = $request->session()->get('status', null);

        return view('pages.reader', [
            'reader' => $reader,
            'status' => $status
        ]);   
    }

    /**
     * Removes reader
     */
    public function delete($slug, $id)
    {
        $reader = Reader::findOrFail($id);

        if (!$reader->isSlugCorrect($slug)) {
            abort(404);
        }

        $reader->delete();

        return redirect()->route('list')->with('status', 'deleted');
    }

    /**
     * Removes reader book
     */
    public function deleteBook($slug, $id, $bookId)
    {
        $book = Book::findOrFail($bookId);

        // Check if book belongs to user
        $reader = $book->reader;
        if ( !($reader && $reader->id == $id && $reader->isSlugCorrect($slug)) ) {
            abort(404);    
        }

        $book->delete();

        return redirect()->route('reader', ['slug' => $slug, 'id' => $id])->with('status', 'deleted');        
    }
}
