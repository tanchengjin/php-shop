<?php

namespace App\Exceptions;

use App\Librarys\API;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class NotFoundException extends Exception
{
    use API;

    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->error()->setStatusCode(404);
        }

        return view('errors.404', [
            'message' => $this->message
        ]);
    }
}
