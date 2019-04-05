@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <a href="/projects/create" class="btn btn-outline-primary mb-3">Create New Project</a>

        @if(count($projects))

            <ul class="list-group">

                @foreach($projects as $project)

                    <li class="list-group-item mb-2">
                        <h4>{{ $project->title }}</h4>
                        <p>{{ $project->description }}</p>
                        <a href="/projects/{{ $project->id }}" class="btn btn-outline-primary">Details</a>
                    </li>

                @endforeach

            </ul>

        @else 

            <p><strong>Sorry, no projects yet.</strong></p>

        @endif

    </div>

@endsection