<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class AdminController controller for admin related functionality
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    public function getAdmin(): View {
        return view('admin.admin');
    }

    public function getPhpInfo() {
        return phpinfo();
    }
}
