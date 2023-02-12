<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="p-6 text-gray-900 bg-white">
        @if(count($tasks) == 0)
            <div class="panel-body text-center">
                <h4>No Tasks Available.</h4>
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
                    @foreach($tasks as $task)
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

        <div class="panel-footer">
            {!! $tasks->render() !!}
        </div>

        @endif

    </div>
</x-app-layout>
