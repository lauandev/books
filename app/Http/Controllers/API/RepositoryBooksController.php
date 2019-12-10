<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RepositoryBooks;
use Exception as Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use stdClass;

class RepositoryBooksController extends Controller
{

    /**
     * Display a Repository of books.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {

        $repository_book = RepositoryBooks::where('id', $id)->first();

        if(!$repository_book){
            return $this->sendError('', 'Not Found', 404);
        }

        return $this->sendResponse($repository_book, '');
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
            'user_id' => 'required',
            'book_id' => 'required',
            'status_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('', $validator->errors(), 401);
        }

        try {
            $repository_book = new stdClass();
            $repository_book->user_id = $input['user_id'];
            $repository_book->book_id = $input['book_id'];
            $repository_book->status_id = $input['status_id'];

            $repository_book->id = RepositoryBooks::create($repository_book)->id;
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $e->getMessage(), 500);
        }

        return $this->sendResponse($repository_book, '');
    }


    /**
     * Update a repository from id.
     *
     * @param Request $request
     * @param RepositoryBooks $repository_book
     * @return JsonResponse
     */
    public function update(Request $request, RepositoryBooks $repository_book)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required',
            'user_id' => 'required',
            'book_id' => 'required',
            'status_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('', $validator->errors(), 401);
        }

        try {
            $repository_book->user_id = $input['user_id'];
            $repository_book->book_id = $input['book_id'];
            $repository_book->status_id = $input['status_id'];
            $repository_book->save();
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $e->getMessage(), 500);
        }

        return $this->sendResponse($repository_book, '');
    }

    /**
     * Delete a repository from id.
     *
     * @param RepositoryBooks $repository_book
     * @return JsonResponse
     */
    public function destroy(RepositoryBooks $repository_book){
        try {
            $repository_book->delete();
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $e->getMessage(), 500);
        }

        return $this->sendResponse($repository_book, 'Success');
    }
}
