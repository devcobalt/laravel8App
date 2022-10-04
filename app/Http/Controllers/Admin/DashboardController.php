<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {

        $posts = Post::count();
        $categories = Category::count();
        $onlinePosts = Post::where('status', 1)
                            ->wheredate('created_at', '2022-09-03')->count();
        $offlinePosts = Post::where('status', 0)->count();

        return view('admin.dashboard', compact('onlinePosts','offlinePosts', 'posts', 'categories'));
    }

}
