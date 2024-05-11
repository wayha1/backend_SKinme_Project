<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoTrendingRequest;
use App\Http\Requests\UpdateVideoTrendingRequest;
use App\Http\Requests\VideoTrendingRequest;
use App\Http\Resources\VideoTrendingResource;
use App\Models\VideoTrending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VideoTrendingController extends Controller
{
    public function index()
    {
        $videos = VideoTrending::with('categories')->get();
        return VideoTrendingResource::collection($videos);
    }

    public function store(VideoTrendingRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();

        $videoTrending = VideoTrending::create($validatedData);
        return response()->json([
            'message' => 'Video trending created successfully', 
            'videoTrending' => new VideoTrendingResource($videoTrending)]);
    }

    public function update(UpdateVideoTrendingRequest $request, VideoTrending $videoTrending)
    {
        $validatedData = $request->validated();

        $videoTrending->update($validatedData);

        return response()->json([
        'message' => 'Video trending updated successfully', 
        'videoTrending' => new VideoTrendingResource($videoTrending)]);
    }

    public function destroy(VideoTrending $videoTrending)
    {
        $videoTrending->delete();
        return response()->json([
            'message' => 'Video trending deleted successfully'],
            204);
    }
}
