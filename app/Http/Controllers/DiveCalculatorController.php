<?php

namespace App\Http\Controllers;

use App\Libraries\DiveCalculator;
use Illuminate\Http\Request;

class DiveCalculatorController extends Controller
{
    public function getCalculator() {
        $calculator = new DiveCalculator();
        return view('pages.divecalculator', [
            'table_1_header'    => $calculator->getTableDepths(),
            'table_1_body'      => $calculator->getTableOne(),
            'table_header'      => $calculator->getTableGroups(),
            'table_2_body'      => $calculator->getTableTwo(),
            'table_3_body'      => $calculator->getTableThree()
        ]);
    }

    public function postCalculator(Request $request) {
        $this->validate($request, [
            'dive_1_depth'      => 'numeric|nullable',
            'dive_1_time'       => 'numeric|nullable',
            'surface_interval'  => 'numeric|nullable',
            'dive_2_depth'      => 'numeric|nullable',
            'dive_2_time'       => 'numeric|nullable',
        ]);

        $dive_1_max_time    = null;
        $dive_1_pg          = null;
        $post_si_pg         = null;
        $rnt                = null;
        $dive_2_max_time    = null;
        $dive_2_pg          = null;

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
        }

        if ($dive_1_pg && $surface_interval) {
            $post_si_pg = $calculator->getNewPressureGroup($dive_1_pg, $surface_interval);
        }

        if ($post_si_pg && $dive_2_depth) {
            $rnt = $calculator->getResidualNitrogenTime($post_si_pg, $dive_2_depth);
            $dive_2_max_time = $calculator->getMaxBottomTime($dive_2_depth, $rnt);
        }

        if ($rnt && $dive_2_depth && $dive_2_time) {
            $dive_2_pg = $calculator->getPressureGroup($dive_2_depth, $dive_2_max_time, $rnt);
        }

        return response()->json([
            'dive_1_max_time'   => $dive_1_max_time,
            'dive_1_pg'         => $dive_1_pg,
            'post_si_pg'        => $post_si_pg,
            'rnt'               => $rnt,
            'dive_2_max_time'   => $dive_2_max_time,
            'dive_2_pg'         => $dive_2_pg
        ]);
    }
}
