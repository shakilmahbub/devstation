<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User list') }}
        </h2>
    </x-slot>


    <div class="panel panel-default">
        <div class="panel-header">
            <a class="start" href="#">Start</a>
            <a class="pause" href="#">Pause</a>
            <a class="stop" href="#">Stop</a>
            <a href="#">View report</a>
        </div>
        <div class="panel-body">
            <h1>New sasson</h1>
            <dl class="dl-horizontal">
                @foreach($timetrackers as $tracker)
                    <dt>Start time</dt>
                    <dd>{{ $tracker->start_time }}</dd>
                    <dt>Stop time</dt>
                    <dd>{{ $tracker->stop_time }}</dd>
                    <dt>Location</dt>
                    <dd>{{ $tracker->location }}</dd>
                    @if($tracker->pause)
                        <h3>Pauses</h3>
                        @foreach($tracker->pause as $pause)
                            Start : {{ $pause->pause_time }}
                            End : {{ $pause->	start_time }}
                            <br />
                        @endforeach
                    @endif
                @endforeach
            </dl>
        </div>
    </div>
</x-app-layout>
