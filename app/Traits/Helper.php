<?php

namespace App\Traits;

use Exception;

trait Helper
{
    public static function safeResponse(callable $callback)
    {
        try {
            $data = $callback();

            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something goes wrong!',
                'success' => false,
            ], 404);
        }
    }
}
