<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function createToken(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ]);


        if (auth()->attempt($credentials)) {
            $user = User::where('email', 'test@example.com')->first();

            $token = Str::random(60);

            $user->forceFill([
                'api_token' => hash('sha256', $token),
            ])->save();

            return [
                'data' => [
                    'token' => $token
                ]
            ];
        }

        return response()->json(['error' => 'Unauthorized'], 401);

    }
}
