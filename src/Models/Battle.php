<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 24.8.2019.
 * Time: 15:21
 */

namespace App\Models;

use App\Utils\ArrayParse;

class Battle
{
    use ArrayParse;

    /** @var int $field_size */
    protected $field_size;

    /**
     * @return int
     */
    public function getFieldSize(): ?int
    {
        return $this->field_size;
    }

    /**
     * @param int $field_size
     */
    public function setFieldSize(?int $field_size): void
    {
        $this->field_size = $field_size;
    }
}