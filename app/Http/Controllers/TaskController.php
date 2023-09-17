<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{


    // public function checkApikey($apikey){
        // $key="helloatg";
        // if ($apikey==$key) {
            // return true;
        // }else {
            // return false;
        // }
    // }

    public function addtask($task,$user_id){
        // if (!$this->checkApikey($key->header('api_key'))) {
            // $data=[
                // 'status'=> 200,
                // 'message'=> "Project Unauthorized",
// 
            // ];
            // return response()->json($data);
        // }
        $data=User::where('id', $user_id )->exists();
        if ($data) {
            $user= new Task;
            $user->user_id= $user_id;            
            $user->task= $task;            
            $user->save();         
            $response=[
                "status" => 1,
                "data" => ["task"=>$task,"user_id"=>$user_id],
                "message" => "Successfully Created a Task..!!"];
            return response()->json($response,200);
        }else {
            $response=[
                "status" => 0,
                "message" => "Invalid Userid "];
            return response()->json($response,500);
        }
        
    }

    public function checkstatus($task_id,$status){
        $check=Task::where('id',$task_id)->exists();
        if ($check) {
            $data = Task::find($task_id);
            $data->status = $status;
            $data->save();
            $response=[
                "status" => 1,
                "data" => $data,
                "message" => "Marked task as $status"];
            return response()->json($response,200);
        }else {
            $response=[
                "status" => 0,
                "message" => "Invalid Taskid "];
            return response()->json($response,500);
        }
    }

}

