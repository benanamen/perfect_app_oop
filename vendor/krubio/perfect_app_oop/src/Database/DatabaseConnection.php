<?php declare(strict_types=1);

namespace PerfectApp\Database;

/**
 * Interface DatabaseConnection
 * @package PerfectApp
 */
interface DatabaseConnection
{
    /**
     * @return mixed
     */
    public function connect();
}
