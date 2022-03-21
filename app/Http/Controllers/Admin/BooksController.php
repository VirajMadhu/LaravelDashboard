<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Yajra\DataTables\DataTables;



class BooksController extends Controller
{

    //Index
    public function index(Request $request)
    {
        $books = Book::latest()->get();

        if ($request->ajax()) {
            $data = Book::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-modal-toggle="ajaxModel" data-id="' . $row->id . '" data-original-title="Edit" class="edit px-4 py-2 bg-blue-500 hover:bg-blue-800 text-white rounded-md editBook">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)"  data-id="' . $row->id . '" data-original-title="Delete" class="px-4 py-2 bg-red-500 hover:bg-red-800 text-white rounded-md deleteBook">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.books.index', compact('books'));
    }


    //Add
    public function store(Request $request)
    {
        Book::updateOrCreate(
            ['id' => $request->book_id],
            ['title' => $request->title, 'author' => $request->author]
        );

        return response()->json(['success' => 'Book saved successfully.']);
    }

    //Edit
    public function edit($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    //Delete
    public function destroy($id)
    {
        Book::find($id)->delete();

        return response()->json(['success' => 'Book deleted successfully.']);
    }
}