@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <form action="/project" method="post">

            @method('PATCH')
            @csrf 

            <input type="hidden" name="id" value="{{ $project->id }}">
    
            <div class="form-group">
                <label for="title">Project Title</label>
                <input class="form-control" type="text" name="title" value="{{ $project->title }}" required />
            </div>
            <div class="form-group">
                <label for="description">Project Description</label>
                <input class="form-control" type="text" name="description" value="{{ $project->description }}" required />
            </div>
    
            <button class="btn btn-outline-success" type="submit">Update Project</button>
    
        </form>

    </div>

@endsection