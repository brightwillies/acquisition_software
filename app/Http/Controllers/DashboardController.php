<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    //
    public function adminLogin()
    {
        return view('dashboard.login');
    }

    public function adminDashboard()
    {
        return view('dashboard.dashboard');
    }


    public function purchaserLogin()
    {
        return view('dashboard.plogin');
    }

    public function purchaserDashboard()
    {
        return view('dashboard.pdashboard');
    }
    public function HodLogin()
    {
        return view('dashboard.hlogin');
    }

    public function hodDashboard()
    {
        return view('dashboard.hdashboard');
    }
}
