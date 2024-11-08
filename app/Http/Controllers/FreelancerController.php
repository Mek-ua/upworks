<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FreelancerController extends Controller
{
    public function updateFreelancerDetails(Request $request, $id)
    {
        Log::info('HTTP method:', [$request->method()]);
        Log::info('Updating freelancer details for user ID:', [$id]);
    
        // Check if the freelancer exists
        $freelancer = Freelancer::where('user_id', $id)->first();
        if (!$freelancer) {
            return response()->json(['message' => 'Freelancer not found'], 404);
        }
    
        // Validate the request data
        $validatedData = $request->validate([
            'experience' => 'required|string',
            'skills' => 'required|json',
            'address_id' => 'required|exists:addresses,id',
            'educational_status_id' => 'nullable|exists:educational_statuses,id',
            'status' => 'required|boolean',
            'portfolio' => 'nullable|file|mimes:pdf,doc,docx,txt',
        ]);
    
        // Decode the skills field from JSON to an array
        $validatedData['skills'] = json_decode($validatedData['skills'], true);
    
        // Handle the portfolio file upload
        if ($request->hasFile('portfolio')) {
            $path = $request->file('portfolio')->store('portfolios', 'public');
            $validatedData['portfolio'] = $path;
        }
    
        // Update the freelancer details
        $freelancer->update($validatedData);
    
        return response()->json(['message' => 'Freelancer details updated successfully!'], 200);
    }
    

    /**
     * Update the authenticated freelancer's profile or a specific freelancer's profile by ID.
     *
     * @param Request $request
     * @param int|null $id Optional freelancer ID for admin access to update a specific freelancer's profile.
     */
    public function updateProfile(Request $request, $id = null)
    {
        // Update by ID if $id is provided (admin access); otherwise, update the authenticated freelancer's profile.
        $freelancer = $id 
            ? Freelancer::findOrFail($id) // Admin access: fetch specific freelancer by ID
            : Auth::user()->freelancer()->first(); // Authenticated freelancer access: fetch own profile

        // Validate fields specific to freelancer profile
        $validated = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:freelancers,email,' . $freelancer->id,
            'phone_number' => 'sometimes|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'portfolio' => 'sometimes|string|max:2000',
            'experience' => 'sometimes|string|max:500',
            'address_id' => 'nullable|exists:addresses,id',
            'educational_status_id' => 'nullable|exists:educational_status,id',
            'status' => 'sometimes|in:active,inactive' // Allow updating freelancer status
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $freelancer->update($validated);

        return response()->json(['message' => 'Profile updated successfully', 'freelancer' => $freelancer], 200);
    }

    /**
     * List job posts that might match the freelancer's skills (optional).
     */
    public function listAvailableJobs()
    {
        $freelancer = Auth::user()->freelancer()->first();
        $skills = $freelancer->skills->pluck('id');

        // Find job posts that match the freelancer's skills
        $jobPosts = JobPost::whereHas('skills', function ($query) use ($skills) {
            $query->whereIn('id', $skills);
        })->get();

        return response()->json($jobPosts, 200);
    }
}
