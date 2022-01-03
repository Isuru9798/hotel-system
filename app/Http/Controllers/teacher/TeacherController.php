<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    function index()
    {
        return view('dashboards.teacher.dashboard');
    }
}
