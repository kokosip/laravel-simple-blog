<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Repositories\PostRepositories;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponse;
    protected $postRepositories;

    public function __construct(PostRepositories $postRepositories)
    {
        $this->postRepositories = $postRepositories;
    }

    public function listPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable',
            'per_page' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->validationResponse($validator);
        }

        $status = $request->input("status");
        $perPage = is_null($request->input('per_page')) ? 5 : $request->input('per_page');

        $data = $this->postRepositories->getListPost($status, $perPage);

        return view('posts.index', ['posts' => $data]);
    }

    public function singlePost($id)
    {
        $data = $this->postRepositories->getSinglePost($id);

        return view('posts.show', ['post' => $data]);
    }
}
