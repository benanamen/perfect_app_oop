<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 4/2/2018
 * Time: 8:18 PM
 */

namespace PerfectApp;

/**
 * Interface UserRegistration
 * @package PerfectApp
 */
interface UserRegistration
{

    /**
     * @param $firstName
     * @param $lastName
     * @param $to
     * @param $username
     * @param $password
     * @return mixed
     */
    public function register($firstName, $lastName, $to, $username, $password);
}
