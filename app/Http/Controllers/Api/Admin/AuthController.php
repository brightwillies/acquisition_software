<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use DateTime;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        try {
            $rules = [

                'email' => 'required',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }
            
            $password = $request->password;
            $email = $request->email;
            $admin = Administrator::where('email', (string) $email)->first();
            if (!$admin) {
                return $this->wrongCredentialsResponse();
            }

            if (Hash::check($password, $admin->password)) {
                $now_seconds = time();
                $userpemissions = array();
                $payload = [
                    "iss" => url("/"),
                    "iat" => time(),
                    "exp" => $now_seconds + (60 * 6300),
                    "id" => $admin->id,
                ];
                // Generate token
                if ($token = JWT::encode($payload, config("app.key"), 'HS256')) {

                    // $admin->last_login = new DateTime();
                    // $admin->save();
                    return $this->successResponse("Login Successful", [
                        "user" => $admin,
                        "token" => $token,

                    ]);
                }
            }
            return $this->wrongCredentialsResponse();

        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
