<?php

namespace App\Libraries;
/**
 * Created by PhpStorm.
 * User: Bielecki
 * Date: 5/21/2017
 * Time: 11:40 AM
 */
class DiveCalculator
{
    /**
     * message if dive was longer than allowed at a given maximum depth
     */
    const OVER_NDL = 'You have exceeded the NDL at the specified depth.';

    /**
     * error message if trying to dive below 140
     */
    const OVER_DEPTH = 'Your dive was deeper than recreational limits';

    /**
     * message when SI is long enough to clear all nitrogen
     */
    const NO_RESIDUAL_NITROGEN = 'You have no residual nitrogen';

    /**
     * depth is greater than 130 for repetitive dive
     */
    const OFF_REPETITIVE_CHART= 'Your dive plan is not compatible with the repetitive dive chart';

    /**
     * @var array depths used for calculations for table 1, to get initial pressure group
     */
    private $table_depths = [35,40,50,60,70,80,90,100,110,120,130,140];

    /**
     * @var array the Pressure Groups, used in calculations with table 2
     */
    private $table_groups = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

    /**
     * @var array PADI Dive Table 1, calculates pressure group after a dive to a certain depth for a certain time
     * keys are pressure groups, values are bottom times
     */
    private $table_one = [
        'A' => [10, 9, 7, 6, 5, 4, 4, 3, 3, 3, 3, 'x'],
        'B' => [19, 16, 13, 11, 9, 8, 7, 6, 6, 5, 5, 4],
        'C' => [25, 22, 17, 14, 12, 10, 9, 8, 7, 6, 6, 5],
        'D' => [29, 25, 19, 16, 13, 11, 10, 9, 8, 7, 7, 6],
        'E' => [32, 27, 21, 17, 15, 13, 11, 10, 9, 8, 'x', 7],
        'F' => [36, 31, 24, 19, 16, 14, 12, 11, 10, 9, 8, 8],
        'G' => [40, 34, 26, 21, 18, 15, 13, 12, 11, 10, 9],
        'H' => [44, 37, 28, 23, 19, 17, 15, 13, 12, 11, 10],
        'I' => [48, 40, 31, 25, 21, 18, 16, 14, 13, 'x'],
        'K' => [57, 48, 36, 29, 24, 21, 18, 16, 14, 13],
        'L' => [62, 51, 39, 31, 26, 22, 19, 17, 15],
        'M' => [67, 55, 41, 33, 27, 23, 21, 18, 16],
        'N' => [73, 60, 44, 35, 29, 25, 22, 19],
        'O' => [79, 64, 47, 37, 31, 26, 23, 20],
        'P' => [85, 69, 50, 39, 33, 28, 24],
        'Q' => [92, 74, 53, 42, 35, 29, 25],
        'R' => [100, 79, 57, 44, 36, 30],
        'S' => [108, 85, 60, 47, 38],
        'T' => [117, 91, 63, 49, 40],
        'U' => [127, 97, 67, 52],
        'V' => [139, 104, 71, 54],
        'W' => [152, 111, 75, 55],
        'X' => [168, 120, 80],
        'Y' => [188, 129],
        'Z' => [205, 140]
    ];

    /**
     * @var array PADI Dive Table 2, calculates new pressure group after a suface interval
     * key is the starting PG, values are surface interval times
     */
    private $table_two = [
        'A' => [180],
        'B' => [228, 47],
        'C' => [250, 69, 21],
        'D' => [259, 78, 30, 8],
        'E' => [268, 87, 38, 16, 7],
        'F' => [275, 94, 46, 24, 15, 7],
        'G' => [282, 101, 53, 32, 22, 13, 6],
        'H' => [288, 107, 59, 37, 28, 20, 12, 5],
        'I' => [294, 113, 65, 43, 34, 26, 18, 11, 5],
        'J' => [300, 119, 71, 49, 40, 31, 24, 17, 11, 5],
        'K' => [305, 124, 76, 54, 45, 37, 29, 22, 16, 10, 4],
        'L' => [310, 129, 81, 59, 50, 42, 34, 27, 21, 15, 9, 4],
        'M' => [315, 134, 85, 64, 55, 46, 39, 32, 25, 19, 14, 9, 4],
        'N' => [319, 138, 90, 68, 59, 51, 43, 36, 30, 24, 18, 13, 8, 3],
        'O' => [324, 143, 94, 72, 63, 55, 47, 41, 34, 28, 23, 17, 12, 8, 3],
        'P' => [328, 147, 98, 76, 67, 59, 51, 45, 38, 32, 27, 21, 16, 12, 7, 3],
        'Q' => [331, 150, 102, 80, 71, 63, 55, 48, 42, 36, 30, 25, 20, 16, 11, 7, 3],
        'R' => [335, 154, 106, 84, 75, 67, 59, 52, 46, 40, 34, 29, 24, 19, 15, 11, 7, 3],
        'S' => [339, 158, 109, 87, 78, 70, 60, 56, 49, 43, 38, 32, 27, 23, 16, 14, 10, 6, 3],
        'T' => [342, 161, 113, 91, 82, 73, 66, 59, 53, 47, 41, 36, 31, 26, 22, 17, 13, 10, 6, 2],
        'U' => [345, 164, 116, 94, 87, 77, 69, 62, 56, 50, 44, 39, 34, 29, 25, 21, 17, 13, 9, 6, 2],
        'V' => [348, 167, 119, 97, 88, 80, 72, 65, 59, 53, 47, 42, 37, 33, 28, 24, 20, 16, 12, 9, 5, 2],
        'W' => [351, 170, 122, 100, 91, 83, 75, 68, 62, 56, 50, 45, 40, 36, 31, 27, 23, 19, 15, 12, 8, 5, 2],
        'X' => [354, 173, 125, 103, 94, 86, 78, 71, 65, 59, 53, 48, 43, 39, 34, 30, 26, 22, 18, 15, 11, 8, 5, 2],
        'Y' => [357, 176, 128, 106, 97, 89, 81, 74, 68, 62, 56, 51, 46, 41, 37, 33, 29, 25, 21, 18, 14, 11, 8, 5, 2],
        'Z' => [360, 179, 131, 109, 100, 91, 84, 77, 71, 65, 59, 54, 49, 44, 40, 35, 31, 28, 24, 20, 17, 14, 11, 8, 5, 2]
    ];

    /**
     * @var array PADI Dive Table 3, Residual Nitrogen Times
     */
    private $table_three = [
        35 => [10, 19, 25, 29, 32, 36, 40, 44, 48, 52, 57, 62, 67, 73, 79, 85, 92, 100, 108, 117, 127, 139, 152, 168, 188, 205],
        40 => [9, 16, 22, 25, 27, 31, 34, 37, 40, 44, 48, 51, 55, 60, 64, 69, 74, 79, 85, 91, 97, 104, 111, 120, 129, 140],
        50 => [7, 13, 17, 19, 21, 24, 26, 28, 31, 33, 36, 38, 41, 44, 47, 50, 53, 57, 60, 63, 67, 71, 75, 80],
        60 => [6, 11, 14, 16, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39, 42, 44, 47, 49, 52, 54, 55],
        70 => [5, 9, 12, 13, 15, 16, 18, 19, 21, 22, 24, 26, 27, 29, 31, 33, 34, 36, 38, 40],
        80 => [4, 8, 10, 11, 13, 14, 15, 17, 18, 19, 21, 22, 23, 25, 26, 28, 29, 30],
        90 => [4, 7, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 21, 22, 23, 24, 25],
        100 => [3, 6, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
        110 => [3, 6, 7, 8, 9, 10, 11, 12, 13, 14, 14, 15, 16],
        120 => [3, 5, 6, 7, 8, 9, 10, 11, 12, 12, 13],
        130 => [3, 5, 6, 7, 8, 8, 9, 10]
    ];

    /**
     * @param int $depth maximum depth
     * @param $time int bottom time
     * @param null $residual_time for calculating a repetitive dive, RNT obtained from table 3
     * @return string
     */
    public function getPressureGroup ($depth, $time, $residual_time = null) {
        $time = $time + $residual_time;
        $table_depths = $this->getTableDepths();
        $depth_key = null;
        foreach ($table_depths as $key => $table_depth) {
            if ($depth <= $table_depth) {
                $depth_key = $key;
                break;
            }
        }
        if (!$depth_key) {
            return $this::OVER_DEPTH;
        }
        $table_groups = $this->getTableOne();
        $pressure_group = $this::OVER_NDL;
        foreach ($table_groups as $group => $times) {
            if (isset($times[$depth_key]) && $time <= $times[$depth_key]) {
                $pressure_group = $group;
                break;
            }
        }
        return $pressure_group;
    }

    /**
     * @param string $starting_group Pressure group from table 1
     * @param int $surface_interval time between dives in minutes
     * @return string new PG or no residual message
     */
    public function getNewPressureGroup($starting_group, $surface_interval) {
        $pressure_groups = $this->getTableGroups();
        $table_times = $this->getTableTwo();
        $times = $table_times[strtoupper($starting_group)];
        $group_key = null;
        foreach ($times as $key => $time) {
            if ($time < $surface_interval) {
                $group_key = $key;
                break;
            }
        }
        if ($group_key) {
            return $pressure_groups[$group_key - 1];
        } else {
            return $this::NO_RESIDUAL_NITROGEN;
        }
    }

    /**
     * @param string $pressure_group PG after SI
     * @param int $depth planned depth
     * @return mixed either RNT or error message
     */
    public function getResidualNitrogenTime($pressure_group, $depth) {
        $pressure_groups = $this->getTableGroups();
        $nitrogen_times = $this->getTableThree();
        $pressure_key = null;
        foreach ($pressure_groups as $key => $group) {
            if ($group == $pressure_group) {
                $pressure_key = $key;
            }
        }
        $rnt = $this::OFF_REPETITIVE_CHART;
        foreach ($nitrogen_times as $table_depth => $times) {
            if ($depth <= $table_depth) {
                $rnt = isset($nitrogen_times[$table_depth][$pressure_key]) ? $nitrogen_times[$table_depth][$pressure_key] : $this::OFF_REPETITIVE_CHART;
                break;
            }
        }
        return $rnt;
    }


    /**
     * @param $depth integer dive depth
     * @param $rnt int optional residual nitrogen time from previous dive
     * @return mixed
     */
    public function getMaxBottomTime($depth, $rnt = 0) {
        $table_depths = $this->getTableDepths();
        $depth_key = null;
        foreach ($table_depths as $key => $table_depth) {
            if ($depth <= $table_depth) {
                $depth_key = $key;
                break;
            }
        }
        if (!$depth_key) {
            return $this::OVER_DEPTH;
        }
        $max_time = 0;
        $table_groups = $this->getTableOne();

        foreach ($table_groups as $group) {
            if (isset($group[$depth_key])) {
                $max_time = $group[$depth_key];
            } else {
                break;
            }
        }

        return $max_time - $rnt;
    }

    /**
     * @return array
     */
    public function getTableDepths() {
        return $this->table_depths;
    }

    /**
     * @return array
     */
    public function getTableGroups() {
        return $this->table_groups;
    }

    /**
     * @return array
     */
    public function getTableOne() {
        return $this->table_one;
    }

    /**
     * @return array
     */
    public function getTableTwo() {
        return $this->table_two;
    }

    /**
     * @return array
     */
    public function getTableThree() {
        return $this->table_three;
    }
}