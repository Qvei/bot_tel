<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    // public function report(Throwable $e){
    //     \Illuminate\Support\Facades\Http::post('https://api.telegram.org/bot'.env('BOT_TOKEN').'/sendMessage',[
    //         'chat_id' => 1221534640,
    //         'text' => 'New test',
    //         'parse_mod' => 'html'
    //     ]);
    // }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        
        $this->reportable(function (Throwable $e) {
                $errors = [
                    'time' => date('l jS \of F Y h:i:s A'),
                    'description' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ];
                \Illuminate\Support\Facades\Http::post('https://api.telegram.org/bot'.env('BOT_TOKEN').'/sendMessage',[
                'chat_id' => env('CHAT_ID'),
                'text' => view('errors', $errors),
                'parse_mod' => 'html'
            ]);
        });
    }
}
