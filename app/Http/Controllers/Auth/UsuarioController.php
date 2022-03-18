<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    
    
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|max:45',
            'email' => 'required|email|unique:users|max:45',
            'password' => 'required|max:100',
            'S_Nombre' => 'required|max:45',
            'S_Apellidos' => 'required|max:45',
            'S_FotoPerfilUrl' => 'required|max:255',
            'S_Activo' => 'required|max:1',
        ]);


       // User::create($request->all());
        
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'S_Nombre' => $request->S_Nombre,
            'S_Apellidos' => $request->S_Apellidos,
            'S_FotoPerfilUrl' => $request->S_FotoPerfilUrl,
            'S_Activo' => $request->S_Activo,
        ]);

        return response()->json([
            'message' => 'El usuario se ha creado correctamente!'
        ], 201);
    } 

    public function login(Request $request)
    {
       $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Usuario no autorizado'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Token de acceso personal');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'La sesión se ha cerrado con éxito'
        ], 201);
    }

    public function user(Request $request)
    {
        
        return response()->json($request->user());
    }
}
