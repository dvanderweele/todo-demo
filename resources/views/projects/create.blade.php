@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <form action="/projects" method="post">
    
            @csrf 
    
            <div class="form-group">
                <label for="title">Project Title</label>
                <input class="form-control" type="text" name="title" required />
            </div>
            <div class="form-group">
                <label for="description">Project Description</label>
                <input class="form-control" type="text" name="description" required />
            </div>
    
            <button class="btn btn-outline-success" type="submit">Create Project</button>
    
        </form>

    </div>

@endsection