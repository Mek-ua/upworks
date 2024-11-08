<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Send a new message.
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|integer',
            'receiver_role' => 'required|in:client,freelancer',
            'message' => 'required|string',
        ]);

        $user = Auth::user();
        $senderRole = $user->role_id == 2 ? 'client' : 'freelancer';

        // Prepare chat data based on sender and receiver roles
        $chatData = [
            'message' => $validated['message'],
            'is_read' => 0,
        ];

        // Set the sender based on their role
        if ($senderRole === 'client') {
            $chatData['sender_client_id'] = $user->client->id;
            $chatData['sender_freelancer_id'] = null;
        } else {
            $chatData['sender_freelancer_id'] = $user->freelancer->id;
            $chatData['sender_client_id'] = null;
        }

        // Set the receiver based on the provided role
        if ($validated['receiver_role'] === 'client') {
            $chatData['receiver_client_id'] = $validated['receiver_id'];
            $chatData['receiver_freelancer_id'] = null;
        } else {
            $chatData['receiver_freelancer_id'] = $validated['receiver_id'];
            $chatData['receiver_client_id'] = null;
        }

        // Create the chat message
        $chat = Chat::create($chatData);

        return response()->json(['message' => 'Message sent successfully', 'chat' => $chat], 201);
    }

    /**
     * View conversation between authenticated user and another user.
     */
    public function viewMessages(Request $request, $receiverId, $receiverRole)
    {
        $user = Auth::user();
        $senderRole = $user->role_id == 2 ? 'client' : 'freelancer';

        // Determine sender and receiver columns based on roles
        $senderColumn = $senderRole === 'client' ? 'sender_client_id' : 'sender_freelancer_id';
        $receiverColumn = $receiverRole === 'client' ? 'receiver_client_id' : 'receiver_freelancer_id';

        // Retrieve messages between the authenticated user and the specified receiver
        $messages = Chat::where(function ($query) use ($senderColumn, $receiverColumn, $user, $receiverId) {
            $query->where($senderColumn, $user->id)
                  ->where($receiverColumn, $receiverId);
        })->orWhere(function ($query) use ($senderColumn, $receiverColumn, $user, $receiverId) {
            $query->where($senderColumn, $receiverId)
                  ->where($receiverColumn, $user->id);
        })->orderBy('created_at', 'asc')->get();

        // Mark all received messages as read
        Chat::where($receiverColumn, $user->id)
            ->where($senderColumn, $receiverId)
            ->update(['is_read' => 1]);

        return response()->json($messages, 200);
    }

    /**
     * Mark a specific message as read.
     */
    public function markAsRead($id)
    {
        $message = Chat::findOrFail($id);

        // Check if the message is addressed to the authenticated user
        if ((Auth::user()->role_id == 2 && Auth::user()->client->id != $message->receiver_client_id) ||
            (Auth::user()->role_id == 3 && Auth::user()->freelancer->id != $message->receiver_freelancer_id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message->update(['is_read' => 1]);

        return response()->json(['message' => 'Message marked as read'], 200);
    }
}
