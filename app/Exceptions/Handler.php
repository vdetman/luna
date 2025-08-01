<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use RaifuCore\Support\Helpers\ResponseHelper;
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

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson() && $e instanceof ValidationException) {

            $firstError = null;
            $errors = [];
            foreach ($e->errors() ?: [] as $field => $error) {
                $firstError = $firstError ?? $error[0];
                $errors[$field] = $error;
            }

            return response()->json([
                'status' => false,
                'error' => $firstError ?? 'One or more fields contain errors',
                'errors' => $errors
            ], 422);
        }

        return parent::render($request, $e);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
