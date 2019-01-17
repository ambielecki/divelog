<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiveCalculatorRequest;
use App\Http\Requests\LogCalculatorRequest;
use Ambielecki\DiveCalculator\DiveCalculator;
use Illuminate\Http\JsonResponse;

class DiveCalculatorController extends Controller
{
    public function getCalculator() {
        $calculator = new DiveCalculator();

        return view('pages.divecalculator', [
            'table_1_header' => $calculator->getTableDepths(),
            'table_1_body'   => $calculator->getTableOne(),
            'table_header'   => $calculator->getTableGroups(),
            'table_2_body'   => $calculator->getTableTwo(),
            'table_3_body'   => $calculator->getTableThree(),
        ]);
    }

    public function postCalculator(DiveCalculatorRequest $request): JsonResponse {
        $error = false;

        $dive_1_max_time = null;
        $dive_1_pg = null;
        $post_si_pg = null;
        $rnt = null;
        $dive_2_max_time = null;
        $dive_2_pg = null;

        $dive_1_depth = $request->input('dive_1_depth');
        $dive_1_time = $request->input('dive_1_time');
        $surface_interval = $request->input('surface_interval');
        $dive_2_depth = $request->input('dive_2_depth');
        $dive_2_time = $request->input('dive_2_time');

        $calculator = new DiveCalculator();

        if ($dive_1_depth) {
            $dive_1_max_time = $calculator->getMaxBottomTime($dive_1_depth);
        }

        if ($dive_1_depth && $dive_1_time) {
            $dive_1_pg = $calculator->getPressureGroup($dive_1_depth, $dive_1_time);
            if (DiveCalculator::OVER_DEPTH === $dive_1_depth || DiveCalculator::OVER_NDL === $dive_1_depth) {
                $error = true;
            }
        }

        if (!$error && $dive_1_pg && $surface_interval) {
            $post_si_pg = $calculator->getNewPressureGroup($dive_1_pg, $surface_interval);
        }

        if (!$error && $post_si_pg && $dive_2_depth) {
            if (DiveCalculator::NO_RESIDUAL_NITROGEN === $post_si_pg) {
                $rnt = 0;
            } else {
                $rnt = $calculator->getResidualNitrogenTime($post_si_pg, $dive_2_depth);
            }
            if (DiveCalculator::OFF_REPETITIVE_CHART === $rnt) {
                $error = true;
            } else {
                $dive_2_max_time = $calculator->getMaxBottomTime($dive_2_depth, $rnt);
            }
        }

        if (!$error && $rnt && $dive_2_depth && $dive_2_time) {
            $dive_2_pg = $calculator->getPressureGroup($dive_2_depth, $dive_2_max_time, $rnt);
        }

        return response()->json([
            'dive_1_max_time' => $dive_1_max_time,
            'dive_1_pg'       => $dive_1_pg,
            'post_si_pg'      => $post_si_pg,
            'rnt'             => $rnt,
            'dive_2_max_time' => $dive_2_max_time,
            'dive_2_pg'       => $dive_2_pg,
        ]);
    }

    public function postLogCalculator(LogCalculatorRequest $request): JsonResponse {
        $max_depth = $request->input('max_depth');
        $bottom_time = $request->input('bottom_time');
        $previous_pg = $request->input('previous_pg');
        $surface_interval = $request->input('surface_interval');
        $post_si_pg = null;
        $rnt = null;

        $calculator = new DiveCalculator();

        if ($surface_interval) {
            $post_si_pg = $calculator->getNewPressureGroup($previous_pg, $surface_interval);
            if ($max_depth < 130) {
                $rnt = $calculator->getResidualNitrogenTime($post_si_pg, $max_depth);
            }
        }
        $pressure_group = $calculator->getPressureGroup($max_depth, $bottom_time, $rnt);

        return response()->json([
            'pressure_group' => $pressure_group
        ]);
    }
}
