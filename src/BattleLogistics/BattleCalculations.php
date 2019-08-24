<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 24.8.2019.
 * Time: 12:51
 */

namespace App\BattleLogistics;

class BattleCalculations
{
    public function calculateProbability($use_cases, $percentage)
    {
        $affected_values = 0;

        for ($i = 1; $i <= $use_cases; $i++) {

            if (rand(1, 100) <= $percentage) {
                $affected_values++;
            }
        }

        return $affected_values;
    }
}