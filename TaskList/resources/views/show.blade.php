@extends('layout.app')

@section('title',$task->title)
@section('content')

<div class="mb-4">
    <a href="{{ route('tasks.index') }}"
    class="font-medium text-gray-700 underline decoration-pink-500">🔙 Go back to the task list!</a>
    </div>

<p class="mb-4 text-slate-70 ">{{$task->description}}</p>

@if($task->long_description)
<p class="mb-4 text-slate-70 ">{{$task->long_description}}</p> 
@endif

<p class="mb-4 text-slate-500 ">Created {{$task->created_at->diffForHumans()}} . Updated {{$task->updated_at->diffForHumans()}}</p>

<p class="mb-4">
    @if ($task->completed)
    <span class="font-medium text-green-500">Completed</span>
    @else
    <span class="font-medium text-red-500">Not completed</span>
    @endif
    </p>

    <div class="flex gap-2">
<div>
    <a href="{{route('tasks.edit',['task'=>$task])}}"
        class="btn">Edit</a>
</div>

<div>
    <form method="POST" action="{{route('tasks.toggle_completed',['task'=>$task])}}" >
        @csrf
        @method('PUT')
        <button class="btn" type="submit">Mark as {{$task->completed ? ' not competed' : 'completed'}}</button>

    </form>
</div>
<div>
    <form action="{{route('tasks.destroy',['task'=>$task->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn">Delete</button> 
    </form></div>
</div>
@endsection

