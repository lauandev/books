<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RepositoryBookStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RepositoryBookStatusController extends Controller
{
    /**
     * Get status.
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $status = RepositoryBookStatus::where('id', $id)->first();

        if(!$status){
            return $this->sendError('', 'Not Found', 401);
        }

        return $this->sendResponse($status, '');
    }
}
