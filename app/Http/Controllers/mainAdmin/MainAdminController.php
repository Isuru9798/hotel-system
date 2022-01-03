<?php

namespace App\Http\Controllers\mainAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainAdminController extends Controller
{
    function index()
    {
        return view('dashboards.main-admin.dashboard');
    }
}
