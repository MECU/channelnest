<?php

namespace App\Http\Controllers;

use App\Type;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function videoSubmit()
    {

        return view('videoSubmit');
    }

    public function video(Video $video)
    {

        return view('video', ['video' => $video]);
    }

    public function videoCheck(Request $request)
    {
        $videoURL = $request->get('url');

        $matched = preg_match('/^https:\/\/video.nest.com\/clip\/([a-f0-9]{32})/', $videoURL, $matches);
        if ($matched === 0) {
            return response()->json([
                'error' => "That doesn't appear to be a valid URL",
                'matches' => $matches,
                'url' => $videoURL,
            ]);
        }

        // See if we already have it
        $video = Video::where('video_id', $matches[1])->first();

        if ($video !== null) {
            return response()->json([
                'error' => 'We already have this video.',
            ]);
        }

        // See if it exists at Nest
        $handle = curl_init($videoURL);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_NOBODY, true);

        $response = curl_exec($handle);

        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            return response()->json([
                'error' => 'That URL does not seem to exist or I had a problem retrieving it.',
            ]);
        }

        // We got one!
        $type = Type::find(1); // TODO: Need to change type based on URL submitted
        $video = new Video;

        $video->video_id = $matches[1];
        $video->title = 'TBD';
        $video->type_id = $type->id;
        $video->created_at = \Carbon\Carbon::create(); // TODO: Do I need to do this?

        if (!\Auth::guest()) {
            $video->submit_user = \Auth::user()->id;
        }

        # Get the page proper to get the title
        curl_setopt($handle, CURLOPT_NOBODY, false);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            return response()->json([
                'error' => 'The header check passed, but I could not get the page. Um...',
            ]);
        }

        curl_close($handle);

        $matched = preg_match('/\<title\>(.*)\<\/title\>/', $response, $rawTitle);
        if ($matched !== 1) {
            // TODO: Can we handle this more gracefully?
            return response()->json([
                'error' => 'I could not figure out a title.',
            ]);

        }
        $title = $rawTitle[1];
        $title = str_replace(' | Nest', '', $title);
        $video->title = $title;

        $video->save();

        return response()->json([
            'success' => 'It worked!',
            'id' => $video->id,
        ]);
    }
}
