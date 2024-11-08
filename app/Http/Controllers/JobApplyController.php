<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\JobApply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplyController extends Controller
{
    /**
     * Apply to a job post (freelancer-only).
     */
    public function apply(Request $request, $jobPostId)
    {
        // Ensure the authenticated user is a freelancer
        $freelancer = Auth::user()->freelancer;
        if (!$freelancer) {
            return response()->json(['error' => 'Only freelancers can apply for jobs.'], 403);
        }

        // Check if the freelancer has already applied
        if (JobApply::where('freelancer_id', $freelancer->id)->where('job_post_id', $jobPostId)->exists()) {
            return response()->json(['error' => 'You have already applied for this job.'], 409);
        }

        // Validate application data
        $validated = $request->validate([
            'cover_letter' => 'nullable|string|max:2000',
            'proposed_rate' => 'required|numeric|min:1',
        ]);

        // Create a new job application
        $application = JobApply::create([
            'freelancer_id' => $freelancer->id,
            'job_post_id' => $jobPostId,
            'cover_letter' => $validated['cover_letter'],
            'proposed_rate' => $validated['proposed_rate'],
            'status' => 'pending', // Default status
        ]);

        return response()->json(['message' => 'Application submitted successfully', 'application' => $application], 201);
    }

    /**
     * View applications for a specific job post (client-only).
     */
    public function viewApplications($jobPostId)
    {
        $client = Auth::user()->client;
        if (!$client) {
            return response()->json(['error' => 'Only clients can view applications for their jobs.'], 403);
        }

        $jobPost = JobPost::where('client_id', $client->id)->findOrFail($jobPostId);

        // Retrieve applications with freelancer details
        $applications = JobApply::where('job_post_id', $jobPostId)
            ->with('freelancer')
            ->get();

        return response()->json($applications, 200);
    }

    /**
     * View details of a specific application (accessible to both freelancer and client).
     */
    public function viewApplication($id)
    {
        $application = JobApply::with(['freelancer', 'jobPost'])->findOrFail($id);

        // Authorization: ensure the client or freelancer owns the application
        $user = Auth::user();
        if (
            ($user->freelancer && $user->freelancer->id === $application->freelancer_id) ||
            ($user->client && $user->client->id === $application->jobPost->client_id)
        ) {
            return response()->json($application, 200);
        }

        return response()->json(['error' => 'You are not authorized to view this application.'], 403);
    }

    /**
     * Withdraw an application (freelancer-only).
     */
    public function withdrawApplication($id)
    {
        $freelancer = Auth::user()->freelancer;
        if (!$freelancer) {
            return response()->json(['error' => 'Only freelancers can withdraw applications.'], 403);
        }

        $application = JobApply::where('freelancer_id', $freelancer->id)->findOrFail($id);
        $application->delete();

        return response()->json(['message' => 'Application withdrawn successfully'], 200);
    }

    public function viewMyApplications()
{
    $freelancer = Auth::user()->freelancer;

    if (!$freelancer) {
        return response()->json(['error' => 'Only freelancers can view their applications.'], 403);
    }

    $applications = $freelancer->applications()->with(['jobPost', 'status'])->get();

    return response()->json($applications, 200);
}
}
