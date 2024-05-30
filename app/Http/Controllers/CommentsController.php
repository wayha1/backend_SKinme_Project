<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use App\Http\Resources\CommentsResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        // Assuming you are passing the product ID as a query parameter
        $productId = $request->query('product_id');

        // Fetching comments related to the current product and including user information
        $comments = Comment::where('product_id', $productId)
                           ->with('users')
                           ->with('products')
                           ->get();

        return CommentsResource::collection($comments);
    }

    public function store(CommentsRequest $request)
    {
        $commentsData = $request->validated();
        $commentsData['user_id'] = Auth::id();
        $comments = Comment::create($commentsData);

        return response()->json([
            'message' => 'Comment created successfully',
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

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully'
        ], 204);
    }
}
