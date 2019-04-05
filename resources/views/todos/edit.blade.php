@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <form action="/todos" method="post">

            @method('PATCH')
            @csrf 

            <input type="hidden" name="id" value="{{ $todo->id }}">
    
            <div class="form-group">
                <label for="description">Description</label>
                <input class="form-control" type="text" name="description" value="{{ $todo->description }}" required />
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="complete" id="iscomplete" class="form-check-input" value="complete" {{ $todo->completed ? 'checked' : '' }} required />
                <label for="iscomplete" class="form-check-label">Complete</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="complete" id="incomplete" class="form-check-input" value="incomplete" {{ $todo->completed ? '' : 'checked' }} />
                <label for="incomplete" class="form-check-label">Incomplete</label>
            </div>
            <br>
            <button class="btn btn-outline-success mt-3" type="submit">Update Todo</button>
    
        </form>

    </div>

@endsection