<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Traits\HandleResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use HandleResponse;

    protected $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function store(CreateCommentRequest $request, $post_id)
    {
        $post = Post::find($post_id);

        if (!$post) {
            return $this->badRequestResponse("Post not found");
        }

        $this->model->create([
            'comment' => $request->comment,
            'post_id' => $post_id,
            'user_id' => auth()->user()->id,
        ]);

        return $this->successMessage("Comment created successfully");
    }
}
