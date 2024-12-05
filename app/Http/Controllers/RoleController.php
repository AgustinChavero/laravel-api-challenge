<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\ToggleRoleRequest;
use App\Models\User;
use App\Models\Role;
use App\Traits\AuthValidationTrait;

class RoleController extends Controller
{
    use AuthValidationTrait;

    public function toggleRole(ToggleRoleRequest $request, $userId)
    {
        $currentUser = $this->validateAuthenticatedUser();
        if (is_string($authResponse)) {
            return response()->json([
                'status' => false,
                'message' => $authResponse,
            ], 404);
        }

        if ($currentUser->role_id !== 1) {
            return response()->json([
                'status' => false,
                'message' => 'No autorizado para modificar roles de usuarios',
            ], 403);
        }

        $user = User::find($userId);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        if ($user->role_id === 1) {
            return response()->json([
                'status' => false,
                'message' => 'No se permite modificar el rol de otro administrador',
            ], 403);
        }

        $role = Role::find($request->role_id);
        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'No se encontró el rol al que se quiere actualizar',
            ], 404);
        }

        $user->role_id = $request->role_id;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $user->roles()->pluck('name'),
        ], 200);
    }
}
