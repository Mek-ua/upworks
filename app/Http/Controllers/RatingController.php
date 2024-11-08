<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Submit a rating and feedback for a contract.
     */
    public function rateContract(Request $request, $contractId)
    {
        $contract = Contract::findOrFail($contractId);

        // Ensure that only the client or freelancer involved in the contract can rate
        $user = Auth::user();
        $isClient = $user->role_id == 2 && $contract->client_id == $user->client->id;
        $isFreelancer = $user->role_id == 3 && $contract->freelancer_id == $user->freelancer->id;

        if (!$isClient && !$isFreelancer) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Validate input based on the user's role
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000',
        ]);

        // Check if a rating already exists for this contract
        $rating = Rating::firstOrNew(['contract_id' => $contractId]);

        // Update rating and feedback based on user role
        if ($isClient) {
            $rating->client_rating = $validated['rating'];
        } else if ($isFreelancer) {
            $rating->freelancer_rating = $validated['rating'];
        }

        $rating->feedback = $validated['feedback'] ?? $rating->feedback;
        $rating->contract_id = $contractId;
        $rating->save();

        return response()->json(['message' => 'Rating submitted successfully', 'rating' => $rating], 200);
    }

    /**
     * View ratings for a specific contract.
     */
    public function viewContractRating($contractId)
    {
        $rating = Rating::where('contract_id', $contractId)->firstOrFail();
        return response()->json($rating, 200);
    }

    /**
     * View all ratings given to a specific user (client or freelancer).
     */
    public function viewUserRatings($userId)
    {
        $user = Auth::user();

        if ($user->id != $userId && $user->role_id != 1) { // Only admin or the user themselves can view
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $ratings = Rating::whereHas('contract', function ($query) use ($userId) {
            $query->where('client_id', $userId)->orWhere('freelancer_id', $userId);
        })->get();

        return response()->json($ratings, 200);
    }
}
