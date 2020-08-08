<?php declare(strict_types=1);

namespace PerfectApp\FormBuilder;

class SubmitButton
{
    private $html;

    public function __construct($attributes = [])
    {
        if (count($attributes) < 1)
        {
            throw new \InvalidArgumentException('Invalid number of attributes');
        }

        $this->html = "<div class='form-group row'>\n";
        $this->html .= "<div class='col-sm-10 offset-sm-2'>\n";
        $this->html .= '<input type="submit" ';
        foreach ($attributes as $attribute => $value)
        {
            $this->html .= $attribute . "='$value' ";
        }
        $this->html .= ">\n";
        $this->html .= "</div>\n</div>";
    }

    public function getHTML()
    {
        return $this->html;
    }
}
