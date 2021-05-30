<?php

namespace App\Http\Controllers;

use App\libs\Response\GlobalApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AddTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function getTask(){
    	return (new GlobalApiResponse())->success('Task record', 1, Task::all());
    }

    public function createTask(AddTaskRequest $request){
    	$newTask=new Task;
    	$newTask->list_id=$request['list_id'];
    	$newTask->title=$request['title'];
    	$newTask->description=$request['description'];
    	$newTask->status_check=$request['status_check'];
        $newTask->progress=$request['progress'];
    	$newTask->save();
    	return (new GlobalApiResponse())->success('Task added',1,$newTask);
    }

    public function editTask(Request $request,$id){
        $updateTask=Task::findOrFail($id);
        $updateTask->title=$request['title'];
        $updateTask->description=$request['description'];
        $updateTask->status_check=$request['status_check'];
        $updateTask->progress=$request['progress'];
        $updateTask->save();
        return (new GlobalApiResponse())->success('Task updated',1,$updateTask);
    }

    public function deleteTask($id){
        Task::findOrFail($id)->delete();
        return (new GlobalApiResponse())->success('Task deleted',1,'');
    }

    public function getListTask($id){
        return (new GlobalApiResponse())->success('Task list',1,Task::where('list_id',$id)->get());
    }
}
