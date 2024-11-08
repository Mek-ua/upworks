<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * List all roles.
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles, 200);
    }

    /**
     * Assign a role to a user.
     */
    public function assignRole(Request $request, $userId)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($userId);
        $user->role_id = $validated['role_id'];
        $user->save();

        return response()->json([
            'message' => 'Role assigned successfully',
            'user' => $user->load('role')
        ], 200);
    }
}
