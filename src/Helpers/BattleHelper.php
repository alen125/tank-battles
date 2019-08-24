<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 24.8.2019.
 * Time: 15:10
 */

namespace App\Helpers;

class BattleHelper
{
    /**
     *  Randomize array
     *
     * @param array $array
     * @return array
     */
    public static function randomizeArray(array $array)
    {
        $parsed_array = array_values($array);
        shuffle($parsed_array);

        return $parsed_array;
    }
}