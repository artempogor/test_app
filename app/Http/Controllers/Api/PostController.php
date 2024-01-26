<?php

namespace App\Http\Controllers\Api;

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
use OpenApi\Annotations as OA;

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

    /**
     * @OA\Post(
     *     path="/posts",
     *     tags={"Posts"},
     *     summary="Создание поста",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/PostCreateRequest")
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *           response=200,
     *           description="Successful operation",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="success",
     *                   example="true",
     *                   type="boolean",
     *               ),
     *               @OA\Property(
     *                   property="data",
     *                   type="object",
     *                   ref="#/components/schemas/PostResource"
     *               ),
     *           )
     *       ),
     *     @OA\Response(response="422", description="Ошибка валидации")
     * )
     */
    public function create(PostCreateRequest $request): PostResource
    {
        $result = $this->createService->create($request->toServiceParams());

        return PostResource::make($result->getPost());
    }

    /**
     * @OA\Patch(
     *     tags={"Posts"},
     *     path="/posts/{postId}",
     *     security={{"bearerAuth":{}}},
     *     summary="Обновление поста",
     *     @OA\Parameter(name="postId", in="path", required=true, description="ID поста", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/PostUpdateRequest"),
     *              }
     *          )
     *      ),
     *          @OA\Response(
     *           response=200,
     *           description="Successful operation",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="success",
     *                   example="true",
     *                   type="boolean",
     *               ),
     *               @OA\Property(
     *                   property="data",
     *                   type="object",
     *                   ref="#/components/schemas/PostResource"
     *               ),
     *           )
     *       ),
     *     @OA\Response(response="422", description="Ошибка валидации")
     * )
     */

    public function update(PostUpdateRequest $request): PostResource
    {
        $result = $this->updateService->update($request->toServiceParams());

        return PostResource::make($result->getPost());
    }

    /**
     * @OA\Delete(
     *     tags={"Posts"},
     *     path="/posts/{postId}",
     *     summary="Удаление поста",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="postId", in="path", required=true, description="ID поста", @OA\Schema(type="integer")),
     *     @OA\Response(
     *     response="201",
     *     description="Пост удалён",
     *     @OA\JsonContent(ref="#/components/schemas/SuccessResource"),
     *     ),
     *     @OA\Response(response="422", description="Ошибка валидации")
     * )
     */
    public function delete(PostDeleteRequest $request): SuccessResource
    {
        $this->deleteService->delete($request->toServiceParams());

        return SuccessResource::empty();
    }

    /**
     * @OA\Get(
     *     tags={"Posts"},
     *     path="/posts/{postId}",
     *     security={{"bearerAuth":{}}},
     *     summary="Просмотр поста",
     *     @OA\Parameter(name="postId", in="path", required=true, description="ID поста", @OA\Schema(type="integer")),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  example="true",
     *                  type="boolean",
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/PostResource"
     *              ),
     *          )
     *      ),
     *     @OA\Response(response="422", description="Ошибка валидации")
     * )
     */
    public function view(PostViewRequest $request): PostResource
    {
        $result = $this->viewService->view($request->toServiceParams());

        return PostResource::make($result->getPost());
    }

    /**
     * @OA\Get(
     *     path="/posts",
     *     tags={"Posts"},
     *     summary="Список постов",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 example="true",
     *                 type="boolean",
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/PostResource")
     *             ),
     *         )
     *     ),
     *    @OA\Response(response="422", description="Ошибка валидации")
     * )
     **/
    public function list(PostListRequest $request): SuccessResource
    {
        $result = $this->listService->list($request->toServiceParams());

        return SuccessResource::make(PostResource::collection($result->getItems()));
    }
}