<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // $username = ;

        return view('dashboard.user.dashboard', [
            'pageTitle' => 'Dashboard',
            'active' => 'buku',
            // 'name' => $username,
        ]);
    }
}
