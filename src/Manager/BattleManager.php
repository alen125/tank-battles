<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 24.8.2019.
 * Time: 15:09
 */

namespace App\Manager;

use App\BattleLogistics\BattleCalculations;
use App\Helpers\BattleHelper;
use App\Models\Army;
use App\Models\Battle;

class BattleManager
{
    const ACTION_NAME = 'Battle';

    /** @var array $battle_logs */
    protected $battle_logs;

    /** @var BattleCalculations $battleCalculations */
    protected $battleCalculations;

    /**
     * BattleManager constructor.
     *
     * @param BattleCalculations $battleCalculations
     */
    public function __construct(BattleCalculations $battleCalculations)
    {
        $this->battleCalculations = $battleCalculations;
    }

    /**
     *  Start battle sequence
     *
     * @param Battle $battle
     * @param array $armies
     * @return array
     */
    public function startBattle(Battle $battle, array $armies) : array
    {
        $army_order     = BattleHelper::randomizeArray($armies);
        /** @var Army $first_army */
        $first_army     = $army_order[0];
        /** @var Army $second_army */
        $second_army    = $army_order[1];

        $this->writeToLog($first_army->getName() . ' is the first one to attack!');
        $end_condition = $this->determineEndCondition($first_army, $armies);

        while (!$end_condition['end']) {
            $this->doAttack($battle, $first_army, $second_army);
            $end_condition = $this->determineEndCondition($first_army, [$first_army, $second_army]);

            if ($end_condition['end']) {
                break;
            }

            $this->doAttack($battle, $second_army, $first_army);
        }

        return [
            'status'    => $end_condition,
            'logs'      => $this->battle_logs
        ];
    }

    /**
     *  Do the attack wave
     *
     * @param Battle $battle
     * @param Army $first_army
     * @param Army $second_army
     */
    protected function doAttack(Battle $battle, Army &$first_army, Army &$second_army)
    {
        $hit_percentage = intval(getenv('TANK_HIT_PERCENTAGE')) + ($first_army->getAdvancedTanks() / 2);
        $hit_count = $this->battleCalculations->calculateProbability($battle->getFieldSize(), $hit_percentage);
        $log_message = $first_army->getName() . ' attacks ' . $second_army->getName() . ' with hit percentage of: ' .
                       $hit_percentage . '% causing to destroy ' . $hit_count . ' tanks of ' . $second_army->getName();
        $this->writeToLog($log_message);

        $this->updateAttacker($battle, $first_army);
        $this->updateDefender($second_army, $hit_count);
    }

    /**
     *  Update army data for attacker
     *
     * @param Battle $battle
     * @param Army $army
     */
    protected function updateAttacker(Battle $battle, Army &$army)
    {
        $army->setSupplies($army->getSupplies() - $battle->getFieldSize());
    }

    /**
     *  Update army data for defender
     *
     * @param Army $army
     * @param $hit_count
     * @return Army
     */
    protected function updateDefender(Army &$army, $hit_count) : Army
    {
        $army->setTankCount($army->getTankCount() - $hit_count);
        $army->setSupplies($army->getSupplies() - ($hit_count * intval(getenv('TANK_AMMO_COUNT'))));

        return $army;
    }

    /**
     *  Determine end conditions based on given values
     *
     * @param Army $attacker
     * @param $armies
     * @return array
     */
    protected function determineEndCondition(Army $attacker, $armies) : array
    {
        foreach ($armies as $army_name => $army_data) {
            /** @var Army $army_data */

            if ($army_data->getTankCount() <= 0) {
                return [
                    'attacker'  => $attacker,
                    'defender'  => $army_data,
                    'condition' => 'tank-count',
                    'end'       => true
                ];
            }

            if ($army_data->getSupplies() <= 0) {
                return [
                    'attacker'  => $attacker,
                    'defender'  => $army_data,
                    'condition' => 'supplies',
                    'end'       => true,
                ];
            }
        }

        return ['end' => false];
    }

    /**
     *  Write to log what is happening in battle
     *
     * @param $message
     */
    protected function writeToLog($message)
    {
        $this->battle_logs[] = [
            'action' => self::ACTION_NAME,
            'message' => $message
        ];
    }
}