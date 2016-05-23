<?php

namespace Klsandbox\SiteConfig\Services;

use Illuminate\Support\Traits\Macroable;

class SiteConfig
{
    use Macroable;
    protected $data = [];

    public function __get($key)
    {
        if (self::hasMacro($key)) {
            return $this->__call($key, []);
        }

        return false;
    }
}
