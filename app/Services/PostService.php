<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class PostService
{
    public function all(): LengthAwarePaginator
    {
        return Post::query()->paginate(10); //todo set params to pagination
    }
}
