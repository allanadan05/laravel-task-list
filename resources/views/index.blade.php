@extends('layouts.app')

@section('title', "Tasks")

@section('content')
    <div class="mt-2">
        <a href="{{ route('tasks.create') }}" class="btn-task">➕ Add Task</a>
    </div>
    <br>
    @forelse($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}" class=" {{ $task->completed ? 'line-through':'' }} "> {{ $task->title }} </a>
        </div>
    @empty
        <div> There are no task </div>
    @endforelse

    @if($tasks->count())
        {{ $tasks->links() }}
    @endif
@endsection