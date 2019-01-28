<?php

namespace App\Http\Controllers;

use App\DiveLogPage;
use App\Http\Requests\DiveLogRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class DiveLogController extends Controller {
    public function getList(Request $request, $current_page = 1) {
        if (!auth()->user()) {
            return view('divelog.divelog_no_user');
        } else {
            $limit = 10;
            if (is_numeric($request->input('limit'))) {
                $limit = (int)round($request->input('limit')) < 100 ? (int)round($request->input('limit')) : 100;
            }

            $skip = ($current_page - 1) * $limit;

            $dive_logs = DiveLogPage::where('user_id', '=', auth()->user()->id)->orderBy('created_at', 'DESC')->limit($limit)->skip($skip)->get();

            $total_logs = DiveLogPage::where('user_id', '=', auth()->user()->id);

            return view('divelog.divelog_list', [
                'dive_logs'    => $dive_logs,
                'logged_dives' => $total_logs->count(),
                'bottom_time'  => $total_logs->pluck('bottom_time')->count() ? $total_logs->pluck('bottom_time')->sum() : 0,
                'last_dive'    => $total_logs->pluck('date')->count() ? $total_logs->pluck('date')->max() : false,
                'current_page' => $current_page,
                'pages'        => ceil($total_logs->count() / $limit),
                'limit'        => $limit,
            ]);
        }
    }

    public function getCreate() {
        $dive_log = new DiveLogPage();

        return view('divelog.divelog_create', [
            'dive_log' => $dive_log,
        ]);
    }

    public function postCreate(DiveLogRequest $request) {
        $data                = $request->all();
        $last_dive_number    = DiveLogPage::get()->count() ? DiveLogPage::where('user_id', '=', auth()->user()->id)->get()->max('dive_number') : 0;
        $data['user_id']     = auth()->user()->id;
        $data['date']        = $data['date'] ? Carbon::createFromFormat('j M, Y', $data['date'])->toDateString() : $data['date'];
        $data['dive_number'] = $last_dive_number + 1;
        DiveLogPage::create($data);

        return redirect()->route('divelog_list');
    }

    public function getEdit($id) {
        $dive_log = DiveLogPage::find($id);
        if (!$dive_log) {
            Session::flash('flash_warning', 'Dive log does not exist');

            return redirect()->back();
        }
        if ($dive_log->user_id !== auth()->user()->id) {
            Session::flash('flash_warning', 'You are not authorized to view this log');

            return redirect()->back();
        }

        return view('divelog.divelog_edit', [
            'dive_log' => $dive_log,
        ]);
    }

    public function postEdit(Request $request, $id) {
        $dive_log        = DiveLogPage::find($id);
        $data            = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['date']    = Carbon::createFromFormat('j M, Y', $data['date'])->toDateString();
        $dive_log->fill($data);
        $dive_log->save();

        return redirect()->route('divelog_list');
    }

    public function getPdf($id) {
        $dive_log = DiveLogPage::find($id);
        if ($dive_log->user_id !== auth()->user()->id) {
            Session::flash('flash_warning', 'You are not authorized to view this log');

            return redirect()->back();
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');

        return $pdf->download('dive_log.pdf');
    }
}
