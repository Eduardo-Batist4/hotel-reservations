<?php

namespace App\Exceptions;

use Exception;

class AccessDeniedException extends Exception
{

    public function render($request)
    {
        return response()->json([
            'error' => "Access denied! You don't have permission to access this."
        ], 403);
    }
}
