<?php declare (strict_types=1);

namespace PerfectApp\FormBuilder;

class TextInput
{
    private $html;

    public function __construct($attributes = [])
    {
        if (count($attributes) < 1)
        {
            throw new \InvalidArgumentException('Invalid number of attributes');
        }
        $this->html = '<input type="text" ';
        foreach ($attributes as $attribute => $value)
        {
            $this->html .= $attribute . "='$value' ";
        }
        $this->html .= '>';
    }

    public function getHTML()
    {
        return $this->html;
    }
}
