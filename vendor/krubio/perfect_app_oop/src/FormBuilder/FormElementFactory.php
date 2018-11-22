<?php

namespace PerfectApp\FormBuilder;

abstract class FormElementFactory
{
    private function __construct()
    {
    }

    public static function createElement($type, $attributes = [])
    {
        $type = __NAMESPACE__ . "\\$type";

        if (!class_exists($type) || !is_array($attributes))
        {
            throw new \InvalidArgumentException('Invalid method parameters');
        }

        // instantiate a new form element object
        $formElement = new $type($attributes);//KR Does NOT work.

        // return HTML of form element code
        return $formElement->getHTML();
    }
}
