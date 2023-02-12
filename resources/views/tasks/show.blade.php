<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>


    <div class="p-6 text-gray-900 bg-white">
        <div class="panel-header" style="text-align: right;">
            <a class="start btn btn-info" href="#">Start</a>
            <a class="pause btn btn-info" style="display: none;" href="#">Pause</a>
            <a class="resume btn btn-info" style="display: none;" href="#">Resume</a>
            <a class="stop btn btn-info" style="display: none;" href="#">Stop</a>
            <a class="btn btn-info" href="{{ route('tasks.report', $task->id) }}">View report</a>
        </div>
        <div class="panel-body">
            <dl class="dl-horizontal">
                <dt>Title</dt>
                <dd>{{ $task->title }}</dd>
                <dt>Details</dt>
                <dd>{{ $task->details }}</dd>
            </dl>
        </div>
        <input type="hidden" id="location">
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script>
        var lat;
        var long;
        $(document).ready(function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    lat = position.coords.latitude;
                    long = position.coords.longitude;
                });
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        });
        $(".start").click(function(){
            $(this).hide();
            $('.stop').show();
            $('.pause').show();
            var taskid = {{ $task->id }};
            var location = lat+','+long;
            $.post("{{ route('starttimer') }}",
                {
                    task_id: taskid,
                    location: location,
                    "_token": "{{ csrf_token() }}"

                },
                function(data, status){
                    console.log(data);
                    screenshot();
                });
        });

        $(".stop").click(function(){
            $(this).hide();
            $('.start').show();
            var taskid = {{ $task->id }};
            $.post("{{ route('stoptimer') }}",
                {
                    task_id: taskid,
                    "_token": "{{ csrf_token() }}"

                },
                function(data, status){
                    console.log(data);
                    screenshot();
                });
        });

        $(".pause").click(function(){
            $(this).hide();
            $('.resume').show();
            var taskid = {{ $task->id }};
            $.post("{{ route('pausetimer') }}",
                {
                    task_id: taskid,
                    "_token": "{{ csrf_token() }}"

                },
                function(data, status){
                    screenshot();
                });
        });

        $(".resume").click(function(){
            var taskid = {{ $task->id }};
            $.post("{{ route('resumetimer') }}",
                {
                    task_id: taskid,
                    "_token": "{{ csrf_token() }}"

                },
                function(data, status){
                    screenshot();
                });
        });

        function screenshot(){
            html2canvas(document.body, {
                onrendered: function(canvas) {
                    // Canvas is the screenshot of the page
                    // You can save it as an image using canvas.toDataURL() method
                    var screenshot = canvas.toDataURL();
                    // Save the screenshot
                    downloadImage(screenshot, "screenshot.png");
                }
            });
        };

        function downloadImage(data, filename) {
            var a = document.createElement("a");
            a.href = data;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
        }

        function showPosition(position) {
            position.coords.latitude + position.coords.longitude;
        }
    </script>
</x-app-layout>
