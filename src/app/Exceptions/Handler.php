<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
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
                'msg' => $e->getMessage(),
                'err' => $e->errors(),
            ], 422);
        });

        $this->renderable(function (ModelNotFoundException $e, $request){
            return response()->json([
                'ok' => false,
                'err' => $e->getMessage(),
            ], 404);
        });

        $this->renderable(function (NotFoundHttpException $e, $request){
            return response()->json([
                'ok' => false,
                'err' => $e->getMessage(),
            ], 404);
        });

        $this->renderable(function (\Exception $e, $request){
            return response()->json([
                'ok' => false,
                'err' => $e->getMessage(),
                'msg' => $e->getTraceAsString(),
            ], 500);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
