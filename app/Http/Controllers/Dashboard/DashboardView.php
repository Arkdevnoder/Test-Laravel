<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Estate;
use App\Traits\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

class DashboardView extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return View::make('dashboard');
    }
}
