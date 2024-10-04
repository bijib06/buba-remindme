<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (ValidationException $e, $request){
            return response()->json([
                'ok' => false,
                'err' => 'ERR_INVALID_INPUT',
                'msg' => 'input validation error',
            ], 422);
        });

        $this->renderable(function (ModelNotFoundException $e, $request){
            return response()->json([
                'ok' => false,
                'err' => 'ERR_NOT_FOUND',
                'msg' => 'resource is not found',
            ], 404);
        });

        $this->renderable(function (NotFoundHttpException $e, $request){
            return response()->json([
                'ok' => false,
                'err' => 'ERR_NOT_FOUND',
                'msg' => 'resource is not found',
            ], 404);
        });

        $this->renderable(function (UnauthorizedException $e, $request){
            return response()->json([
                'ok' => false,
                "err" => "ERR_FORBIDDEN_ACCESS",
                "msg" => "user doesn't have enough authorization",
            ], 403);
        });

        $this->renderable(function (InvalidArgumentException $e, $request){
            return response()->json([
                'ok' => false,
                "err" => "ERR_INVALID_ACCESS_TOKEN",
                "msg" => "invalid access token",
            ], 401);
        });

        $this->renderable(function (\Exception $e, $request){
            $res = null;
            switch ($e->getCode()) {
                case 400:
                    $res = [
                        'ok' => false,
                        'err' => 'ERR_BAD_REQUEST',
                        'msg' => "invalid value of `type`",
                    ];
                    break;
                case 401:
                    $res = [
                        'ok' => false,
                        'err' => 'ERR_INVALID_ACCESS_TOKEN',
                        'msg' => "invalid access token",
                    ];
                    break;
                case 403:
                    $res = [
                        'ok' => false,
                        'err' => 'ERR_FORBIDDEN_ACCESS',
                        'msg' => "user doesn't have enough authorization",
                    ];
                    break;
                case 404:
                    $res = [
                        'ok' => false,
                        'err' => 'ERR_NOT_FOUND',
                        'msg' => "resource is not found",
                    ];
                    break;
                
                default:
                    $res = [
                        'ok' => false,
                        'err' => 'ERR_INTERNAL_ERROR',
                        'msg' => "unable to connect to the database",
                    ];
                    break;
            }
            return response()->json($res, $e->getCode());
        });

        $this->reportable(function (Throwable $e) {
            
        });
    }
}
