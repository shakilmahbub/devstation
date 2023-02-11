<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User list') }}
        </h2>
    </x-slot>


    <div class="panel panel-default">
        <div class="panel-header">
            <a href="{{ route('tasks.create',$project->id) }}">Add task</a>
        </div>
        <div class="panel-body">
            <dl class="dl-horizontal">
                <dt>Title</dt>
                <dd>{{ $project->title }}</dd>
                <dt>Details</dt>
                <dd>{{ $project->details }}</dd>
            </dl>
        </div>
    </div>

</x-app-layout>
