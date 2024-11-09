<?php

namespace App\Services;

use App\Repositories\PostRepositories;
use Illuminate\Support\Facades\DB;

class PostServices
{
    protected $postRepositories;

    public function __construct(PostRepositories $postRepositories)
    {
        $this->postRepositories = $postRepositories;
    }

    public function getListPost($search, $perPage)
    {
        $rows = $this->postRepositories->getListPost($search, $perPage);

        $pagination = [
            "current_page" => $rows->currentPage(),
            "per_page" => $rows->perPage(),
            "total_page" => ceil($rows->total() / $rows->perPage()),
            "total_row" => $rows->total(),
        ];

        return [
            $rows->items(),
            $pagination
        ];
    }
}