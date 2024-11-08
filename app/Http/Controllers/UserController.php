<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    /**
     * Register a new user with role selection.
     */
// In your Laravel controller
public function getUserDetails(Request $request)
{
    // Replace 'custom_guard' with the actual guard name (e.g., 'sanctum', 'web', 'api')
    $user = auth('custom_guard')->user();

    if (!$user) {
        return response()->json(['message' => 'User not authenticated'], 401);
    }

    return response()->json($user);
}


    public function register(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);
    
        $validated['password'] = Hash::make($validated['password']);
    
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role_id' => $validated['role_id'],
        ]);
    
        if ($validated['role_id'] == 2) {
            Client::create([
                'user_id' => $user->id,
                'full_name' => $validated['name'],
                'email' => $user->email,
                'password' => $user->password,
                'phone_number' => null,
                'status' => 1,
                'address_id' => null,
            ]);
        } elseif ($validated['role_id'] == 3) {
            Freelancer::create([
                'user_id' => $user->id,
                'full_name' => $validated['name'],
                'email' => $user->email,
                'password' => $user->password,
                'portfolio' => null,
                'experience' => null,
                'skills' => null,
                'status' => 1,
                'address_id' => null,
                'educational_status_id' => null,
            ]);
        }
    
        return $this->respondWithToken($user, 'User registered successfully');
    }
    
    
    

    /**
     * Login a user and issue a token.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        $user = Auth::user();
        $tokenName = 'custom_auth_token'; // Custom token name
        $token = $user->createToken($tokenName)->plainTextToken;
    
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
    
    /**
     * Logout the authenticated user and revoke tokens.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /**
     * Update the authenticated user's profile based on role.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user instance

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            // 'role_id' => 'sometimes|integer|exists:roles,id', // Ensure the role exists
            //  'full_name' => 'required|string|max:255',
        ]);

        // Hash password if it exists in the request
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Update user's general attributes
        $user->update($validated);

        // Role-specific profile updates
        if ($user->role_id == 2 && $user->client) { // Client-specific updates
            $user->client->update($request->only(['phone_number', 'status', 'address_id']));
        } elseif ($user->role_id == 3 && $user->freelancer) { // Freelancer-specific updates
            $user->freelancer->update($request->only(['experience','address_id', 'status', 'portfolio', 'skills', 'educational_status_id']));
        }

        // Load client or freelancer relationship data to include in the response
        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user->load('client', 'freelancer')
        ], 200);
    }

    /**
     * View a user's public profile with role-specific details.
     */
    public function viewProfile($id)
    {
        $user = User::with('role')->findOrFail($id);

        // Load either client or freelancer profile based on the user's role
        $profile = $user->role_id == 2 
            ? $user->client()->with(['jobPosts'])->first() 
            : $user->freelancer()->with(['portfolio', 'ratings'])->first();

        return response()->json(['user' => $user, 'profile' => $profile], 200);
    }

    /**
     * Generate token response for registered or logged-in users.
     */
    protected function respondWithToken(User $user, $message)
    {
        return response()->json([
            'message' => $message,
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ], 201);
    }
}
