<x-app-layout>



    <div class="p-6 text-gray-900 bg-white">
        <div class="panel-header">
            <a class="btn btn-info" href="{{ route('users.invite.create',['project_id' => $project->id]) }}">Invite member</a>
        </div>
        <div class="panel-body">
            <dl class="dl-horizontal">
                <dt>Title</dt>
                <dd>{{ $project->title }}</dd>
                <dt>Details</dt>
                <dd>{{ $project->details }}</dd>
            </dl>
        </div>

        <div class="panel panel-default">

            <div class="panel-heading clearfix">

                <div class="pull-left">
                    <h4 class="mt-5 mb-5">Tasks</h4>
                </div>

                <div class="btn-group btn-group-sm pull-right" role="group">
                    <a href="{{ route('tasks.create',$project->id) }}" class="btn btn-success" title="Create New Subject">
                        Create new task
                    </a>
                </div>

            </div>

            @if(count($project->tasks) == 0)
                <div class="panel-body text-center">
                    <h4>No tasks Available.</h4>
                </div>
            @else
                <div class="panel-body panel-body-with-table">
                    <div class="table-responsive">

                        <table class="table table-striped ">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Assign to</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($project->tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->assignto->name }}</td>
                                    <td>

                                        <form method="POST" action="{!! route('tasks.destroy', $task->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('tasks.show', $task->id ) }}" class="btn btn-info" title="Show project">
                                                    Show
                                                </a>
                                                <a href="{{ route('tasks.edit', $task->id ) }}" class="btn btn-primary" title="Edit project">
                                                    Edit
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="Delete project" onclick="return confirm(&quot;Click Ok to delete task.&quot;)">
                                                    Delete
                                                </button>
                                            </div>

                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            @endif

        </div>
    </div>

</x-app-layout>
