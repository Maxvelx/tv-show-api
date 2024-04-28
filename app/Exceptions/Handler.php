<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Prepares a JSON response for exceptions, returning a 404 Not Found error if the route is not found.
     *
     * @param Request $request
     * @param Throwable $e
     *
     * @return JsonResponse
     */
    protected function prepareJsonResponse($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException) {
            return response()->json(['status' => 'error', 'result' => 'Not Found'], 404);
        }

        return parent::prepareJsonResponse($request, $e);
    }
}
