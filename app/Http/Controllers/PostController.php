<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Traits\AuthValidationTrait;
use App\Http\Requests\Posts\StoreInteractionRequest;
use App\Http\Requests\Posts\StorePostRequest;

class PostController extends Controller
{
    use AuthValidationTrait;

    public function index(Request $request)
    {
        $authResponse = $this->validateAuthenticatedUser();

        if (is_string($authResponse)) {
            return response()->json([
                'status' => false,
                'message' => $authResponse,
            ], 404);
        }

        $user = $authResponse;
        $followingIds = $user->following()->pluck('users.id');
        $userPosts = Post::whereIn('user_id', $followingIds)
                    ->with(['user' => function ($query) {
                        $query->select('id', 'name', 'lastname');
                    }])
                    ->orderBy('created_at', 'desc')
                    ->get();

        $sharedPosts = Post::whereIn('id', function ($query) use ($followingIds) {
            $query->select('post_id')
                  ->from('post_interactions')
                  ->whereIn('user_id', $followingIds)
                  ->where('shared', true);
        })
                        ->with(['user' => function ($query) {
                            $query->select('id', 'name', 'lastname');
                        }])
                        ->orderBy('created_at', 'desc')
                        ->get();

        foreach ($sharedPosts as $post) {
            $sharedByUser = PostInteraction::where('post_id', $post->id)
                                ->whereIn('user_id', $followingIds)
                                ->where('shared', true)
                                ->with('user:id,name')
                                ->first();

            $post->shared_by = $sharedByUser ? $sharedByUser->user->name : null;
        }

        $allPosts = $userPosts->merge($sharedPosts)->unique('id')->sortByDesc('created_at')->values();

        return response()->json([
            'status' => true,
            'data' => $allPosts,
        ], 200);
    }

    public function store(StorePostRequest $request)
    {
        $authResponse = $this->validateAuthenticatedUser();

        if (is_string($authResponse)) {
            return response()->json([
                'status' => false,
                'message' => $authResponse,
            ], 404);
        }

        $user = $authResponse;

        $post = new Post($request->all());
        $post->user_id = $user->id;
        $post->save();

        return response()->json([
            'status' => true,
            'message' => 'Post creado exitosamente',
            'data' => $post,
        ], 201);
    }

    public function delete(Request $request, $postId)
    {
        $authResponse = $this->validateAuthenticatedUser();

        if (is_string($authResponse)) {
            return response()->json([
                'status' => false,
                'message' => $authResponse,
            ], 404);
        }

        $user = $authResponse;
        $post = Post::find($postId);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post no encontrado',
            ], 404);
        }

        if ($post->user_id !== $user->id && !in_array($user->role_id, [1, 4])) {
            return response()->json([
                'status' => false,
                'message' => 'No autorizado para eliminar este post',
            ], 403);
        }

        $post->delete();

        return response()->json([
            'status' => true,
            'message' => 'Post eliminado correctamente',
        ], 200);
    }
}
