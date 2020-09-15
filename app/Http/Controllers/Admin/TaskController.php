<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Task;
use Auth;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $tasks=Task::all();
        
        if(count($tasks) > 0){
          return view('data',compact('tasks'))->render();
        }else{
            return response()->json(['status' => 'failed', 'message' => 'Sorry No Records Found']);

        }

         
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Task' => 'required|string|unique:tasks',
        ]);

         if ($validator->fails()) {
            
            return response()->json(['error'=>$validator->errors()->all()]);
        }
     
         $input  =   $request->all();
         $task   =   Task::create([
                  'task'=>$request->get('Task'),
                  'user_id'=>Auth::user()->id
           ]);
         if(!is_null($task)) {
             return response()->json(['status' => 'success', 'message' => 'Task created successfully','task'=>$task]);
         }     
         else {
             return response()->json(['status' => 'failed', 'message' => 'Failed to create task']);
         }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id)
    {
        $task=Task::find($id);
         $task->status=1;
         $task->save();
         return response()->json(['status' => 'success', 'message' => 'Task Deleted successfully']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if($request->ajax()){
            Task::find($id)->delete();

            return response()->json(['status' => 'success', 'message' => 'Task Deleted successfully']);

         }
    
    }
}
