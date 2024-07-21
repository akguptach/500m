<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\Categories;
use App\Models\Website;
use Illuminate\Support\Facades\File;



use App\Services\BlogService;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{


    public function __construct(protected BlogService $blogService)
    {
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->blogService->getBlogs());
        } else {
            return view('blog/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Categories::all();
        $data['websites']   = Website::all();
        return view('blog/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $this->blogService->save($request);
        return redirect('/blog')->with('status', 'Blog Created Successfully');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Categories::all();
        $datas = Blog::find($id);
        $websites   = Website::all();
        return view('blog/edit', array('formAction' => route('blog.update', ['blog' => $id]), 'data' => $datas, 'categories' => $categories, 'websites' => $websites));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        $this->blogService->save($request, $id);
        return redirect('/blog')->with('status', 'Blog Updated Successfully');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        if (!empty($blog)) {
            $this->remove_img($blog->blog_image);
            $blog->delete();
            return redirect('/blog')->with('status', 'Blog Deleted Successfully');
        } else {
            return redirect('/blog');
        }
    }

    public function remove_img($imageurl)
    {
        if (File::exists($imageurl)) {
            File::delete($imageurl);
        }
    }
}
