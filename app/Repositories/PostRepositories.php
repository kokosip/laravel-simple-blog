<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PostRepositories
{
    public function getListPost($slug)
    {
        $data = DB::table('posts')
                ->select('id', 'title', 'content', 'slug', 'status', 'created_at')
                ->paginate();

        return $data;
    }
}