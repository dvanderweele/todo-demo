<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Todo;
use App\User;


class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('user_id', auth()->user()->id)->get();
        return view('projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
            'title' => 'required|max:40',
            'description' => 'required|max:200'
        ]);
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->user_id = auth()->user()->id;
        $project->save();
        $route = '/projects/' . $project->id;
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
        $project = Project::findOrFail($id);
        abort_unless($project->user_id == auth()->user()->id, 403);
        return view('projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        abort_unless($project->user_id == auth()->user()->id, 403);
        return view('projects.edit', compact('project'));
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
        $project = Project::findOrFail($request->id);
        abort_unless($project->user_id == auth()->user()->id, 403);
        $request->validate([
            'title' => 'required|max:40',
            'description' => 'required|max:200'
        ]);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();
        $route = '/projects/' . $project->id;
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
        $project = Project::findOrFail($request->id);
        abort_unless($project->user_id == auth()->user()->id, 403);
        $todos = $project->todos()->get();
        foreach($todos as $todo)
        {
            if($todo)
            {
                $todo->delete();
            }
        }
        $project->delete();
        return redirect('/projects');
    }
}
