<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Pauses;
use App\Models\Tasks;
use App\Models\TimeTracker;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tasks = Tasks::paginate(15);

        return view('tasks.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($project)
    {
        return view('tasks.create',compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TasksRequest $request)
    {
        $data = $request->getData();

        Tasks::create($data);

        return redirect()->route('tasks.index')
            ->with('success_message', 'Task was successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Tasks $task)
    {
        return view('tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Tasks $task)
    {
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\TasksRequest  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TasksRequest $request, $id)
    {
        $data = $request->getData();

        $project = Tasks::findOrFail($id);
        $project->update($data);

        return redirect()->route('tasks.index')
            ->with('success_message', 'Task was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $project = Tasks::findOrFail($id);
        $project->delete();

        return redirect()->back()
            ->with('success_message', 'Task was successfully deleted.');
    }


    public function starttimer(Request $request)
    {
        $data = $request->all();
        $data['start_time'] = date("Y-m-d H:i:s");

        TimeTracker::create($data);

        return true;
    }

    public function stoptimer(Request $request){
        $tracker = TimeTracker::find($request->task_id)->latest()->first();
        if ($tracker->stop_time == null){
            if ($tracker->is_paused == 1){
                $pause = Pauses::where('tracker_id',$tracker->id)->latest()->first();
                $pause->update([
                    'start_time' => date("Y-m-d H:i:s")
                ]);
            }
            $tracker->update([
                'stop_time' => date("Y-m-d H:i:s"),
                'is_paused' => 0
            ]);
        }
        else{
            return 'No time tracker is running';
        }

        return true;
    }

    public function pausetimer(Request $request){
        $tracker = TimeTracker::find($request->task_id)->latest()->first();
        if ($tracker->stop_time == null){
            $tracker->update([
                'is_paused' => 1
            ]);

            Pauses::create([
                'tracker_id' => $tracker->id,
                'pause_time' => date("Y-m-d H:i:s")
            ]);
        }
        else{
            return 'No time tracker is running';
        }
        return true;
    }
}
