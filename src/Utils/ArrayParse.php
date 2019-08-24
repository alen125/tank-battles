<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 24.8.2019.
 * Time: 22:10
 */

namespace App\Utils;

trait ArrayParse
{
    /**
     *  Parse object vars to array
     *
     * @return array
     */
    public function toArray() : array
    {
        return get_object_vars($this);
    }
}