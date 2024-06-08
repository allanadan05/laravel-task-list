@extends('layouts.app')

@section('title', isset($task) ?  'Edit Task':'Add Task')

@section('styles')
    <style>
        .error{
            color: red;
            margin-bottom: 5px;
        }

        .small{
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')

    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        @isset($task)
            @method('PUT')
        @endisset
        @csrf
        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}"
                @class(['border-red-500' => $errors->has('title')])>
            @error('title')
                <div class="small error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">Description</label>
            <textarea rows="5" name="description" id="description"
                @class(['border-red-500' => $errors->has('description')])>{{ $task->description ?? old('description') }}
            </textarea>
            @error('description')
                <div class="small error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="long_description">Long Description</label>
            <textarea rows="7" name="long_description" id="long_description"
                @class(['border-red-500' => $errors->has('long_description')])>{{ $task->long_description ?? old('long_description') }}
            </textarea>
            @error('long_description')
                <div class="small error">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center gap-5">
            <button type="submit" class="btn-task">
                @isset($task)
                    Update Task
                @else
                    Add Task
                @endisset
            </button>

            <a href="{{ route('tasks.index') }}" class="link"> Cancel </a>
        </div>
    </form>

@endsection