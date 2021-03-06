@extends('layout')

@section('content')
    <link href="//vjs.zencdn.net/5.19.2/video-js.css" rel="stylesheet">

    <div class="jumbotron">
        <h1>{{ $video->title }}</h1>
        @if($video->submitter !== null)
            <p>Submited by <a href="{{ route('profile', ['user' => $video->submitter->id, 'username' => $video->submitter->slug()]) }}">{{ $video->submitter->name }}</a></p>
        @endif
    </div>
    <div class="videocontent" style="background-color: #1b6d85">
        <video class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" preload="auto" controls
               data-setup='{"fluid": true}'
               src="https://clips.dropcam.com/{{ $video->video_id }}.mp4">
            <source src="https://clips.dropcam.com/{{ $video->video_id }}.mp4" type="video/mp4">
            <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a web browser that
                <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
            </p>
        </video>
    </div>
    // Tags

    <div id="disqus_thread"></div>
    <script>
        var disqus_config = function () {
            this.page.url = 'https://channelnest.com/video/{[ $video->id }}';  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = '{[ $video->id }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://channelnest.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the comments powered by Disqus.</noscript>

    <script src="//vjs.zencdn.net/5.19.2/video.js"></script>
    <script id="dsq-count-scr" src="//channelnest.disqus.com/count.js" async></script>
@endsection
