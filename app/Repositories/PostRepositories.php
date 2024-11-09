<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PostRepositories
{
    public function getListPost($status, $perpage)
    {
        $data = DB::table('posts')
                ->select('id', 'title', 'content', 'slug', 'status', 'created_at');
        
        if ($status) {
            $data = $data->where('status', $status);
        }
        
        $data = $data->paginate($perpage, $perpage);

        return $data;
    }
}