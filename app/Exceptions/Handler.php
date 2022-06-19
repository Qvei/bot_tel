<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\MyClass\Telega;

class Handler extends ExceptionHandler
{

    protected $telega;

    public function __construct(Container $container, Telega $telega){
            parent::construct($container);
            $this->telega = $telega;

    }
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

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        
        $this->reportable(function (Throwable $e) {
            $datet = date('l jS \of F Y h:i:s A') . PHP_EOL . $e->getMessage() . PHP_EOL . $e->getFile() . PHP_EOL . $e->getLine();
            $this->telega->sendMessage(env('CHAT_ID'),$datet);
            //     \Illuminate\Support\Facades\Http::post('https://api.telegram.org/bot'.env('BOT_TOKEN').'/sendMessage',[
            //     'chat_id' => env('CHAT_ID'),
            //     'text' => date('l jS \of F Y h:i:s A') . PHP_EOL . $e->getMessage() . PHP_EOL . $e->getFile() . PHP_EOL . $e->getLine(),
            //     'parse_mod' => 'html',
            // ]);
        });
    }
}
