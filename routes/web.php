<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function (){
    return view('welcome');
});

Route::get('/tasks', function () {
    return view('index', [
        "tasks" => Task::latest()->paginate(10),
    ]);
})->name('tasks.index');


Route::get('/tasks/create', function (){
    return view('create');
})->name("tasks.create");

Route::get('/tasks/{task}', function (Task $task){
    return view('show', [
        "task" => $task,
    ]);
})->name("tasks.show");

Route::post("/tasks", function(TaskRequest $request){

    $task = Task::create( $request->validated() );

    return redirect()->route("tasks.show", ["task" => $task->id])
                    ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put("/tasks/{task}", function(Task $task, Request $request){
    $validated_data = $request->validate([
        'title' => 'sometimes|max:255',
        'description' => 'sometimes',
        'long_description' => 'sometimes',
    ]);

    $task->update( $validated_data );

    return redirect()->route("tasks.show", ["task" => $task->id])
                    ->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::get('/tasks/{task}/edit', function (Task $task){
    return view('edit', [
        "task" => $task,
    ]);
})->name("tasks.edit");


Route::delete('tasks/{task}', function(Task $task){
    $task->delete();

    return redirect()->route("tasks.index")
                     ->with('success', "Task deleted successfully!");
})->name('tasks.destroy');

Route::put('task/{task}/toggle-complete', function(Task $task){

    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task udpated successfully!');
})->name('tasks.toggle-complete');

// Route::get('/hello', function () {
//     return 'Hello World';
// });

// //Redirect Route
// Route::get('/hallo', function () {
//     return redirect('/hello');
// });

// Route::get('/hello/{name}', function ($name) {
//     return 'Hello, ' .$name ."!";
// });

// //Named Route
// Route::get('/greet', function () {
//     return 'Greetings, this came from a named route';
// })->name('greet');

// //Redirecting to Named Route
// Route::get('/greetme', function () {
//     return redirect()->route('greet');
// });

//Redirect to index page if route not foud
Route::fallback(function () {
    return redirect('/');
});
