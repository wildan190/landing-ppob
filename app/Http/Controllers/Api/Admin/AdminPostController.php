<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->paginate(5);
        return response()->json($posts);
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('picture_upload')) {
            $file = $request->file('picture_upload');
            $path = $file->store('posts', 'public');
            $data['picture_upload'] = $path;
        }

        $post = Post::create($data);

        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::with('category')->findOrFail($id);
        return response()->json($post);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('picture_upload')) {
            if ($post->picture_upload && Storage::disk('public')->exists($post->picture_upload)) {
                Storage::disk('public')->delete($post->picture_upload);
            }

            $path = $request->file('picture_upload')->store('posts', 'public');
            $data['picture_upload'] = $path;
        }

        $post->update($data);

        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->picture_upload && Storage::disk('public')->exists($post->picture_upload)) {
            Storage::disk('public')->delete($post->picture_upload);
        }

        $post->delete();

        return response()->json(null, 204);
    }
}
