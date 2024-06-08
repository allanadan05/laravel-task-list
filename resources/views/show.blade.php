@extends('layouts.app')

<div class="mt-2 mb-4">
    <a href="{{ route('tasks.index') }}" class="link">⬅️ Go back to task list</a>
</div>

@section('title', $task->title)

@section('content')
    <div class="mb-4"> 
        @if($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Not Completed</span>
        @endif
    </div>

    <p class="mb-4 text-slate-700"> {{ $task->description }} </p>

    @if($task->long_description)
        <p class="mb-4 text-slate-700"> {{ $task->long_description }} </p>
    @endif

    <p class="mb-4 text-sm text-slate-500"> Created {{ $task->created_at->diffForHumans() }} ● Updated {{ $task->updated_at->diffForHumans() }}</p>
   

    <div class="flex justify-between">
        <div class="flex gap-2">
            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"><button class="btn-task">Edit</button></a>

            <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task->id]) }}">
                @csrf
                @method('PUT')
                <button type="submit" class="btn-task">Mark as {{ $task->completed ? "not completed":"completed" }}</button>
            </form>
        </div>

       <div class="flex">
            <form method="POST" action="{{ route('tasks.destroy', ["task" => $task->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-task-danger">Delete</button>
            </form>
       </div>
    </div>
@endsection