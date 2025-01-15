<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostInteraction;
use App\Traits\AuthValidationTrait;
use App\Http\Requests\Posts\StoreInteractionRequest;

class PostInteractionController extends Controller
{
    use AuthValidationTrait;

    public function storeInteract(StoreInteractionRequest $request, $postId)
    {
        $authResponse = $this->validateAuthenticatedUser();

        if (is_string($authResponse)) {
            return response()->json([
                'status' => false,
                'message' => $authResponse,
            ], 404);
        }

        $user = $authResponse;

        $validInteractions = ['liked', 'shared', 'favorited', 'saved'];
        $interactions = $request->only($validInteractions);

        if (empty($interactions)) {
            return response()->json([
                'status' => false,
                'message' => 'No se proporcionaron interacciones válidas',
            ], 400);
        }

        $interaction = PostInteraction::firstOrCreate(
            ['user_id' => $user->id, 'post_id' => $postId],
            ['liked' => false, 'shared' => false, 'favorited' => false, 'saved' => false]
        );

        foreach ($interactions as $type => $value) {
            if (in_array($type, $validInteractions)) {
                $interaction->{$type} = $value;
            }
        }

        $interaction->save();

        return response()->json([
            'status' => true,
            'message' => 'Interacciones actualizadas correctamente',
            'data' => $interaction->only($validInteractions),
        ], 200);
    }
}
