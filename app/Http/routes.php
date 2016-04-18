<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $tasks = \App\Task::all();
    return View::make('home')->with('tasks',$tasks);
});

Route::auth();

Route::get('/tasks/{task_id?}',function($task_id){
    $task = \App\Task::find($task_id);

    return Response::json($task);
});

Route::post('/tasks',function(Request $request){
    $task = \App\Task::create($request->all());

    return Response::json($task);
});

Route::put('/tasks/{task_id?}',function(Request $request,$task_id){
    $task = \App\Task::find($task_id);

    $task->task = $request->task;
    $task->description = $request->description;

    $task->save();

    return Response::json($task);
});

Route::delete('/tasks/{task_id?}',function($task_id){
    $task = \App\Task::destroy($task_id);

    return Response::json($task);
});