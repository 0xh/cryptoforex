<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use App\TaskStatus;
use App\TaskType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller{
    public function __construct(){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq){
        $res = [];
        $user = ($rq->input("user_id",false)!==false)?User::find($rq->input("user_id")):$rq->user();
        $status = $rq->input("status","all");
        $type = $rq->input("type","all");
        $selector = Task::where('user_id','=',$user->id);
        if($status!="all"){
            $status = TaskStatus::where('code',$status)->first();
            if(!is_null($status))$selector = $selector->where("status_id",$status->id);
        }
        if($type!="all"){
            $type = TaskType::where('code',$type)->first();
            if(!is_null($type))$selector = $selector->where("type_id",$type->id);
        }
        $tasks = $selector->orderBy('id','desc')->get();
        foreach($tasks as $task){
            $row = $task->toArray();
            $row["type"] = TaskType::find($task->type_id)->toArray();
            unset($row["type_id"]);
            $row["status"] = TaskStatus::find($task->status_id);
            unset($row["status_id"]);
            $row["user"] = User::find($task->user_id);
            unset($row["user_id"]);
            $res[]=$row;
        }
        return response()->json($res,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function add($id,Request $rq){}
    public function edit($id,Request $rq){}
    public function delete($id,Request $rq){}
    public function statuses(Request $rq){
        return response()->json(TaskStatus::all(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function types(Request $rq){
        return response()->json(TaskType::all(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
