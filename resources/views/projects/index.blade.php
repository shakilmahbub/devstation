<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User list') }}
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

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Projects</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('projects.create') }}" class="btn btn-success" title="Create New Subject">
                    Create new
                </a>
            </div>

        </div>

        @if(count($projects) == 0)
            <div class="panel-body text-center">
                <h4>No projects Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
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
                                        <a href="{{ route('projects.edit', $project->id ) }}" class="btn btn-primary" title="Edit project">
                                            Edit
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete project" onclick="return confirm(&quot;Click Ok to delete project.&quot;)">
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
            {!! $projects->render() !!}
        </div>

        @endif

    </div>
</x-app-layout>
