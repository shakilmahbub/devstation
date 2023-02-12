<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
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

    <div class="panel panel-default">
        @if(auth()->user()->is_admin())
        <div class="btn-group btn-group-sm pull-right p-6" role="group">
            <a href="{{ route('projects.create') }}" class="btn btn-success" title="Create New Subject">
                Create new
            </a>
        </div>
        @endif
        @if(count($projects) == 0)
            <div class="panel-body text-center">
                <h4>No projects Available.</h4>
            </div>
        @else
        <div class="p-6 text-gray-900">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->author->name }}</td>
                            <td>

                                <form method="POST" action="{!! route('projects.destroy', $project->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('projects.show', $project->id ) }}" class="btn btn-info" title="Show project">
                                            Show
                                        </a>
                                        @if(auth()->user()->is_admin())
                                            <a href="{{ route('projects.edit', $project->id ) }}" class="btn btn-primary" title="Edit project">
                                                Edit
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete project" onclick="return confirm(&quot;Click Ok to delete project.&quot;)">
                                                Delete
                                            </button>
                                        @endif
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
            {!! $projects->render() !!}
        </div>

        @endif

    </div>
</x-app-layout>
