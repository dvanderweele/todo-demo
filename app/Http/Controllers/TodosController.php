<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Todo;
use App\User;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::findOrFail($id);
        abort_unless($project->user_id == auth()->user()->id, 403);
        $todos = $project->todos->sortBy('completed');
        return view('todos.index')->with('project', $project)->with('todos', $todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $project = Project::findOrFail($id);
        abort_unless($project->user_id == auth()->user()->id, 403);
        return view('todos.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:200'
        ]);
        $project = Project::findOrFail($request->project_id);
        abort_unless($project->user_id == auth()->user()->id, 403);
        $todo = new Todo();
        $todo->project_id = $project->id;
        $todo->user_id = auth()->user()->id;
        $todo->description = $request->description;
        $todo->completed = false;
        $todo->save();
        $route = "/project/". $project->id ."/todos";
        return redirect($route);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        abort_unless($todo->user_id == auth()->user()->id, 403);
        $project = $todo->project;
        abort_unless($project->user_id == auth()->user()->id, 403);
        return view('todos.show')->with([
            'todo' => $todo,
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::findOrFail($id);
        abort_unless($todo->user_id == auth()->user()->id, 403);
        $project = $todo->project;
        abort_unless($project->user_id == auth()->user()->id, 403);
        return view('todos.edit')->with([
            'todo' => $todo,
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'description' => 'required|max:150',
            'complete' => 'required'
        ]);
        $todo = Todo::findOrFail($request->id);
        abort_unless($todo->user_id == auth()->user()->id, 403);
        $todo->description = $request->description;
        if ($request->complete == "complete")
        {
            $todo->completed = true;
        } else 
        {
            $todo->completed = false;
        }
        $todo->save();
        $route = "/todos/".$todo->id;
        return redirect($route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $todo = Todo::findOrFail($request->id);
        $project = $todo->project;
        abort_unless($todo->user_id == auth()->user()->id, 403);
        abort_unless($project->user_id == auth()->user()->id, 403);
        $todo->delete();
        $route = "/project/". $project->id ."/todos";
        return redirect($route);
    }
}
