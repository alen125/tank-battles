<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 24.8.2019.
 * Time: 12:35
 */

namespace App\Manager;

use App\BattleLogistics\BattleCalculations;
use App\Models\Army;
use Symfony\Contracts\Translation\TranslatorInterface;

class BattlePreparationManager
{
    const ACTION_NAME = 'Battle preparation';

    /** @var BattleCalculations $battle_calculations */
    protected $battle_calculations;

    /** @var array $battle_logs */
    private $battle_logs;

    /**
     * BattlePreparationManager constructor.
     *
     * @param BattleCalculations $battle_calculations
     */
    public function __construct(BattleCalculations $battle_calculations)
    {
        $this->battle_calculations = $battle_calculations;
    }

    /**
     *  Prepare tanks for each army
     *
     * @param array $armies
     * @return array
     */
    public function prepareArmies(array $armies) : array
    {
        foreach ($armies as $army_name => $army_data) {
            // This is going first, because we can still scavenge supplies from tanks that wouldn't start
            $armies[$army_name] = $this->sumAllSupplies($army_data);
            $armies[$army_name] = $this->startTanks($army_data);
        }

        return [
            'armies' => $armies,
            'logs'   => $this->battle_logs
        ];
    }

    /**
     *  Calculate final amount of supplies per army
     *
     * @param Army $army
     * @return Army
     */
    protected function sumAllSupplies(Army $army) : Army
    {
        // Add existing tank supplies to army total supplies
        $total_supplies = $army->getSupplies() + ($army->getTankCount() * intval(getenv('TANK_AMMO_COUNT')));

        $army->setSupplies($total_supplies);

        return $army;
    }

    /**
     *  Run through all tanks and subtract those who won't start
     *
     * @param Army $army
     * @return Army
     */
    protected function startTanks(Army $army) : Army
    {
        // Percentage to determine that tank will fail to start
        $fail_percentage = intval(getenv('TANK_ENGINE_FAILURE_PERCENTAGE')) - ($army->getAdvancedTanks() / 10);

        // Calculate percentage to given amount of tanks
        $failed_tanks = $this->battle_calculations->calculateProbability($army->getTankCount(), $fail_percentage);
        $army->setTankCount($army->getTankCount() - $failed_tanks);

        if ($failed_tanks > 0) {
            $this->battle_logs[] = [
                'action'    => self::ACTION_NAME,
                'message'   => $army->getName() . " lost " . $failed_tanks . " tanks because they wouldn't start"
            ];
        }

        return $army;
    }
}