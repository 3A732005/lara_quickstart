<?php

use Illuminate\Support\Facades\Route;
use App\Task;
use illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    //return view('tasks');
    $tasks=Task::orderBy(created_at, 'asc')->get();
    return view('tasks',['tasks'=>$tasks]);
});

Route::post('/task',function(Request $request){
    //驗證輸入
    $validator=Validator::make($request->all(),[
        'name'=>'required|max:255',
    ]);
    if ($validator->fails()){
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //建立該任務
    $task=new Task;
    $task->name=$request->name;
    $task->save();
    return redirect('/');
});

Route::delete('/task/{task}',function(Task $task){
    //
});
