<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register
     */
    function register(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|max:60|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,60}$/',
                'plan' => 'required|exists:subscription_plans,id',
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
                'subscription_plan_id' => $request->input('plan'),
                'ends_at' => now()->addMonth(1),
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
            event(new Registered($user));
            // send email
            // send sms
            // return response
            return response()->json([
                'message' => 'Registration successful',
            ], 201);
        } catch (\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
