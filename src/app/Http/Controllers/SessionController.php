<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
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

            $success['access_token'] =  $request->user()->createToken('MySession')->plainTextToken;
            $success['refresh_token'] = null;
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
    public function refreshToken(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
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
