<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::with('category');

        // Search (judul atau isi)
        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori (category_id)
        if ($categoryId = request('category_id')) {
            $query->where('category_id', $categoryId);
        }

        // Paginate
        $posts = $query->paginate(10);

        // Ambil semua kategori (untuk kebutuhan filter di frontend)
        $categories = \App\Models\Category::all();

        return response()->json([
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * Menampilkan artikel berdasarkan slug.
     */
    public function showArticle($slug)
    {
        // Mencari post berdasarkan slug
        $post = Post::with('category')->where('slug', $slug)->first();

        // Cek apakah artikel ditemukan
        if ($post) {
            return response()->json([
                'post' => $post,
            ]);
        } else {
            // Jika artikel tidak ditemukan, return 404
            return response()->json([
                'message' => 'Artikel tidak ditemukan.',
            ], 404);
        }
    }
}
