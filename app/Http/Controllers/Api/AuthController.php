<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AuthController extends BaseController
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|min:1',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        $verifyEmail = DB::table('users')->where('email', $request->email)->get();

        if (sizeof($verifyEmail) > 0) {
            return $this->sendError(                
                ['email' => ['Registered email.']],
                'El correo electronico ya fue registrado.',
                902
            );
        }
 
        //$this->authorize('create-delete-users');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);
       
        $token = $user->createToken('ProjectICEITech')->accessToken;
        $user = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $token
        ];
        return $this->sendResponse(
            $user,
            'El usuario fue registrado.'
        );
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return $this->sendError(
                $validator->errors(),
                'Error de validacion.', 
                900
            );       
        }

        if (auth()->attempt($request->all())) {
            $token = auth()->user()->createToken('ProjectICEITech')->accessToken;
            $user = [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'token' => $token
            ];

            return $this->sendResponse(
                $user,
                'El usuario fue autorizado.'
            );
        } else {
            return $this->sendError(
                ['data' => ['Unauthorized']],
                'El usuario no fue autorizado.',
                401
            );
        }
    }

    /**
     *Logout
     */
    public function logout (Request $request) {
        $token = auth()->user()->token();
        $token->revoke();
        return $this->sendResponse(
            '',
            'La sesión fue finalizada.'
        );
    }
}
