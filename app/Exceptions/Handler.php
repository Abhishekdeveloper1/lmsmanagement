<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
            $this->logErrorToFile($e);
        });
    }
    protected function logErrorToFile________(Throwable $e): void
    {
        $logFile = storage_path('logs/error_log_' . date('Y-m-d') . '.txt');
        $errorDetails = "[" . date('Y-m-d H:i:s') . "] " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine() . PHP_EOL;

        file_put_contents($logFile, $errorDetails, FILE_APPEND);
    }

    protected function logErrorToFile(Throwable $e): void
    {
        // Define log file path (one file per day)
        $logFile = storage_path('logs/errors_' . date('Y-m-d') . '.txt');

        // Prepare error details
        $errorDetails = "[" . date('Y-m-d H:i:s') . "] ";
        $errorDetails .= "Error: " . $e->getMessage() . PHP_EOL;
        $errorDetails .= "File: " . $e->getFile() . " | Line: " . $e->getLine() . PHP_EOL;
        $errorDetails .= "Stack Trace:" . PHP_EOL . $e->getTraceAsString() . PHP_EOL;
        $errorDetails .= str_repeat("-", 80) . PHP_EOL; // Separator for readability
// print_r($errorDetails);die;
        // Append error details to the file
        file_put_contents($logFile, $errorDetails, FILE_APPEND);
    }
}
