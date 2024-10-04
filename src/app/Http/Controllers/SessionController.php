<?php

namespace App\Http\Controllers;

use App\Enums\TokenAbility;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Symfony\Component\HttpFoundation\Response;

class SessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email:strict', 'max:255'],
            'password' => ['required', 'max:20', 'string'],
        ]);

        try
        {
            $request->authenticate();

            $accessToken = $request->user()->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.ac_expiration')));
            $refreshToken = $request->user()->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], Carbon::now()->addMinutes(config('sanctum.rt_expiration')));

            $success['access_token'] =  $accessToken->plainTextToken;
            $success['refresh_token'] = $refreshToken->plainTextToken;
            $success['user'] = new UserResource($request->user());

            return $this->sendResponse($success, Response::HTTP_OK);
        }catch (\Exception $e){
            return $this->sendError('Unauthorised.', ['error'=>$e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function refreshToken(Request $request)
    {
        $accessToken = $request->user()->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.ac_expiration')));
        $result['access_token'] = $accessToken->plainTextToken;
        return $this->sendResponse($result, Response::HTTP_OK);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        //$request->user()->currentAccessToken()->delete();
        Auth::guard('web')->logout();

        return $this->sendResponse(null, Response::HTTP_OK);
    }
}
