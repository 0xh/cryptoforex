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
        $tasks = Task::orderBy('id','desc')
            ->byType($rq->input("type","all"))
            ->byStatus($rq->input("status","all"))
            ->byUserId($user->id)
            ->with(['status','type'])
            ->get();
        return response()->json($tasks,200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function add($id,Request $rq){
        return response()->json(Task::create($rq->all()),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function edit($id,Request $rq){}
    public function delete($id,Request $rq){}
    public function statuses(Request $rq){
        return response()->json(TaskStatus::all(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function types(Request $rq){
        return response()->json(TaskType::all(),200,['Content-Type' => 'application/json; charset=utf-8'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
}
?>
