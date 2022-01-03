<?php

namespace App\Http\Controllers\schoolAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolAdminController extends Controller
{
    function index()
    {
        return view('dashboards.school-admin.dashboard');
    }
}
