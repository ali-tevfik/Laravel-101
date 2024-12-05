<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

Route::get('/', function()  {
    return redirect()->route('tasks.index');
});

Route::get('/hello',function() {
    return 'HOIIII';
});



Route::view('/tasks/create','create')->name('tasks.create');

Route::get('/tasks',function(){
  return view('index',['tasks' => \App\Models\Task::latest()->paginate(10)]);
})->name('tasks.index');



Route::post('/tasks', function (TaskRequest $request) {
    // $data = $request->validate();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show',['task'=>$task->id ])->with('succes','Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task,TaskRequest $request) {
  // $data = $request->validate();
  // $task->title = $data['title'];
  // $task->description = $data['description'];
  // $task->long_description = $data['long_description'];
  // $task->update();
  $task->update($request->validated());
  return redirect()->route('tasks.show',['task'=>$task->id ])->with('succes','Task updated successfully!');
})->name('tasks.update');




Route::get('task/{task}', function (Task $task){
    // foreach ($tasks as $task){
    //     if($id == $task->id)
    //     $findItem = $task;
    // };
    //or
    // $findItem = collect($tasks)->firstWhere('id',$id);
    // if(!$findItem){
    //     abort(404);
    // }else {
    //     return view('show',['task' => $findItem]);
    // }


return view('show',['task' => $task]);

}) ->name("tasks.show");


Route::delete('/task/{task}', function(Task $task){
  $task->delete();
  return redirect()->route('tasks.index')->with('succes','Task deleted successfully');
})->name('tasks.destroy');

Route::get('task/{task}/edit', function (Task $task){

return view('edit',['task' => $task]);
}) ->name("tasks.edit");


Route::put('tasks/{task}/toggle-complete',function (Task $task) {
  $task->toggleComplete();
 
  return redirect()->back()->with('success', 'Task updated successfully!');

})->name('tasks.toggle_completed');