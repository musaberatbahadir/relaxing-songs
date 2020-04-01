<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\Error;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ApiResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponse::error(new Error('reg400'), $validator->errors()->messages());
        }

        $user = User::whereEmail($request->input('email'))->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            return ApiResponse::error(new Error('reg401'));
        }

        $user->tokens()->delete();
        return ApiResponse::success($user->createToken($request->input('device_name'))->plainTextToken);
    }
}
