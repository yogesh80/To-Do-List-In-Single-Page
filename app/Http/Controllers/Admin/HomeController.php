<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Task;
class HomeController
{
    
    public function index()
    {
        $tasks=Task::where('status',0)->get();

        return view('home',compact('tasks'));
    }
}
