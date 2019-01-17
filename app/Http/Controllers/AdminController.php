<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class AdminController controller for admin related functionality
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    public function getAdmin() {
        return view('admin.admin');
    }

    public function getPhpInfo() {
        return phpinfo();
    }
}
