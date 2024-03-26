<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use App\Models\Categories;
use App\Models\WebsiteModel;
use Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            if(!empty($_GET['search']['value'])){
                $req_record['data'] = Blog::where('blog_title','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $blogs = Blog::where('blog_title','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->get()->toArray();
            }
            else{
                $req_record['data'] = Blog::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $blogs = Blog::orderBy('id', 'desc')->get()->toArray();

            }
            if(!empty($blogs))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($blogs);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $blog){
                    $edit_page = 'blog/'.$blog['id'].'/edit';
                    $del_page = route('blog.destroy', ['blog' => $blog['id']]);
                    
                    $req_blog_id = '"'.$blog['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_blog(".$del_msg.",".$req_blog_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='blog_form_".$blog['id']."'>
                        <input type='hidden' value='".csrf_token() ."'  id='csrf_".$blog['id']."'>
                    </form>";
                    
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('blog/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Categories::all();
        $data['websites']   = WebsiteModel::all();
        return view('blog/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_title' => 'required|unique:blog,blog_title',
            'category_id' => 'required',
            'website_id' => 'required',
            'blog_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'blog_date' => 'required',
            'blog_description' => 'required',
        ]);
        if($validator->fails()){
            return redirect('blog/create')->withErrors($validator)->withInput();     
        }
        $image              =   $request->file('blog_image');
        $imageUrl           =   $this->upload_img($image);

        $blog               =   new Blog();
        $blog->blog_title   =   $request->blog_title;
        $blog->website_id   =   $request->website_id;
        $blog->category_id  =   $request->category_id;
        $blog->blog_image   =   $imageUrl;
        $blog->blog_date    =   date('Y-m-d',strtotime($request->blog_date));
        $blog->blog_description    =   $request->blog_description;
        $blog->save();
        return redirect('/blog')->with('status', 'Blog Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Categories::all();
        $datas = Blog::find($id);
        $websites   = WebsiteModel::all();
        return view('blog/edit',array('formAction' => route('blog.update', ['blog' => $id]),'data'=>$datas,'categories'=>$categories,'websites'=>$websites));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'blog_title' => 'required|unique:blog,blog_title,'.$id,
            'category_id' => 'required',
            'website_id' => 'required',
            'blog_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'blog_description' => 'required',
            'blog_date' => 'required',
        ]);
        if($validator->fails()){
            return redirect('blog/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        
        $blog               =   Blog::find($id);
        $blog->blog_title   =   $request->blog_title;
        $blog->category_id  =   $request->category_id;
        $blog->website_id   =   $request->website_id;
        $blog->blog_date    =   date('Y-m-d',strtotime($request->blog_date));

        if(!empty($request->file('blog_image'))){
            $this->remove_img($blog->blog_image);
            $image              =   $request->file('blog_image');
            $imageUrl           =   $this->upload_img($image);
            $blog->blog_image   =   $imageUrl;
        }
        
        $blog->blog_description    =   $request->blog_description;
        $blog->save();
        return redirect('/blog')->with('status', 'Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        if(!empty($blog)){
           $this->remove_img($blog->blog_image);
            $blog->delete();
            return redirect('/blog')->with('status', 'Blog Deleted Successfully');
        }
        else{
            return redirect('/blog');
        }
    }
    private function remove_img($blog_img){
        unlink(public_path($blog_img));
        return true;
    }
    private function upload_img($image){
        $imageName          =   time().'.'.$image->extension();
        $image->move(public_path('images/blog'), $imageName);
        $imageUrl           =   'images/blog/'.$imageName;
        return $imageUrl;
    }
}
