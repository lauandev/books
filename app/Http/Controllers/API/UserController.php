<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception as Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use stdClass;


/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Get user by id.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id){
        $user = User::where('id', $id)->first();

        if(!$user){
            return $this->sendError('', 'Not Found', 404);
        }

        return $this->sendResponse($user, '');
    }

    /**
     * Login.
     *
     * @return JsonResponse
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('App')->accessToken;
            return $this->sendResponse($success, '');
        }
        else{
            return $this->sendError('Unauthorized', 'Unauthorized', 401);
        }
    }

    /**
     * Register.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('', $validator->errors(), 401);
        }

        try {
            $user = new stdClass();
            $user->password = bcrypt($input['password']);

            if($request->file('profile_image')){
                $user->profile_image = $request->file('profile_image')->store('profile_images');
            }

            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->token = $user->createToken('App')->accessToken;
            $user->id = User::create($input)->id;
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $validator->errors(), 500);
        }

        return $this->sendResponse($user, '');
    }

    /**
     * Details from user authenticated
     *
     * @return JsonResponse
     */
    public function details()
    {
        $user = Auth::user();

        if(!$user){
            return $this->sendError('', 'Not Found', 404);
        }

        return $this->sendResponse($user->toArray(), '');
    }

    /**
     * Update a user.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        try {
            if(!$user){
                return $this->sendError('', $validator->errors(), 404);
            }

            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->profile_image = $request->file('profile_image')->store('profile_images');
            $user->password = bcrypt($input['password']);
            $user->save();
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $validator->errors(), 500);
        }

        return $this->sendResponse($user, '');
    }

    /**
     * Delete a user from id.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user){
        try {
            if(!$user){
                return $this->sendError('', 'Not Found', 404);
            }

            $user->delete();
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('', $e->getMessage(), 500);
        }

        return $this->sendResponse('', 'Success');
    }
}
