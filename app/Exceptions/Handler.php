<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                $title = '';
                $detail = '';

                if ($e instanceof HttpException) {
                    $cast = fn ($orig): HttpException => $orig;  // HttpException へ型変換
                    $httpEx = $cast($e);
                    switch ($httpEx->getStatusCode()) {
                        case 401:
                            $title = __('Unauthorized');
                            $detail =  __('Unauthorized');
                            break;
                        case 403:
                            $title = __('Forbidden');
                            $detail = __($httpEx->getMessage() ?: 'Forbidden');
                            break;
                        case 404:
                            $title = __('Not Found');
                            $detail = __('Not Found');
                            break;
                        case 419:
                            $title = __('Page Expired');
                            $detail = __('Page Expired');
                            break;
                        case 429:
                            $title = __('Too Many Requests');
                            $detail = __('Too Many Requests');
                            break;
                        case 500:
                            $title = __('Server Error');
                            $detail = config('app.debug') ? $httpEx->getMessage() : __('Server Error');
                            break;
                        case 503:
                            $title = __('Service Unavailable');
                            $detail = __('Service Unavailable');
                            break;
                        default:
                            return;
                    }

                    return response()->json([
                        'title' => $title,
                        'status' => $httpEx->getStatusCode(),
                        'detail' => $detail,
                    ], $httpEx->getStatusCode(), [
                        'Content-Type' => 'application/problem+json',
                    ]);
                }

                if($e instanceof ValidationException){
                    return response()->json([
                        'title' => 'Unprocessable Content',
                        'status' => 422,
                        'detail' => 'parameter invalid'
                    ], 422, [
                        'Content-Type' => 'application/problem+json',
                    ]);
                }

                if($e instanceof AuthenticationException){
                    return response()->json([
                        'title' => 'Unauthorized',
                        'status' => 401,
                        'detail' => 'token unauthorized'
                    ], 401, [
                        'Content-Type' => 'application/problem+json',
                    ]);
                }

                // HttpException 以外の場合
                $title = __('Server Error');
                $detail = config('app.debug') ? [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace_str' => $e->getTraceAsString(),
                    'trace' => $e->getTrace()
                ] : __('Server Error');

                return response()->json([
                    'title' => $title,
                    'status' => 500,
                    'detail' => $detail,
                ], 500, [
                    'Content-Type' => 'application/problem+json',
                ]);
            }
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
