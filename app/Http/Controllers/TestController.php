<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class TestController extends Controller {
    public function getTest(): View {
        return view('test');
    }

    public function getTestAjax(): JsonResponse {
        return response()->json([]);
    }
}
