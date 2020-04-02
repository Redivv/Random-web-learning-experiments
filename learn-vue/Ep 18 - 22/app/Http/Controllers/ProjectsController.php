<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function create()
    {
        return view('projects.create',[
            'projects' => Project::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);

        $newProject = new Project;

        $newProject->name = $request->name;
        $newProject->desc = $request->desc;

        $newProject->save();

        return ['message' => "Pierdol Się"];
    }
}
