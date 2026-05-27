<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('student')->latest()->get();
        return $this->renderAjaxOrView('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('student');
        return $this->renderAjaxOrView('posts.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully.',
                'redirect' => route('posts.index')
            ]);
        }

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
