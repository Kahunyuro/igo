<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

use App\Mail\PasswordResetLinkMail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',

        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),

        ]);
        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //check that the email exists
        $user = User::where('email', $fields['email'])->first();
        //check the password is the same
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad Credentials!'
            ], 401);
        }
        $token = $user->createToken('myAppToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        // Generate a password reset token for the user
        $token = $user->createToken('password-reset')->plainTextToken;

        // Create a password reset link with the token
        $resetLink = URL::temporarySignedRoute(
            'password.reset',
            now()->addMinutes(60),
            ['email' => $user->email, 'token' => $token]
        );

        // Create a Mailable instance for the password reset link
        $mail = new PasswordResetLinkMail($resetLink, $user->name);

        // Send the password reset link to the user's email
        Mail::to($user->email)->send($mail);

        return response()->json([
            'message' => 'Password reset link sent to your email',
        ]);
    }
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
            return response([
                'message' => 'logged out successfully',
            ], 200);
        } else {
            return response([
                'message' => 'Unauthenticated',
            ], 401);
        }
    }
}
