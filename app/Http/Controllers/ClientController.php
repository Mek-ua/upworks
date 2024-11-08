<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function updateClientDetails(Request $request, $id)
    {
        // Log HTTP method for debugging
        Log::info('HTTP method:', [$request->method()]);
        Log::info('Updating client details for user ID:', [$id]);
        
        // Fetch the client record based on the user_id
        $client = Client::where('user_id', $id)->first();
    
        // Check if the client was found
        if (!$client) {
            Log::warning('Client not found for user ID:', [$id]);
            return response()->json(['message' => 'Client not found'], 404);
        }
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'phone_number' => 'required|string|max:20',
            'address_id' => 'required|exists:addresses,id',
            'status' => 'required|boolean',
        ]);
    
        // Update the client with validated data
        $client->update($validatedData);
    
        // Return a success response
        return response()->json(['message' => 'Client details updated successfully!'], 200);
    }
     /**
     * Display the authenticated client's profile or a specific client's profile by ID.
     *
     * @param int|null $id Optional client ID for admin access to a specific client profile.
     */
    public function showProfile($id = null)
    {
        if ($id) {
            // Admin access: Ensure the current user has the required permissions.
            $this->authorize('view', Client::class);
            $client = Client::with('address')->findOrFail($id);
        } else {
            $client = Auth::user()->client()->with('address')->first();

            if (!$client) {
                return response()->json(['error' => 'Client profile not found'], 404);
            }
        }

        return response()->json($client, 200);
    }

    /**
     * Update the authenticated client's profile or a specific client's profile by ID.
     *
     * @param Request $request
     * @param int|null $id Optional client ID for admin access to update a specific client profile.
     */
    public function updateProfile(Request $request, $id = null)
    {
        if ($id) {
            // Admin access: Ensure the current user has the required permissions.
            $this->authorize('update', Client::class);
            $client = Client::findOrFail($id);
        } else {
            $client = Auth::user()->client()->first();

            if (!$client) {
                return response()->json(['error' => 'Client profile not found'], 404);
            }
        }

        // Validate the fields that can be updated
        $validated = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:clients,email,' . $client->id,
            'phone_number' => 'sometimes|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'address_id' => 'nullable|exists:addresses,id',
            'status' => 'sometimes|boolean' // Assuming status uses 1 (active) or 0 (inactive)
        ]);

        // Hash the password if it needs to be updated
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        // Update the client's information
        $client->update($validated);

        return response()->json(['message' => 'Profile updated successfully', 'client' => $client], 200);
    }

    /**
     * List job posts created by the authenticated client.
     */
    public function listJobPosts()
    {
        $client = Auth::user()->client()->first();

        if (!$client) {
            return response()->json(['error' => 'Client profile not found'], 404);
        }

        $jobPosts = JobPost::where('client_id', $client->id)->get();

        return response()->json($jobPosts, 200);
    }
}
