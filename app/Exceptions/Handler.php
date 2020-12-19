<?php

namespace App\Exceptions;

use App\Traits\Errors;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    use Errors;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, \Throwable $exception){
        if ($request->is('api/*')) {
            if ($exception instanceof ModelNotFoundException) {
                abort(404);
                //return $this->sendError($exception->getMessage(),404);
            }
            if ($exception instanceof ValidationException) {
                $exceptions = $exception->validator->errors()->first();
                return $this->sendError($exceptions,400);
            }
            if ($exception instanceof MethodNotAllowedHttpException) {
                return $this->sendError('Method Not Allowed for the action',405);
            }
            if ($exception instanceof NotFoundHttpException) {
                return $this->sendError('url not found',404);
            }
            if ($exception instanceof RouteNotFoundException) {
                return $this->sendError('Invalid or expired JWT token',401);
            }

            return $this->generalError();
        }
        return parent::render($request, $exception);
    }

}
