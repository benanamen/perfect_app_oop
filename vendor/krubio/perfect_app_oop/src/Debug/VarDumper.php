<?php

namespace PerfectApp\Debug;

/**
 * A debug tool to print the content of variables (e. g. $_POST)
 */
/**
 * Interface VarDumper
 * @package PerfectApp\Debug
 */
interface VarDumper
{
    /**
     * Prints a value
     *
     * @param string $title the title to be printed
     * @param mixed  $data  the value
     */
    function dump($title, $data);
}
