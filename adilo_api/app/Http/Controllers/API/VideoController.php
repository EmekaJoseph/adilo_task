<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobs\ProcessVideo;

class VideoController extends Controller
{
    // GET /api/videos
    public function index(Request $req)
    {
        $videos = Video::select(['description', 'id', 'title', 'url'])->where('category_id', $req->category_id)->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $videos
        ]);
    }

    // GET /api/videos/{id}
    public function show($id)
    {
        $video = Video::with(['user', 'category'])->find($id);

        if (!$video) {
            return response()->json(['success' => false, 'message' => 'Video not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $video]);
    }

    // POST /api/videos
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $video = Video::create($request->all());

        // dispatch queue
        ProcessVideo::dispatch($video);

        return response()->json(['success' => true, 'data' => $video], 201);
    }

    // PUT /api/videos/{id}
    public function update(Request $request, $id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json(['success' => false, 'message' => 'Video not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'sometimes|required|url',
            'user_id' => 'sometimes|required|exists:users,id',
            'category_id' => 'sometimes|required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $video->update($request->all());

        return response()->json(['success' => true, 'data' => $video]);
    }
}
