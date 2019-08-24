<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 24.8.2019.
 * Time: 15:25
 */

namespace App\Transformer;

use App\DTO\BattleParameterDTO;
use App\Models\Battle;

class BattleTransformer
{
    /**
     *  Transform BattleParameterDTO to Battle data
     *
     * @param BattleParameterDTO $battleParameterDTO
     * @return Battle
     */
    public function fromDTO(BattleParameterDTO $battleParameterDTO) : Battle
    {
        $battle = new Battle();
        $battle->setFieldSize(
            $battleParameterDTO->getFieldSize() ?? rand(1, intval(getenv('MAX_FIELD_SIZE')))
        );

        return $battle;
    }
}