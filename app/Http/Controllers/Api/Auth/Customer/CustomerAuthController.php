<?php

namespace App\Http\Controllers\Api\Auth\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ResetPasswordOtpMail;
use Carbon\Carbon;

class CustomerAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('customer', ['role-customer'])->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('customner', ['role-customer'])->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // If user exists, update OTP. If not, create a new entry.
        $otp = rand(100000, 999999);

        $user = User::updateOrCreate(
            ['email' => $request->email], // condition to find the user by email
            [
                'otp' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(15),
            ]
        );

        // Send OTP email
        Mail::to($user->email)->send(new ResetPasswordOtpMail($user->name, $otp));

        return response()->json(['message' => 'OTP sent successfully'], 200);
    }

    public function checkOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|integer',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        if ($user->otp !== (int) $request->otp) {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }
        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return response()->json(['message' => 'OTP has expired'], 400);
        }
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        return response()->json(['message' => 'Password reset successfully'], 200);
    }



    /**
     * Verify OTP and reset password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'nullable',
            'new_password_confirmation' => 'nullable|same:new_password',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return response()->json(['message' => 'Password reset successfully'], 200);
    }
}
