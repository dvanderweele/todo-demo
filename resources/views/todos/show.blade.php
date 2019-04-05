@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="row">

            <div class="col-md-3">
                <div class="card p-2">
                    <a href="/projects/{{ $project->id }}" class="btn btn-outline-primary btn-block">View Project</a>

                    <a href="/project/{{ $project->id }}/todos" class="btn btn-outline-primary btn-block">Project's Todos</a><br/>
    
                    <a href="/todos/{{ $todo->id }}/edit" class="btn btn-outline-warning btn-block mt-2">Edit Todo</a><br/>
    
                    <form class="mt-2" action="/todos" method="post">
            
                        @method('DELETE')
                        @csrf 
                        
                        <input type="hidden" name="id" value="{{ $todo->id }}">
                
                        <button class="btn btn-outline-danger btn-block" type="submit">Delete Todo</button>
                
                    </form>
                </div>

            </div>

            <div class="col-md-9">
                
                <ul class="list-group">
                    <li class="list-group-item">
                        @if($todo->completed)
                            <span class="badge badge-success">Complete</span>
                        @else 
                            <span class="badge badge-danger">Incomplete</span>
                        @endif
                         {{ $todo->description }}
                    </li>
                </ul>
                
            </div>

        </div>

    </div>

@endsection