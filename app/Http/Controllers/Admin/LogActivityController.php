<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function logActivity() {
        $logs = \LogActivity::logActivityLists();
        return view('admin.logactivity',compact('logs'));
    }
}
