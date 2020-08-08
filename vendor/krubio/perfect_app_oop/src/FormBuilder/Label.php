<?php

namespace PerfectApp\FormBuilder;


/*class Label
{
    private $html;

    public function __construct($attributes = [])
    {
        if (count($attributes) != 2)
        {
            throw new \InvalidArgumentException('Invalid number of attributes');
        }
        $this->html = "<label for='$attributes[0]' class='col-sm-2 col-form-label'>$attributes[1]</label>";

        echo '<pre>';
        print_r($attributes);
        echo '</pre>';


    }

    public function getHTML()
    {
        return $this->html;
    }
}*/
class Label
{
    private $html;

    public function __construct($attributes = [])
    {
        if (count($attributes) < 1)
        {
            throw new \InvalidArgumentException('Invalid number of attributes');
        }

        echo '<pre>', print_r($attributes, true), '</pre>';

        //$this->html .= '<input  class="form-control" type="password" ';
        foreach ($attributes as $attribute => $value)
        {
            $this->html = "<label for='{$attributes['for']}' class='col-sm-2 col-form-label'>{$attributes['value']}</label>";


            //$this->html .= $attribute . "='$value' ";
            //$this->html = "<label for='$attributes[0]' class='col-sm-2 col-form-label'>$attributes[1]</label>";

            //echo '<pre>', print_r($attributes['for'], true), '</pre>';

        }
        //$this->html .= '>';
    }

    public function getHTML()
    {
        return $this->html;
    }
}