<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectsRequest;
use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $projects = Projects::paginate(15);

        return view('projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectsRequest $request)
    {
            $data = $request->getData();

            Projects::create($data);

            return redirect()->route('projects.index')
                ->with('success_message', 'Projects was successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projects  $project
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Projects $project)
    {
        return view('projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Projects $project)
    {
        return view('projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProjectsRequest $request,  $id)
    {
        $data = $request->getData();

        $project = Projects::findOrFail($id);
        $project->update($data);

        return redirect()->route('projects.index')
            ->with('success_message', 'Project was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projects  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $project = Projects::findOrFail($id);
        $project->delete();

        return redirect()->back()
            ->with('success_message', 'Project was successfully deleted.');
    }
}
