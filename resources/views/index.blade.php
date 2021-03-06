@extends('layout')

@section('content')
    <div class="jumbotron">
        <h1><img src="/img/logo.png" height="100" width="100" alt="ChannelNest Logo"/>
            <span class="cn-blue">ChannelNest</span></h1>
        <p>See, share, discuss, catalog surveillance videos.</p>
    </div>

    <h2>Most Recently Added ...</h2>

    <div class="row" style="background-color: #add8e6">
        @foreach($videos as $video)
            <div class="col-md-4" style="padding-top:20px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $video->title }}</h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            <a href="{{ route('video', ['id' => $video->id]) }}">
                                <img src="https://clips.dropcam.com/{{ $video->video_id }}.jpg"
                                     class="img img-responsive"/>
                            </a>
                        </p>
                    </div>
                    <div class="panel-footer">
                        <p>
                            <small><em>{{ $video->created_at->format('c') }} UTC</em></small>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
