<?php

namespace App\Http\Controllers;

use App\Services\PostServices;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

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
        $search = $request->input("search");
        $perPage = is_null($request->input('per_page')) ? 10 : $request->input('per_page');

        [$data, $metadata] = $this->postService->getListPost($search, $perPage);
        
        return $this->successResponse(data: $data, metadata: $metadata);
    }
}
