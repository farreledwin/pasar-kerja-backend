<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) {
        $res = [
            'message' => "login failed",
            'status' => false
        ];

        $req = User::where('email',$request->email)->where('password',$request->password)->first();

        if($req != null) {
            $data = [
                'user_id' => $req->id,
                'email' => $req->email,
                'user_image' => $req->user_image
            ];

            $encryptData = encrypt($data);

            $res = [
                'payload' => [
                    'data' => $encryptData,
                    'message' => 'Success Login',
                ],
                'status' => true
            ];

        return response()->json($res);
        }
    }

    public function decryptDataLogin(Request $request) {
        $payload = decrypt($request->data);

        return response()->json([
            'payload' => [
                'data' => $payload
            ]
        ]);
    }

    public function registerUser(Request $request) {
        $response = [
            'payload' => [
                    "data" => [
                        "message" => "failed to register",
                        "status" => false
                    ]
            ]
        ];
        $newUser = new User();
        $newUser->first_name = $request->firstName;
        $newUser->last_name = $request->lastName;
        $newUser->email = $request->email;
        $newUser->password = bcrypt($request->password);

        if($newUser->save()) {
            $user = User::where('email',$request->email)->first();

            $data = [
                'user_id' => $user->id,
                'email' => $request->email,
            ];

            $response = [
                'payload' => [
                        'data' => encrypt($data),
                        'message' => "success register"
                        ]
            ];
        }

        return response()->json($response,200);

    }
}
