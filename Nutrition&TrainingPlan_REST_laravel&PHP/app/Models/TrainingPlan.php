<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPlan extends Model
{
    use HasFactory;

    /**
     * Generate a running schedule based on specified parameters.
     *
     * @param float $dailyDistance The daily running distance.
     * @param float $restRatio The ratio of rest days in the schedule.
     * @param int $fartlekIntervals The number of fartlek intervals on running days.
     *
     * @return array The generated running schedule.
     */
    public function genRunningSchedule($dailyDistance, $restRatio, $fartlekIntervals)
    {
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $schedule = [];

        foreach ($daysOfWeek as $day) {
            $isRestDay = mt_rand(0, 100) / 100 < $restRatio;

            if ($isRestDay) {
                $schedule[$day] = [
                    'activity' => 'rest',
                    'distance' => 0,
                ];
            } else {
                $fartlekDistances = $this->fartlekDistances($dailyDistance, $fartlekIntervals);

                $schedule[$day] = [
                    'activity' => 'fartlek',
                    'distances' => $fartlekDistances,
                ];
            }
        }

        return $schedule;
    }

    /**
     * Generate fartlek distances for a running day.
     *
     * @param float $dailyDistance The daily running distance.
     * @param int $intervals The number of fartlek intervals.
     *
     * @return array The generated fartlek distances.
     */
    private function fartlekDistances($dailyDistance, $intervals)
    {
        $fartlekDistances = [];

        for ($i = 0; $i < $intervals; $i++) {
            $distance = max($dailyDistance + mt_rand(-100, 100) / 100, 0);
            $fartlekDistances[] = $distance;
        }

        return $fartlekDistances;
    }

    /**
     * Generate a running schedule based on the fitness level.
     *
     * @param int $level The fitness level (1 to 4).
     *
     * @return array The generated running schedule.
     */
    public function genRunningScheduleOnFitnessLevel($level)
    {
        switch ($level) {
            case 1:
                $dailyDistance = 1;
                $restRatio = 0.7;
                $fartlekIntervals = 1;
                break;
            case 2:
                $dailyDistance = 2;
                $restRatio = 0.5;
                $fartlekIntervals = 3; 
                break;
            case 3:
                $dailyDistance = 2;
                $restRatio = 0.4;
                $fartlekIntervals = 4;
                break;
            case 4:
                $dailyDistance = 3;
                $restRatio = 0.2;
                $fartlekIntervals = 5;
                break;
            default:
                $dailyDistance = 3;
                $restRatio = 0.5;
                $fartlekIntervals = 2;
                break;
        }

        $schedule = $this->genRunningSchedule($dailyDistance, $restRatio, $fartlekIntervals);
        return $schedule;
    }
}
