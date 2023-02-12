<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User list') }}
        </h2>
    </x-slot>


    <div class="panel panel-default">
        <div class="panel-header">
            <a href="#" onclick="downloadpdf()">Download pdf</a>
            <a href="{{ route('mail.report',$id) }}">Mail report</a>
        </div>
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

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

    <script>

        function downloadpdf(){
            var pdf = new jsPDF('p', 'pt', 'letter');

            // add HTML content to PDF
            pdf.fromHTML($('#pdf')[0], 15, 15, {
                'width': 170
            });

            // download the PDF
            pdf.save('report.pdf');
        }
    </script>
</x-app-layout>
