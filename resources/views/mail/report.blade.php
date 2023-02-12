<div class="panel panel-default">
    <div class="panel-body" id="pdf">
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
