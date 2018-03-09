<?php

namespace PerfectApp\Debug;


/**
 * Class ShowDebugData
 * @package PerfectApp\Debug
 */
class ShowDebugData
{
    /**
     *
     */
    public static function displayDebugData()
    {
        echo '<div class="error_custom"><H1>DEBUGGING IS ON !!!</H1></div>';

        $var = null;

        if (SHOW_COOKIE_DATA)
        {
            $var['COOKIE'] = $_COOKIE;
        }

        if (SHOW_SESSION_DATA && isset($_SESSION))
        {
            $var['SESSION'] = $_SESSION;
        }

        if (SHOW_POST_DATA)
        {
            $var['POST'] = $_POST;
        }

        if (SHOW_GET_DATA)
        {
            $var['GET'] = $_GET;
        }

        if (SHOW_REQUEST_DATA)
        {
            $var['REQUEST'] = $_REQUEST;
        }

        if ($var)
        {
            $varDumper = new HTMLVarDumper();

            foreach ($var as $title => $data)
            {
                $varDumper->dump($title, $data);
            }
        }
    }
}
