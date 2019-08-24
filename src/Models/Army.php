<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 22.8.2019.
 * Time: 22:20
 */

namespace App\Models;

use App\Utils\ArrayParse;

class Army
{
    use ArrayParse;

    /** @var string $name */
    protected $name;
    /** @var int $tank_count */
    protected $tank_count;
    /** @var int $supplies */
    protected $supplies;
    /** @var int $advanced_tanks */
    protected $advanced_tanks;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getTankCount(): int
    {
        return $this->tank_count;
    }

    /**
     * @param int $tank_count
     */
    public function setTankCount(int $tank_count): void
    {
        $this->tank_count = $tank_count;
    }

    /**
     * @return int
     */
    public function getSupplies(): int
    {
        return $this->supplies;
    }

    /**
     * @return int
     */
    public function getAdvancedTanks(): int
    {
        return $this->advanced_tanks;
    }

    /**
     * @param int $advanced_tanks
     */
    public function setAdvancedTanks(int $advanced_tanks): void
    {
        $this->advanced_tanks = $advanced_tanks;
    }

    /**
     * @param int $supplies
     */
    public function setSupplies(int $supplies): void
    {
        $this->supplies = $supplies;
    }
}