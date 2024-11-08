<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\JobApply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    /**
     * Create a new contract after a job application is accepted (client-only).
     */
    public function create(Request $request, $applicationId)
    {
        $client = Auth::user()->client;

        if (!$client) {
            return response()->json(['error' => 'Only clients can create contracts.'], 403);
        }

        $application = JobApply::with('jobPost')->findOrFail($applicationId);

        if ($application->jobPost->client_id !== $client->id) {
            return response()->json(['error' => 'You can only create contracts for your job posts.'], 403);
        }

        if ($application->status !== 'accepted') {
            return response()->json(['error' => 'The application must be accepted to create a contract.'], 409);
        }

        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'terms' => 'required|string|max:2000',
            'service_fee' => 'nullable|numeric|min:0'
        ]);

        $contract = Contract::create([
            'job_apply_id' => $application->id,
            'job_post_id' => $application->job_post_id,
            'client_id' => $client->id,
            'freelancer_id' => $application->freelancer_id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'terms' => $validated['terms'],
            'service_fee' => $validated['service_fee'],
            'is_complete' => false,
        ]);

        return response()->json(['message' => 'Contract created successfully', 'contract' => $contract], 201);
    }

    /**
     * View contract details (accessible to both client and freelancer).
     */
    public function view($id)
    {
        $contract = Contract::with(['client', 'freelancer', 'jobApply', 'jobPost'])->findOrFail($id);

        if ($this->authorizeAccess($contract)) {
            return response()->json($contract, 200);
        }

        return response()->json(['error' => 'You are not authorized to view this contract.'], 403);
    }

    /**
     * Mark the contract as completed (both client and freelancer can complete).
     */
    public function completeContract($id)
    {
        $contract = Contract::findOrFail($id);

        if ($this->authorizeAccess($contract)) {
            $contract->update(['is_complete' => true]);
            return response()->json(['message' => 'Contract marked as completed', 'contract' => $contract], 200);
        }

        return response()->json(['error' => 'You are not authorized to complete this contract.'], 403);
    }

    /**
     * Cancel the contract (accessible to both client and freelancer).
     */
    public function cancelContract($id)
    {
        $contract = Contract::findOrFail($id);

        if ($this->authorizeAccess($contract)) {
            $contract->delete();
            return response()->json(['message' => 'Contract has been canceled'], 200);
        }

        return response()->json(['error' => 'You are not authorized to cancel this contract.'], 403);
    }

    /**
     * List all contracts for the authenticated user (freelancer or client).
     */
    public function list()
    {
        $user = Auth::user();

        if ($user->freelancer) {
            $contracts = Contract::where('freelancer_id', $user->freelancer->id)->with(['client', 'jobPost'])->get();
        } elseif ($user->client) {
            $contracts = Contract::where('client_id', $user->client->id)->with(['freelancer', 'jobPost'])->get();
        } else {
            return response()->json(['error' => 'You are not authorized to view contracts.'], 403);
        }

        return response()->json($contracts, 200);
    }

    /**
     * Authorize access based on contract ownership.
     */
    private function authorizeAccess($contract)
    {
        $user = Auth::user();
        return ($user->freelancer && $user->freelancer->id === $contract->freelancer_id) ||
               ($user->client && $user->client->id === $contract->client_id);
    }
}
