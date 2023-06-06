<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user
     * @param Request $request
     * @return JsonResponse
     */
    function register(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|max:60|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,60}$/',
                'plan' => 'required|exists:plans,id',
                'transfer_code' => 'required|string|regex:/^[0-9]{6}$/',
            ]);
            // create new user
            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'status' => 1,
            ]);
            // create new subscription
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $request->input('plan'),
                'ends_at' => now()->addMonth(1),
                'is_active' => 1,
            ]);
            // create new invoice
            Invoice::create([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'code' => 'INV-' . time(),
                'note' => 'Transfer code: ' . $request->input('transfer_code'),
                'status' => 'pending',
            ]);
            // emit event
//            event(new Registered($user));
            $expiresAt = Carbon::now()->addHour(6);
            // return response
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
                'access_token' => $user->createToken(name: 'accessToken', expiresAt: $expiresAt)->plainTextToken,
            ], 201);
        } catch (\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    /**
     * Verify email address
     * @param EmailVerificationRequest $request
     * @param $id
     * @param $hash
     * @return JsonResponse
     */
    function verify(Request $request, $id , $hash): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
                throw new \Exception(__("auth1"));
            }
            if ($user->hasVerifiedEmail()) {
                throw new \Exception('auth2');
            }
            $user->markEmailAsVerified();
            return response()->json([
                'message' => 'Email verification successful',
            ], 200);
        } catch (\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    /**
     * Resend email verification link
     * @param Request $request
     * @return JsonResponse
     */
    function resend(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);
            $user = User::where('email', $request->input('email'))->first();
            $user->sendEmailVerificationNotification();
            return response()->json([
                'message' => 'Email verification link sent',
            ], 200);
        } catch (\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    /**
     * Login user
     * @param Request $request
     * @return JsonResponse
     */
    function login(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required|string|min:8|max:60',
                'remember_me' => 'boolean',
            ]);
            $credentials = request(['email', 'password']);
            if (!auth()->attempt($credentials)) {
                throw new \Exception('auth3');
            } else{
                $user = User::where('email', $request->input('email'))->first();
            }
            return response()->json([
                'user' => $user,
                'access_token' => $user->createToken('accessToken')->plainTextToken,
            ], 200);
        } catch (\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    /**
     * Logout user
     * @param Request $request
     * @return JsonResponse
     */
    function logout(Request $request): JsonResponse
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'User logged out successfully',
            ], 200);
        } catch (\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
