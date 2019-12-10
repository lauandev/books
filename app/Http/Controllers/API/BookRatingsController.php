<?php

namespace App\Http\Controllers\API;

use App\Models\BookRatings;
use Exception as Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use stdClass;

class BookRatingsController extends Controller
{
    /**
     * Display a listing of the books ratings.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $book_ratings = BookRatings::all();

        if(!$book_ratings){
            return $this->sendError('', 'Not Found', 404);
        }

        return $this->sendResponse($book_ratings, '');
    }

    /**
     * Display a book rating.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {

        $book_rating = BookRatings::where('id', $id)->first();

        if(!$book_rating){
            return $this->sendError('', 'Not Found', 404);
        }

        return $this->sendResponse($book_rating, '');
    }

    /**
     * Create new book rating.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'required',
            'book_id' => 'required',
            'rating' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('', $validator->errors(), 401);
        }

        try {
            $book_rating = new stdClass();
            $book_rating->user_id = $input['user_id'];
            $book_rating->book_id = $input['book_id'];
            $book_rating->rating = $input['rating'];
            $book_rating->comment = $input['comment'];

            $book_rating->id = BookRatings::create($book_rating)->id;
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $validator->errors(), 500);
        }

        return $this->sendResponse($book_rating, '');
    }


    /**
     * Update a book rating from id.
     *
     * @param Request $request
     * @param BookRatings $book_rating
     * @return JsonResponse
     */
    public function update(Request $request, BookRatings $book_rating)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required',
            'user_id' => 'required',
            'book_id' => 'required',
            'rating' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('', $validator->errors(), 401);
        }

        try {
            $book_rating->user_id = $input['user_id'];
            $book_rating->book_id = $input['book_id'];
            $book_rating->rating = $input['rating'];
            $book_rating->comment = $input['comment'];

            $book_rating->save();
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $validator->errors(), 500);
        }

        return $this->sendResponse($book_rating, '');
    }

    /**
     * Delete a book rating from id.
     *
     * @param BookRatings $book_rating
     * @return JsonResponse
     */
    public function destroy(BookRatings $book_rating){
        try {
            $book_rating->delete();
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $e->getMessage(), 500);
        }

        return $this->sendResponse('', 'Success');
    }
}
