@extends('layout')

@section('content')
    <div class="jumbotron">
        <h1>Submit a Video</h1>
        <p>Currently we only accept Nest.com videos.</p>
        <p>If you want the video attached to you as the submitter, please <a href="{{ route('login') }}">log in</a> first.</p>
    </div>

    @isset($error_message)
        <p><strong>{{ $error_message }}</strong></p>
    @endisset

    <div class="row">
        <div class="form-group-lg has-feedback">
            <div class="col-sm-2">
                <label class="control-label" for="id">URL of video</label>
            </div>
            <div class="col-sm-10">
                <input name="id" id="id" class="form-control" placeholder="https://video.nest.com/clip/ ..." value="">
                <div class="text-center">
                    <p id="spinner" style="display: none;"><img src="/img/spinner.gif" height="180" width="180"/></p>
                    <div id="error" class="panel panel-danger" style="display: none;">
                        <div class="panel-heading">Error</div>
                        <div class="panel-body">
                            <p id="error-details"></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('inlinescripts')
    <script>
        var $error = $('#error');
        var $errorDetails = $('#error-details');
        var $spinner = $('#spinner');

        $('#id').on('input', function () {
            var $input = $(this);
            var url = $input.val();
            var id = url.match(/^https?:\/\/video.nest.com\/clip\/([a-f0-9]{32})/);
            if (id !== null) {
                // Hide the error details
                $error.hide();

                // Show the spinner
                $spinner.show();

                // Send to us to checkout the url
                $.get('/video-check',
                    {url: url},
                    function (data) {
                        if (typeof data.error !== 'undefined') {
                            // An error, oh no!
                            // Show the Error details
                            $errorDetails.html(data.error);
                            $error.show();

                            // Hide the spinner
                            $spinner.hide();
                        } else {
                            // Passed! Redirect to new video page
                            window.location = "/video/" + data.id;
                        }
                    });
            }
        });
    </script>
@endpush