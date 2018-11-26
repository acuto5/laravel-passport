<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Token;

/**
 * Class AuthController
 * @package App\Http\Controllers\API
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request['password'] = Hash::make($request['password']);

        /** @var User $user */
        $user = User::create($request->toArray());



        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        return response(['token' => $token], JsonResponse::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;

                return response(['token' => $token], JsonResponse::HTTP_OK);
            } else {
                return response('Password missmatch!', JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            return response('User does not exist!', JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        /** @var Token $token */
        $token = $request->user()->token();
        $token->revoke();

        return response('Successfully logged out!', JsonResponse::HTTP_OK);
    }
}
