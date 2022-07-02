<?php

namespace App;

use Illuminate\Support\Str;

class BaseDTO
{
    public function __construct(...$args)
    {
        foreach ($args as $key => $value) {
            if(property_exists(static::class, $key)) {
                $this->{$key} = $value;
            } elseif(property_exists(static::class, Str::camel($key))) {
                $this->{Str::camel($key)} = $value;
            }
        }
    }

    function toArray():array {
        $arProps = get_object_vars($this);
        $arResult = [];

        foreach ($arProps as $propName) {
            $arResult[$propName] = $this->${$propName};
        }

        return $arResult;
    }
}
