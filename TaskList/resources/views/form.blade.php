@extends('layout.app')

@section('title', isset($task)? 'Edit task': 'Add Task')

@section('style')
<style>
    .error-message{
        color:red;
        font-size: 0, 8rem;
    }
</style>
@endsection



@section('content')
{{-- {{$errors}} --}}
<form method="POST" action="{{ isset($task) ? route('tasks.update',['task' => $task->id]) : route('tasks.store') }}">
    @csrf
    @isset($task)
        @method('PUT')
    @endisset
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title"
        @class(['border-red-500' => $errors->has('title')])

 value="{{$task->title ?? old('title')}}"/>
        @error('title')
        <p class="error"> {{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="description">Description</label>
        <textarea 
        @class(['border-red-500' => $errors->has('title')])
        name="description" id="description" rows="5">{{$task->description ?? old('description')}}</textarea>
        @error('description')
        <p class="error"> {{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="long_description">Long Description</label>
        <textarea 
        @class(['border-red-500' => $errors->has('title')])
        name="long_description" id="long_description" rows="5">
            {{$task->long_description ??old('long_description')}}
        </textarea>
        @error('long_description')
        <p class="error"> {{$message}}</p>
        @enderror
    </div>

    <div>
        <button class="btn" type="submit"> @isset($task) 
            Edit Task 
            @else 
            Add Task!@endisset </button>
            <a href="{{route('tasks.index')}}" class="link">Cancel</a>
    </div>
</form>
@endsection 