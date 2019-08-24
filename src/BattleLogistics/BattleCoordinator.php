<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 24.8.2019.
 * Time: 12:30
 */

namespace App\BattleLogistics;

use App\Manager\BattleManager;
use App\Manager\BattlePreparationManager;
use App\Models\Battle;

class BattleCoordinator
{
    /** @var BattlePreparationManager $battlePreparationManager */
    protected $battlePreparationManager;

    /** @var BattleManager $battleManager */
    protected $battleManager;

    /** @var array $battle_logs */
    protected $battle_logs;

    /**
     * BattleCoordinator constructor.
     *
     * @param BattlePreparationManager $battlePreparationManager
     * @param BattleManager $battleManager
     */
    public function __construct(
        BattlePreparationManager $battlePreparationManager,
        BattleManager $battleManager
    ) {
        $this->battlePreparationManager = $battlePreparationManager;
        $this->battleManager = $battleManager;
    }

    /**
     *  Start battle sequence
     *
     * @param Battle $battle
     * @param array $armies
     * @return array
     */
    public function battle(Battle $battle, array $armies) : array
    {
        $preparation_data = $this->battlePreparationManager->prepareArmies($armies);
        $battle_data = $this->battleManager->startBattle($battle, $armies);


        if (isset($preparation_data['logs'])) {
            $this->battle_logs = array_merge($preparation_data['logs'], $battle_data['logs']);
        } else {
            $this->battle_logs = $battle_data['logs'];
        }

        return [
            'status'    => $battle_data['status'],
            'logs'      => $this->battle_logs
        ];
    }
}