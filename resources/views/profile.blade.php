@extends('layout')

@section('content')
    <div class="jumbotron">
        <p>User</p>
        <h1>{{ $user->name }}</h1>
    </div>

    <div>
        @if($user->videos->count() > 0)
            Submitted videos:
            <ul>
                @foreach($user->videos as $video)
                    <li><a href="{{ route('video', ['video' => $video->id]) }}">{{ $video->title }}</a></li>
                @endforeach

            </ul>
        @else
            <em>This user has not submitted any videos yet.</em>
        @endif
    </div>
@endsection
