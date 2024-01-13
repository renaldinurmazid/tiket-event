<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardC extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        return view('pages.dashboard.dashboard', compact('title'));
    }
}
