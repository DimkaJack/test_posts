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

    public function get(int $id): Post
    {
        return Post::query()->findOrFail($id);
    }

    public function store(array $data): Post
    {
        return Post::query()->create($data);
    }

    public function update(int $id, array $data): Post
    {
        $post = $this->get($id);
        $post->update($data);

        return $post;
    }

    public function delete($id): bool
    {
        $post = $this->get($id);

        return $post->delete();
    }
}
