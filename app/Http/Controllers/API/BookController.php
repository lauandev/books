<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use Exception as Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use stdClass;


class BookController extends Controller
{
    /**
     * Display a listing of the books.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $books = Book::all();

        if(!$books){
            return $this->sendError('', 'Not Found', 404);
        }

        return $this->sendResponse($books, '');
    }

    /**
     * Display a book.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {

        $book = Book::where('id', $id)->first();

        if(!$book){
            return $this->sendError('', 'Not Found', 404);
        }

        return $this->sendResponse($book, '');
    }

    /**
     * Create new book.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'authors' => 'required',
            'preface' => 'required',
            'language' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('', $validator->errors(), 401);
        }

        try {
            $book = new stdClass();
            $book->title = $input['title'];
            $book->authors = $input['authors'];
            $book->preface = $input['preface'];
            $book->language = $input['language'];

            if(!empty($input['tags'])){
                $book->tags = serialize(explode(",", $input['tags']));
            }

            if($file = $request->file('image')){
                $book->image = $file->store('book_images');
            }

            $book->id = Book::create($book)->id;
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $validator->errors(), 500);
        }

        return $this->sendResponse($book, '');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required',
            'title' => 'required',
            'authors' => 'required',
            'preface' => 'required',
            'language' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('', $validator->errors(), 401);
        }

        try {
            $book = Book::where('id', $input['id'])->first();
            $book->id = $input['id'];
            $book->title = $input['title'];
            $book->authors = $input['authors'];
            $book->preface = $input['preface'];
            $book->language = $input['language'];

            $book->tags = serialize(explode(",", $input['tags']));

            $book->image = $request->file('image')->store('book_images');

            $book->save();
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $validator->errors(), 500);
        }

        return $this->sendResponse($book, '');
    }

    /**
     * Delete a book from id.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id){
        try {
            $user = Book::where('id', $id)->first();
            $user->delete();
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $e->getMessage(), 500);
        }

        return $this->sendResponse('', 'Success');
    }
}
