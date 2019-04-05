@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <a href="/project/{{ $project->id }}/todos/create" class="btn btn-outline-primary mb-3">Create New Todo</a>

        <h1>Project: {{ $project->title }}</h1>

        @if(count($todos))

            <ul class="list-group">

                @foreach($todos as $todo)

                    <li class="list-group-item mb-2">
                        <p style="{{ $todo->completed ? 'text-decoration: line-through;' : '' }}">
                            {{ $todo->description }}
                        </p>
                        <a href="/todos/{{ $todo->id }}" class="btn btn-outline-primary">Details</a>
                    </li>

                @endforeach

            </ul>

        @else 

            <p><strong>Sorry, no todos yet.</strong></p>

        @endif

    </div>

@endsection