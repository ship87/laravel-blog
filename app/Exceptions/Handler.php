<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [//
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $response = $this->isJsonApiRequest($request, $exception);

        if ($response) {
            return $response;
        }

        return parent::render($request, $exception);
    }

    private function isJsonApiRequest(&$request, Exception $exception)
    {

        if ($request->is('api/v1/*')) {

            $response = [
                'errors' => 'Sorry, something went wrong.',
            ];

            if (config('app.debug')) {
                $response['exception'] = get_class($exception);
                $response['message'] = $exception->getMessage();
                $response['trace'] = $exception->getTrace();
            }

            $status = 400;

            if ($this->isHttpException($exception)) {

                $statusException = $exception->getCode();

                if ((int) $statusException > 0) {
                    $status = $statusException;
                }
            }

            return response()->json($response, $status);
        }

        return false;
    }
}
