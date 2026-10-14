<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Submit Contact Form (SRS 5.1 - POST /api/v1/contact)
     * Throttled by Route Middleware (5 req/min)
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $message = Message::create([
            'sender_name' => $validated['name'],
            'sender_email' => $validated['email'],
            'project_type' => $validated['project_type'] ?? null,
            'budget_range' => $validated['budget_range'] ?? null,
            'message' => $validated['message'],
            'is_read' => false,
            'ip_address' => $request->ip(),
        ]);

        // Log notification simulation (or Mail::queue if mail server configured)
        Log::info("አዲስ መልዕክት ከ {$message->sender_name} ({$message->sender_email}) ተልኳል: {$message->message}");

        return response()->json([
            'status' => 'success',
            'message' => 'መልዕክትዎ በተሳካ ሁኔታ ደርሷል! እናመሰግናለን፤ በቅርቡ ምላሽ እንሰጣለን። (Message sent successfully!)',
            'data' => [
                'id' => $message->id,
                'created_at' => $message->created_at->diffForHumans(),
            ],
        ], 201);
    }

    /**
     * Admin: List received messages (SRS 5.2 - GET /api/v1/admin/messages)
     */
    public function index(): JsonResponse
    {
        $messages = Message::orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'unread_count' => $messages->where('is_read', false)->count(),
            'data' => $messages,
        ]);
    }

    /**
     * Admin: Mark message as read
     */
    public function markAsRead(int $id): JsonResponse
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => true]);

        return response()->json([
            'message' => 'መልዕክቱ እንደተነበበ ተመዝግቧል (Marked as read)',
            'data' => $message,
        ]);
    }

    /**
     * Admin: Delete message
     */
    public function destroy(int $id): JsonResponse
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return response()->json([
            'message' => 'መልዕክት ተሰርዟል (Message deleted successfully)',
        ]);
    }
}
