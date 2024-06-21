<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $validatedData = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ];

        $user = User::create($validatedData);
        //User adalah model yang dipanggil dari file User.php (model user)

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Membuat Akun',
            'data' => $user,
        ]);
    }

    public function login(Request $request)
    {
        $input = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('email', $input['email'])->first();

        if (Auth::attempt($input)) {
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Login Berhasil',
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Username/Password Salah',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Anda Berhasil Logout',
        ]);
    }

    public function user()
    {
        return response()->json(Auth::user());
    }
}
