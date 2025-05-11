<?php

namespace App\Exceptions;

use Exception;

class RoomUnavailableException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => 'Room Unavailable!'
        ], 403);
    }
}
