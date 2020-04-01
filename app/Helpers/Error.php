<?php

namespace App\Helpers;

class Error implements \JsonSerializable
{
    public $errorCode;
    public $description;

    public function __construct($errorCode, $description = '')
    {
        $this->errorCode = $errorCode;
        $this->description = ($description != '') ? $description : config('errors.' . $errorCode);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'errorCode'   => $this->errorCode,
            'description' => $this->description,
            'request'     => [
                'url'    => \Request::fullUrl(),
                'params' => \Request::all(),
                'ip'  => \Request::ip('ip', '')
            ]
        ];
    }
}