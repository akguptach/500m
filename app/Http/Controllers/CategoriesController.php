<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            if(!empty($_GET['search']['value'])){
                $req_record['data'] = Categories::where('category_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $categories = Categories::where('category_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->get()->toArray();
            }
            else{
                $req_record['data'] = Categories::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $categories = Categories::orderBy('id', 'desc')->get()->toArray();

            }
            if(!empty($categories))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($categories);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $category){
                    $edit_category = 'categories/'.$category['id'].'/edit';                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_category)."' ><i class='fas fa-edit' title='Edit'></i></a>";
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('categories/view');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|min:2|unique:categories,category_name',
        ]);
        if($validator->fails()){
            return redirect('categories/create')->withErrors($validator)->withInput();     
        }
        $categories                 = new Categories();
        $categories->category_name  = $request->category_name;
        $categories->save();
        return redirect('/categories')->with('status', 'Category Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datas = Categories::find($id);
        return view('categories/edit',array('formAction' => route('categories.update', ['categories' => $id]),'data'=>$datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|min:2|unique:categories,category_name,'.$id,
        ]);
        if($validator->fails()){
            return redirect('categories/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        $categories = Categories::find($id);
        $categories->category_name = $request->category_name;
        $categories->save();
        return redirect('/categories')->with('status', 'Category Updated Successfully');
    }
}
