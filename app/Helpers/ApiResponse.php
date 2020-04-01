<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class ApiResponse
{
    public $valid;
    public $data;
    public $errors;

    public function __construct($data, $errors = [])
    {
        $this->valid = true;
        $this->data = $data;
        if (count($errors) > 0) {
            $this->valid = false;
            $this->errors = $errors;
        }
    }

    /**
     * @param $data
     * @return static
     */
    public static function success($data)
    {
        return response()->json(new static($data));
    }

    /**
     * @param Error $error
     * @return static
     */
    public static function error(Error $error)
    {
        Log::error('Returned Error for', $error->jsonSerialize());
        return response()->json(new static('', [$error]));
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return json_encode($this);
    }
}