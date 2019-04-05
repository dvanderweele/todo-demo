@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="row">

            <div class="col-md-3">
                <div class="card p-2">
                    <a href="/projects" class="btn btn-outline-primary btn-block">Projects</a>

                    <a href="/project/{{ $project->id }}/todos" class="btn btn-outline-primary btn-block">Project's Todos</a><br/>
    
                    <a href="/projects/{{ $project->id }}/edit" class="btn btn-outline-warning btn-block mt-2">Edit Project</a><br/>
    
                    <form class="mt-2" action="/project" method="post">
            
                        @method('DELETE')
                        @csrf 
                        
                        <input type="hidden" name="id" value="{{ $project->id }}">
                
                        <button class="btn btn-outline-danger btn-block" type="submit">Delete Project</button>
                
                    </form>
                </div>

            </div>

            <div class="col-md-9">
                
                <h1>Project: {{ $project->title }}</h1>

                <p class="lead mt-2">{{ $project->description }}</p>
                
            </div>

        </div>

    </div>

@endsection