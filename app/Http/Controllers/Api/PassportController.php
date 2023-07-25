<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PassportController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $exist = DB::table('users')->where('email', $request->email)->get();
        //echo ("Usuario: ".$exist);exit();
        if (sizeof($exist) > 0) {
            return response()->json(['success' => false, 'state' => 900, 'message' => 'Correo electrónico fue registrado.']);
        }
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
       
        $token = $user->createToken('ProjectICEITech')->accessToken;
 
        return response()->json(['success' => true, 'state' => 200, 'message' => 'Usuario registrado.', 'token' => $token], 200);
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('ProjectICEITech')->accessToken;
            return response()->json(['success' => true, 'state' => 200, 'message' => 'Usuario autorizado.', 'token' => $token], 200);
        } else {
            return response()->json(['success' => false, 'state' => 401, 'message' => 'Usuario no autorizado.'], 401);
        }
    }   
}
