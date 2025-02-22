<?php

namespace MiladHspr\Encryptable\Helpers;

use Illuminate\Support\Facades\Config;

class EncryptHelper
{
    public static function encrypt($value)
    {
        if (!config('encryptable.enabled') || empty($value)) {
            return $value;
        }

        $key = config('encryptable.key');
        return openssl_encrypt($value, config('encryptable.cipher'), $key, 0, substr($key, 0, 16));
    }

    public static function decrypt($value)
    {
        if (!config('encryptable.enabled') || empty($value)) {
            return $value;
        }

        $key = config('encryptable.key');
        return openssl_decrypt($value, config('encryptable.cipher'), $key, 0, substr($key, 0, 16));
    }
}
