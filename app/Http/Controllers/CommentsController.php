<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Http\Resources\CommentsResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::with('users')->get();
        return CommentsResource::collection($comments);
    }
    public function store(CommentsRequest $request){
        $comments['user_id'] = Auth::id();
        $comments = Comment::create($request->validated());

        return response()->json([
            'message' => 'comment created successfully',
            'comments' => new CommentsResource($comments)
        ]);
    }
    public function update(){
        
    }
    public function destoy(Comment $comment){
        $comment->delete();
        return response()->json([
            'message' => 'Comments deleted successfully'
        ], 204);
    }
}
