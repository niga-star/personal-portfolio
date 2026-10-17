<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Admin Login (SRS 5.2 - POST /api/v1/auth/login)
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['የተሳሳተ ኢሜይል ወይም የይለፍ ቃል (Invalid credentials provided).'],
            ]);
        }

        // Revoke older tokens if needed and create new
        $token = $user->createToken('admin-api-token')->plainTextToken;

        return response()->json([
            'message' => 'ስኬታማ የመግቢያ ሂደት (Login successful)',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * Get Current Authenticated User (SRS 5.2)
     */
    public function user(Request $request): JsonResponse
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    /**
     * Admin: Change Password
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = $request->user();

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return response()->json([
            'message' => 'የይለፍ ቃል በተሳካ ሁኔታ ተቀይሯል (Password updated successfully)',
        ]);
    }

    /**
     * Logout & Revoke Token
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'በስኬት ወጥተዋል (Logged out successfully)',
        ]);
    }
}
