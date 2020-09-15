<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Task;
class TaskController extends Controller
{
    // --------------------- [ Load Task Listing View ] -----------------------
   
    public function index()
    {
        return view('task/index');
    }
    // --------------------- [Load Create task view ] -------------------------
   
    public function create()
    {
        return view ('task/create');
    }
  
    // ------------------- [ Save Task ] ----------------------------
    public function storeTask(Request $request)
    {
      
       $validator = $request->validate(
           [
                'task_title' => 'required',            
                'description' => 'required',
                'category'    => 'required',
                'duration'    => 'required'
           ]
        );
    
        $input  =   $request->all();
        $task   =   Task::create($input);
        if(!is_null($task)) {
            return response()->json(['status' => 'success', 'message' => 'Task created successfully']);
        }     
        else {
            return response()->json(['status' => 'failed', 'message' => 'Failed to create task']);
        }   
    }
}