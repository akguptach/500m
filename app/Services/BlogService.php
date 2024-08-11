<?php

namespace App\Services;

use App\Models\Blog;

/**
 * Class BlogService.
 */
class BlogService
{
    public function getBlogs()
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value'])) {
            $keyword = $_GET['search']['value'];
            $query = Blog::where('blog_title', 'LIKE', '%' . $_GET['search']['value'] . '%')
            ->orWhereHas('website', function($q1) use ($keyword) {
                $q1->where('website_type', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('category',function($q2) use ($keyword) {
            $q2->where('category_name', 'LIKE', '%' . $keyword . '%');
            })
            ;
            
            
            $req_record['data'] = $query->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get();

            $blogQuery = Blog::where('blog_title', 'LIKE', '%' . $_GET['search']['value'] . '%');
            $blogs = $blogQuery->orderBy('id', 'desc')->get();

        } else {
            $req_record['data'] = Blog::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get();
            $blogs = Blog::orderBy('id', 'desc')->get();
        }
        if (!empty($blogs))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($blogs);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $blog) {
                $edit_page = 'blog/' . $blog['id'] . '/edit';
                $del_page = route('blog.destroy', ['blog' => $blog['id']]);

                $req_blog_id = '"' . $blog['id'] . '"';
                $req_record['data'][$i]['website_type'] = $blog->website->website_type;
                $req_record['data'][$i]['category_name'] = $blog->category->category_name;
                $req_record['data'][$i]['action'] = "<a class='fas fa-edit' class='btn btn-xs sharp btn-primary' href='" . url($edit_page) . "' ><i  title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='btn btn-xs sharp btn-danger' onclick='delete_blog(" . $del_msg . "," . $req_blog_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='blog_form_" . $blog['id'] . "'>
                        <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $blog['id'] . "'>
                    </form>";

                $i++;
            }
        }
        return $req_record;
    }

    public function save($request, $id = null)
    {
        
        if ($id) {
            $blog               =   Blog::find($id);
            $blog->blog_title   =   $request->blog_title;

            $blog->blog_sku = str_replace(' ','-', $request->blog_title);

            $blog->category_id  =   $request->category_id;
            $blog->website_id   =   $request->website_id;
            $blog->blog_date    =   date('Y-m-d', strtotime($request->blog_date));
            if (!empty($request->file('blog_image'))) {
               
                $this->remove_img($blog->blog_image);
                $image              =   $request->file('blog_image');
                $imageUrl           =   $this->upload_img($image);
                $blog->blog_image   =   $imageUrl;
            }
            $blog->blog_description    =   $request->blog_description;
            $blog->save();
        } else {

            $image              =   $request->file('blog_image');
            $imageUrl           =   $this->upload_img($image);
            $blog               =   new Blog();
            $blog->blog_title   =   $request->blog_title;
            $blog->blog_sku = str_replace(' ','-', $request->blog_title);
            $blog->website_id   =   $request->website_id;
            $blog->category_id  =   $request->category_id;
            $blog->blog_image   =   $imageUrl;
            $blog->blog_date    =   date('Y-m-d', strtotime($request->blog_date));
            $blog->blog_description    =   $request->blog_description;
            $blog->save();
        }
    }



    private function remove_img($blog_img)
    {
        try{
        unlink(public_path($blog_img));
        }catch(\Exception $e){

        }
        return true;
    }
    private function upload_img($image)
    {
        try{
        $imageName          =   time() . '.' . $image->extension();
        $image->move(public_path('images/blog'), $imageName);
        $imageUrl           =   'images/blog/' . $imageName;
        }catch(\Exception $e){
            echo $e; die;
        }
        return $imageUrl;
    }
}
