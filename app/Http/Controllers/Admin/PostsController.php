<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Image;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Exports\PostsExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Admin\PostFormRequest;

class PostsController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function add() {
        $categories = Category::where('status' ,'1')->get();
        $tags = Tag::all();
        return view('admin.post.add-post', compact('categories', 'tags'));
    }

    public function create(PostFormRequest $request) {
        
        $data = $request->validated();
        /*
        $post = new Post;
        $post->category_id = $data['category_id'];
        $post->title = $data['title'];
        $post->slug = Str::slug($data['slug']);
        */
        // Upload image 
        $filename = "default.jpg";
        if($request->hasfile('image')) {

            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();

            // Generate Small Thumbnail 100px
            $pathSmallThumb = public_path('uploads/posts/thumbnail/small');
            $img = Image::make($file->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathSmallThumb.'/'.$filename);

            // Generate Medium Thumbnail 368px
            $pathMediumThunmb = public_path('uploads/posts/thumbnail/medium');
            $img = Image::make($file->path());
            $img->resize(368, 368, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathMediumThunmb.'/'.$filename);

            // Original Image
            $file->move('uploads/posts/', $filename);
            //$post->image = $filename;
            
        }

        /*
        $post->content = $data['content'];
        $post->meta_keyword = $data['meta_keyword'];
        $post->meta_description = $data['meta_description'];
        $post->status = $data['status'];
        $post->created_by = Auth::user()->id;
        */
      
        Post::create([
            'title'             => $request->title,
            'slug'              => Str::slug($data['slug']),
            'content'           => $request->content,
            'category_id'       => $request->category_id,
            'image'             => $filename,
            'meta_keyword'      => $request->meta_keyword,
            'meta_description'  => $request->meta_description,
            'status'            => $request->status,
            'created_by'        => Auth::user()->id
        ])->tag()->attach($request->tag);

       // $post->save();

        // Add to log
        \LogActivity::addToLog("New post created");
        return redirect('admin/posts')->with('message','Post has been successfuly created');

    }

    public function delete($id) {

        $post = Post::find($id);

        $originalDestination = 'uploads/posts/'.$post->image;
        $mediumDestination = 'uploads/posts/thumbnail/medium/'.$post->image;
        $smallDestination = 'uploads/posts/thumbnail/small/'.$post->image;
        
        if(File::exists($originalDestination)) {
            File::delete($originalDestination);
        }
        if(File::exists($mediumDestination)) {
            File::delete($mediumDestination);
        }
        if(File::exists($smallDestination)) {
            File::delete($smallDestination);
        }

        $post->delete();
        \LogActivity::addToLog("Delete post");
       // return redirect('admin/posts')->with('message','Post has beenn deleted');
    }

    public function deleteall(Request $request){
        $posts = Post::whereIn('id', $request->ids);
        $posts->delete();
    }

    public function edit($id) {

        $post = Post::find($id);
        $tags = Tag::all();
        $categories = Category::where('status','1')->get();
        return view('admin.post.edit-post', compact('post','categories','tags'));
    }

    public function update(PostFormRequest $request, $id) {
        
        $data = $request->validated();

        $post = Post::find($id);
        $post->category_id = $data['category_id'];
        $post->title = $data['title'];
        $post->slug = Str::slug($data['slug']);

        if($request->hasfile('image')) {

            $originalDestination = 'uploads/posts/'.$post->image;
            $mediumDestination = 'uploads/posts/thumbnail/medium/'.$post->image;
            $smallDestination = 'uploads/posts/thumbnail/small/'.$post->image;
            
            if(File::exists($originalDestination)) {
                File::delete($originalDestination);
            }
            if(File::exists($mediumDestination)) {
                File::delete($mediumDestination);
            }
            if(File::exists($smallDestination)) {
                File::delete($smallDestination);
            }

            
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();

            // Generate Small Thumbnail 100px
            $pathSmallThumb = public_path('uploads/posts/thumbnail/small');
            $img = Image::make($file->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathSmallThumb.'/'.$filename);

            // Generate Medium Thumbnail 368px
            $pathMediumThunmb = public_path('uploads/posts/thumbnail/medium');
            $img = Image::make($file->path());
            $img->resize(368, 368, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pathMediumThunmb.'/'.$filename);

            // Original Image
            $file->move('uploads/posts/', $filename);
            $post->image = $filename;
            

        }

        $post->content = $data['content'];
        $post->meta_keyword = $data['meta_keyword'];
        $post->meta_description = $data['meta_description'];
        $post->status = $data['status'];
        $post->created_by = Auth::user()->id;
        $post->save();
        $post->tag()->sync($request->tag);

        \LogActivity::addToLog("Update post");

        return redirect('admin/posts')->with('message', 'Post updated successfuly');

    }


    /**
     * Functions for export files : doc, pdf, xls, json 
     */
    public function exportXlsx() {

        return Excel::download(new PostsExport, 'posts.xlsx');
    }

    public function exportPdf() {

        $posts = Post::all();
        $pdf = PDF::loadView('admin.post.pdf', compact('posts'));
        return $pdf->download('posts.pdf');
    }

    public function exportDoc() {

        $posts = Post::all();
        return view('admin.post.doc', compact('posts'));
    
    }

    public function getjson() {

        $posts = Post::all();
        return Response()->json($posts);
    }
}
