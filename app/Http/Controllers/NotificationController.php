<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * List all notifications for a specific user.
     */
    public function viewNotifications($userId = null)
    {
        $user = Auth::user();

        // If userId is provided and does not match the authenticated user, check for admin privileges
        if ($userId && $user->id != $userId && $user->role_id !== 1) {
            return response()->json(['error' => 'Unauthorized access to notifications.'], 403);
        }

        // Fetch notifications for the authenticated user or specified userId
        $userId = $userId ?: $user->id; // Default to authenticated user's ID if userId is not provided
        $notifications = Notification::where(function ($query) use ($user, $userId) {
            if ($user->role_id == 2) { // Client
                $query->where('client_id', $userId);
            } elseif ($user->role_id == 3) { // Freelancer
                $query->where('freelancer_id', $userId);
            }
        })->orderBy('created_at', 'desc')->get();

        return response()->json($notifications, 200);
    }

    /**
     * Send a notification to a specific user.
     */
    public function sendNotification(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'role' => 'required|in:client,freelancer',
            'message' => 'required|string',
        ]);

        Notification::create([
            'client_id' => $validated['role'] == 'client' ? $validated['user_id'] : null,
            'freelancer_id' => $validated['role'] == 'freelancer' ? $validated['user_id'] : null,
            'message' => $validated['message'],
            'seen' => 0,
        ]);

        return response()->json(['message' => 'Notification sent successfully'], 201);
    }

    /**
     * Mark a notification as seen.
     */
    public function markAsSeen($id)
    {
        $notification = Notification::findOrFail($id);

        // Check if the notification belongs to the authenticated user
        if ((Auth::user()->role_id == 2 && Auth::user()->client->id != $notification->client_id) ||
            (Auth::user()->role_id == 3 && Auth::user()->freelancer->id != $notification->freelancer_id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->update(['seen' => 1]);

        return response()->json(['message' => 'Notification marked as seen', 'notification' => $notification], 200);
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        // Check if the notification belongs to the authenticated user
        if ((Auth::user()->role_id == 2 && Auth::user()->client->id != $notification->client_id) ||
            (Auth::user()->role_id == 3 && Auth::user()->freelancer->id != $notification->freelancer_id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully'], 200);
    }
}
