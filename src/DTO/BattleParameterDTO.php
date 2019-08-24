<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 22.8.2019.
 * Time: 21:32
 */

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class BattleParameterDTO
{
    /**
     * @var int $army1
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value="0")
     * @Assert\Type(type="int")
     */
    private $army1;

    /**
     * @var int$army2
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value="0")
     * @Assert\Type(type="int")
     */
    private $army2;

    /** @var string $name1 */
    private $name1;

    /** @var string $name2 */
    private $name2;

    /**
     * @var int $supplies1
     * @Assert\Type(type="int")
     */
    private $supplies1;

    /**
     * @var int $supplies2
     * @Assert\Type(type="int")
     */
    private $supplies2;

    /**
     * @var int $advanced_tanks1
     * @Assert\Type(type="int")
     */
    private $advanced_tanks1;

    /**
     * @var int $advanced_tanks2
     * @Assert\Type(type="int")
     */
    private $advanced_tanks2;

    /**
     * @var int $field_size
     * @Assert\Type(type="int")
     */
    private $field_size;

    /**
     * @return int
     */
    public function getArmy1(): ?int
    {
        return $this->army1;
    }

    /**
     * @param int $army1
     */
    public function setArmy1(?int $army1): void
    {
        $this->army1 = $army1;
    }

    /**
     * @return int
     */
    public function getArmy2(): ?int
    {
        return $this->army2;
    }

    /**
     * @param int $army2
     */
    public function setArmy2(?int $army2): void
    {
        $this->army2 = $army2;
    }

    /**
     * @return string
     */
    public function getName1(): ?string
    {
        return $this->name1;
    }

    /**
     * @param string $name1
     */
    public function setName1(?string $name1): void
    {
        $this->name1 = $name1;
    }

    /**
     * @return string
     */
    public function getName2(): ?string
    {
        return $this->name2;
    }

    /**
     * @param string $name2
     */
    public function setName2(?string $name2): void
    {
        $this->name2 = $name2;
    }

    /**
     * @return int
     */
    public function getSupplies1(): ?int
    {
        return $this->supplies1;
    }

    /**
     * @param int $supplies1
     */
    public function setSupplies1(?int $supplies1): void
    {
        $this->supplies1 = $supplies1;
    }

    /**
     * @return int
     */
    public function getSupplies2(): ?int
    {
        return $this->supplies2;
    }

    /**
     * @param int $supplies2
     */
    public function setSupplies2(?int $supplies2): void
    {
        $this->supplies2 = $supplies2;
    }

    /**
     * @return int
     */
    public function getAdvancedTanks1(): ?int
    {
        return $this->advanced_tanks1;
    }

    /**
     * @param int $advanced_tanks1
     */
    public function setAdvancedTanks1(?int $advanced_tanks1): void
    {
        $this->advanced_tanks1 = $advanced_tanks1;
    }

    /**
     * @return int
     */
    public function getAdvancedTanks2(): ?int
    {
        return $this->advanced_tanks2;
    }

    /**
     * @param int $advanced_tanks2
     */
    public function setAdvancedTanks2(?int $advanced_tanks2): void
    {
        $this->advanced_tanks2 = $advanced_tanks2;
    }

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