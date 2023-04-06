<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    //
    public function flush(){
        Cache::forget('posts');
        Cache::forget('tags');
        return redirect()->route('index');
    }
}
