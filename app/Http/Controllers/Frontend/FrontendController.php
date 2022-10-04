<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function categories() {
        return Category::where('status', 1)->get();
    }
    public function index() {

        $categories = $this->categories();

        $latest_posts = Post::where('status', 1)->orderBy('created_at','DESC')->get()->take(3);
        return view('frontend.index', compact('latest_posts', 'categories'));
    }

    public function viewCategoryPost(string $category_slug) {

        $categories = $this->categories();
        $category = Category::where('slug', $category_slug)->where('status', 1)->first();

        if($category) {
            $posts = Post::where('category_id', $category->id)->where('status',1)->paginate(3);
            return view('frontend.post.index', compact('category','posts', 'categories'));
        } else {
            
            return view('errors.404');
        }
    }

    public function viewPost(string $category_slug, string $post_slug) {

        $categories = $this->categories();
        $category = Category::where('slug', $category_slug)->where('status', 1)->first();
    
        if($category) {
            $post = Post::where('category_id', $category->id)->where('slug',$post_slug)->where('status', 1)->first();
            if($post) {
                return view('frontend.post.view', compact('post','categories'));
            } else {
                return view('errors.404');
            }
            
        } else {

            return view('errors.404');
        }
    }

    

}
