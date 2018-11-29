<?php declare (strict_types=1);

namespace PerfectApp\FormBuilder;

class FormGenerator
{
    // data member declaration
    private $elements = []; // array of form elements
    private $output = ''; // dynamic output
    private $elementHeader = ''; // element header
    private $elementFooter = "\n"; // element footer

    private $method = 'post'; // form method
    private $action; // form action

    // constructor
    public function __construct($elements = [])
    {
        if (count($elements) < 1)
        {
            throw new \InvalidArgumentException('Invalid number of elements');
        }
        // data member initialization
        $this->elements = $elements;

        $this->action = $_SERVER['SCRIPT_NAME'];
    }

    // create form code
    public function createForm()
    {
        $this->output .= "<form action='$this->action' method='$this->method'>\n";

        foreach ($this->elements as $element => $attributes)
        {
            // call the abstract class formElementFactory
            $this->output .= $this->elementHeader . formElementFactory::createElement($element, $attributes) . $this->elementFooter;
        }
        $this->output .= '</form>';
    }

    // add form part
    public function addFormPart($html = '<br>')
    {
        $this->output .= $html;
    }

    // add element header
    public function addElementHeader($header)
    {
        $this->elementHeader = $header;
    }

    // add element footer
    public function addElementFooter($footer)
    {
        $this->elementFooter = $footer;
    }

    // set form action
    public function setAction($action)
    {
        $this->action = $action;
    }

    // set form method
    public function setMethod($method)
    {
        if ($method != 'post' && $method != 'get')
        {
            throw new \InvalidArgumentException('Invalid form method');
        }
        $this->method = $method;
    }

    // get dynamic form output
    public function getFormCode()
    {
        return $this->output;
    }
}
