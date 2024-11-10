<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PostRepositories
{
    public function getListPost($status, $perpage)
    {
        $data = DB::table('posts')
                ->select('posts.id','name', 'title', 'slug', 'status', 'posts.created_at')
                ->join('users', 'posts.author_id', '=', 'users.id');
        
        if ($status) {
            $data = $data->where('status', $status);
        }
        
        $data = $data->paginate($perpage);

        return $data;
    }

    public function getSinglePost($id) {
        $data = DB::table('posts')
                ->select('name', 'title', 'content', 'slug', 'status', 'posts.created_at')
                ->join('users', 'posts.author_id', '=', 'users.id')
                ->where('posts.id', $id)
                ->first();
        
        return $data;
    }
}