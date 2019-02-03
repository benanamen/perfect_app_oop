<?php declare (strict_types=1);

namespace PerfectApp\Utilitys;

/**
 * Interface MessageDisplay
 * @package PerfectApp\Utilitys
 */
interface MessageDisplay
{
    /**
     * @param $action
     * @return string
     */
    public function render($action): string;
}
