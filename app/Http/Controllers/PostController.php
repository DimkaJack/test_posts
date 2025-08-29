<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

final class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return PostResource::collection(
            resource: $this->postService->all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        return new PostResource(
            resource: $this->postService->store($request->validated())
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): PostResource
    {
        return new PostResource(
            resource: $this->postService->get(id: $id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, int $id): PostResource
    {
        return new PostResource(
            resource: $this->postService->update(
                id: $id,
                data: $request->validated()
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        if ($this->postService->delete($id)) {
            return response()->json(
                status: ResponseAlias::HTTP_NO_CONTENT,
            );
        }

        return response()->json(
            data: ['message' => 'Не удалось удалить пост'],
            status: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
