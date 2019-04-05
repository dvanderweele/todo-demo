@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        
        <h1>{{ $project->title }}</h1>

        <form action="/todos" method="post">
    
            @csrf 

            <input type="hidden" name="project_id" value="{{ $project->id }}" required />
    
            <div class="form-group">
                <label for="description">Description</label>
                <input class="form-control" type="text" name="description" required />
            </div>
    
            <button class="btn btn-outline-success" type="submit">Create Todo</button>
    
        </form>

    </div>

@endsection