<?php

namespace PerfectApp\FormBuilder;


class Label
{
    private $html;

    public function __construct($attributes = [])
    {
        if (count($attributes) != 2)
        {
            throw new \InvalidArgumentException('Invalid number of attributes');
        }
        $this->html = "<label for='$attributes[0]'>$attributes[1]</label>";
    }

    public function getHTML()
    {
        return $this->html;
    }
}
