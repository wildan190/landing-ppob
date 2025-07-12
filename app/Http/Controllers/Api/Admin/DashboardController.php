<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Logika untuk mendapatkan data dashboard
        // Misalnya, jumlah kategori, jumlah postingan, dll.
        
        $data = [
            'total_categories' => \App\Models\Category::count(),
            'total_posts' => \App\Models\Post::count(),
            // Tambahkan data lain sesuai kebutuhan
        ];

        return response()->json($data);
    }
}
