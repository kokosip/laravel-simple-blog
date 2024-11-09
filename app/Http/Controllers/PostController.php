<?php

namespace App\Http\Controllers;

use App\Services\PostServices;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponse;
    protected $postService;

    public function __construct(PostServices $postService)
    {
        $this->postService = $postService;
    }

    public function listPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'per_page' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->validationResponse($validator);
        }

        $status = $request->input("status");
        $perPage = is_null($request->input('per_page')) ? 10 : $request->input('per_page');

        [$data, $metadata] = $this->postService->getListPost($status, $perPage);
        
        return $this->successResponse(data: $data, metadata: $metadata);
    }
}
