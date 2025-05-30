@extends("layouts.app")


@section("title", $task->title)

@section("content")
<div class="mb-4">
    <a href="{{ route('tasks.index') }}"
    class="link">Back to the task list</a>
</div>

<p class="mb-4 text-slate-700">{{ $task->description }}</p>

@if ($task->long_description)
    <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
@endif

<p class="mb-4 text-sm text-slate-500">Created {{ $task->created_at->diffForHumans() }} | Updated {{ $task->updated_at->diffForHumans() }}</p>
<p class="mb-4">
    <span class="font-medium text-slate-700">Status:</span>
    <span class="text-slate-500">
        @if ($task->completed)
            <span class="text-green-500">Completed</span>
        @else
            <span class="text-red-500">Not completed</span>
        @endif
    </span>
</p>

<div class="flex gap-2">
    <a href="{{ route('tasks.edit', ['task' => $task]) }}"
    class="btn">Edit</a>

    <form action="{{ route('tasks.toggle-complete', ['task' => $task->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit" class="btn">
            Mark as {{ $task->completed ? 'not completed' : 'completed' }}
        </button>
    </form>

    <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn">Delete</button>
    </form>
</div>
@endsection
