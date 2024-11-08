<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Log;
use Exception;



class JobPostController extends Controller
{
    use AuthorizesRequests;
    /**
     * List all job posts with optional filters for freelancers.
     * Filters: category_id, skill_id, location, budget.
     */
    public function index(Request $request)
    {
        Log::info('Job post creation attempt:', $request->all());
        $jobPosts = JobPost::with(['client', 'skills', 'category']); // Eager load related data

        // Apply optional filters
        if ($request->filled('category_id')) {
            $jobPosts->where('category_id', $request->category_id);
        }
        if ($request->filled('skill_id')) {
            $jobPosts->whereHas('skills', function ($query) use ($request) {
                $query->where('id', $request->skill_id);
            });
        }
       
        if ($request->filled('budget')) {
            $jobPosts->where('budget', '<=', $request->budget);
        }

        return response()->json($jobPosts->get(), 200);
    }

    /**
     * Create a new job post (client-only).
     * Validates required fields and attaches skills to the job post.
     */
    public function store(Request $request)
    {
        Log::info('Job post creation attempt:', $request->all());  // Log the incoming data
    
        $this->authorize('create', JobPost::class);
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'budget' => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
            'skills' => 'array',
            'skills.*' => 'exists:skills,id',
        ]);
    
        try {
            $jobPost = Auth::user()->client->jobPosts()->create($validated);
    
            if ($request->filled('skills')) {
                $jobPost->skills()->attach($request->skills);
            }
    
            return response()->json(['message' => 'Job post created successfully', 'jobPost' => $jobPost], 201);
        } catch (Exception $e) {
            Log::error('Error creating job post:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create job post'], 500);
        }
    }
    


    /**
     * View a specific job post with client, skills, and category information.
     */
    public function show($id)
    {
        $jobPost = JobPost::with(['client', 'skills', 'category'])->findOrFail($id);

        return response()->json($jobPost, 200);
    }

    /**
     * Update a job post (client-only).
     * Allows partial updates and syncs updated skills.
     */
    public function update(Request $request, $id)
    {
        $jobPost = JobPost::findOrFail($id);

        // Authorize client role for updating the job post
        $this->authorize('update', $jobPost);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:2000',
            'budget' => 'sometimes|numeric|min:1',
            'category_id' => 'sometimes|exists:categories,id',
            'skills' => 'array',
            'skills.*' => 'exists:skills,id',
           
        ]);

        // Update the job post with validated fields
        $jobPost->update($validated);

        // Sync skills if provided
        if ($request->filled('skills')) {
            $jobPost->skills()->sync($request->skills);
        }

        return response()->json(['message' => 'Job post updated successfully', 'jobPost' => $jobPost], 200);
    }

    /**
     * Delete a job post (client-only).
     */
    public function destroy($id)
    {
        $jobPost = JobPost::findOrFail($id);

        // Authorize client role for deleting the job post
        $this->authorize('delete', $jobPost);

        $jobPost->delete();

        return response()->json(['message' => 'Job post deleted successfully'], 200);
    }
}
