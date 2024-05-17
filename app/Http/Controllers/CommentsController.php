<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use App\Http\Resources\CommentsResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::with('users')->get();
        return CommentsResource::collection($comments);
    }
    public function store(CommentsRequest $request)
    {
        $comments['user_id'] = Auth::id();
        $comments = Comment::create($request->validated());

        return response()->json([
            'message' => 'comment created successfully',
            'comments' => new CommentsResource($comments)
        ]);
    }
    public function update(UpdateCommentsRequest $request, Comment $comment)
    {

        $comment->update($request->validated());

        return response()->json([
            'message' => 'Comment updated successfully',
            'comment' => new CommentsResource($comment)
        ]);
    }
    public function destoy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'message' => 'Comments deleted successfully'
        ], 204);
    }
}
