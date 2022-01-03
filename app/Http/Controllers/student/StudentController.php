<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index()
    {
        return view('dashboards.student.dashboard');
    }
}
