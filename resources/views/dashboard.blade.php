<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(auth()->user()->is_admin())
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Employee</th>
                                <th>Project</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->assignto->name }}</td>
                                    <td>{{ $task->project->title }}</td>
                                    <td>
                                        @foreach($task->timeTracker as $tracker)
                                            Start : {{ $tracker->start_time }} <br />
                                            Stop : {{ $tracker->stop_time }} <br />
                                            Location : {{ $tracker->location }} <br />
                                            @if($tracker->pause)
                                                @foreach($tracker->pause as $pause)
                                                    Pause : {{ $pause->pause_time }} Resume : {{ $pause->start_time }}
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="p-6 text-gray-900">
                        <p>Welcome to dashboard</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
