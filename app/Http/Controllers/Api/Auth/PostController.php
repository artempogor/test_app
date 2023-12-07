<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\PostCreateRequest;
use App\Http\Requests\Api\Post\PostDeleteRequest;
use App\Http\Requests\Api\Post\PostListRequest;
use App\Http\Requests\Api\Post\PostUpdateRequest;
use App\Http\Requests\Api\Post\PostViewRequest;
use App\Http\Resources\Api\PostResource;
use App\Http\Resources\SuccessResource;
use App\Services\Post\PostCreateService;
use App\Services\Post\PostDeleteService;
use App\Services\Post\PostListService;
use App\Services\Post\PostUpdateService;
use App\Services\Post\PostViewService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function __construct(
        protected readonly PostCreateService $createService,
        protected readonly PostUpdateService $updateService,
        protected readonly PostDeleteService $deleteService,
        protected readonly PostViewService   $viewService,
        protected readonly PostListService   $listService,
    )
    {
    }

    public function create(PostCreateRequest $request): PostResource
    {
        $result = $this->createService->create($request->toServiceParams());

        return PostResource::make($result->getPost());
    }

    public function update(PostUpdateRequest $request): PostResource
    {
        $result = $this->updateService->update($request->toServiceParams());

        return PostResource::make($result->getPost());
    }

    public function delete(PostDeleteRequest $request): SuccessResource
    {
        $this->deleteService->delete($request->toServiceParams());

        return SuccessResource::empty();
    }

    public function view(PostViewRequest $request): PostResource
    {
        $result = $this->viewService->view($request->toServiceParams());

        return PostResource::make($result->getPost());
    }

    public function list(PostListRequest $request): AnonymousResourceCollection
    {
        $result = $this->listService->list($request->toServiceParams());

        return PostResource::collection($result->getItems());
    }
}