<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequests\CreatePostRequest;
use App\Http\Requests\PostRequests\UpdatePostRequest;
use App\Models\Post;
use App\Traits\HandleResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use HandleResponse;

    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $query = $this->model->query();

        if ($request->filled('category')) {
            $query->where('category', 'like', '%' . $request->category . '%');
        }

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhere('title', 'like', '%' . $request->search)
                ->orWhere('category', 'like', '%' . $request->search);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            if (!\Carbon\Carbon::hasFormat($startDate, 'Y-m-d') || !\Carbon\Carbon::hasFormat($endDate, 'Y-m-d')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid date format. Please use YYYY-MM-DD.'
                ], 400);
            }

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Paginate the results
        $paginatedPosts = $query->paginate($this->pagination);

        // Return the response with paginated posts
        return $this->successWithData($paginatedPosts, "Posts Data");
    }


    public function show($id)
    {
        $post = $this->model->with(['user','comments'])->find($id);

        return $post
            ? $this->successWithData($post, 'Show Post Details')
            : $this->badRequestResponse('Post not found');
    }

    public function store(CreatePostRequest $request)
    {
        $post = $this->model->create($request->validated() + ['user_id' => auth()->id()]);

        return $this->createdResponse($post, 'Post created successfully');
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->findPostForCurrentUser($id);

        if (!$post) {
            return $this->badRequestResponse('Post not found');
        }

        $post->update($request->validated());

        return $this->successMessage('Post updated successfully');
    }

    public function destroy($id)
    {
        $post = $this->findPostForCurrentUser($id);

        if (!$post) {
            return $this->badRequestResponse('Post not found');
        }

        $post->delete();

        return $this->successMessage('Post deleted successfully');
    }

    /**
     * Find a post based on user role and post ID.
     */
    private function findPostForCurrentUser($id)
    {
        if (auth()->user()->role === 'author') {
            return $this->model->where('user_id', auth()->id())->find($id);
        }

        return $this->model->find($id);
    }
}
