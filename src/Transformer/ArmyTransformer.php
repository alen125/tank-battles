<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 22.8.2019.
 * Time: 22:08
 */

namespace App\Transformer;

use App\DTO\BattleParameterDTO;
use App\Models\Army;

class ArmyTransformer
{
    public function fromDTO(BattleParameterDTO $battleParameterDTO)
    {
        $army1 = new Army();
        $army1->setTankCount($battleParameterDTO->getArmy1());
        $army1->setName($battleParameterDTO->getName1() ?? 'Army 1');
        $army1->setSupplies($battleParameterDTO->getSupplies1() ?? rand(1, 100));
        $army1->setAdvancedTanks($battleParameterDTO->getAdvancedTanks1() ?? rand(1, 100));

        $army2 = new Army();
        $army2->setTankCount($battleParameterDTO->getArmy2());
        $army2->setName($battleParameterDTO->getName2() ?? 'Army 2');
        $army2->setSupplies($battleParameterDTO->getSupplies2() ?? rand(1, 100));
        $army2->setAdvancedTanks($battleParameterDTO->getAdvancedTanks2() ?? rand(1, 100));

        return [
            'army1' => $army1,
            'army2' => $army2
        ];
    }
}