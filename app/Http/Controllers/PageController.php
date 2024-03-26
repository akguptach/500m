<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\WebsiteModel;
use App\Models\Pages;
class PageController extends Controller{
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            if(!empty($_GET['search']['value'])){
                $req_record['data'] = Pages::where('page_title','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $pages = Pages::where('page_title','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->get()->toArray();
            }
            else{
                $req_record['data'] = Pages::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $pages = Pages::orderBy('id', 'desc')->get()->toArray();

            }
            if(!empty($pages))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($pages);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $page){
                    $edit_page = 'pages/'.$page['id'].'/edit';
					$delete_page = 'pages/'.$page['id'].'/delete';
                    
                    $req_page_id = '"'.$page['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_page(".$del_msg.",".$req_page_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action='".$delete_page." ' class='form-delete' id='page_form_".$page['id']."'><input type='hidden' value='".csrf_token() ."'  id='csrf_".$page['id']."'>

                    </form>";
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('pages/view');
        }
    }
    	 /**     * Show the form for creating a new resource.     */    
		 public function create(){
         $data['websites']   = WebsiteModel::all();			 
		 return view('pages/create',$data);    
		 }    
		 /**     * Store a newly created resource in storage.     */    
    public function store(Request $request){        
		 $validator = Validator::make($request->all(), [ 
			'page_title' => 'required|min:2|unique:pages,page_title',
			'page_desc' => 'required|min:2',
			'website_type' => 'required',
			'seo_title' => 'required|max:191|unique:pages,seo_title',
			'seo_url_slug' => 'required|max:191|unique:pages,seo_url_slug',
		 ]);
		 if($validator->fails()){  
			return redirect('pages/create')->withErrors($validator)->withInput();
		 }
		 $pages = new Pages(); 
		 $pages->page_title     = $request->page_title;
		 $pages->page_desc      = $request->page_desc;
		 $pages->seo_title      = $request->seo_title;
		 
		 $pages->seo_url_slug 	= Str::slug($request->seo_url_slug);
		 //$pages->seo_url_slug   = $request->seo_url_slug;
		 $pages->seo_description  = $request->seo_description;
		 $pages->seo_keywords    = $request->seo_keywords;
		 $pages->seo_meta        = $request->seo_meta;
		 $pages->status          = $request->status;
		 $pages->website_type          = $request->website_type;
		 
		 $pages->save();
		 return redirect('/pages')->with('status', 'Page Created Successfully');
    }
		 /**
		* Show the form for editing the specified resource.
		*/
    public function edit(string $id)
    {
		
        $data = Pages::find($id);
		$websites   = WebsiteModel::all();
        return view('pages/edit',array('formAction' => route('pages.update', ['pages' => $id]),'data'=>$data,'websites'=>$websites));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $pages = Pages::find($id);
        $pages->page_title     = $request->page_title;
		$pages->page_desc      = $request->page_desc;
		$pages->seo_title      = $request->seo_title;
		
		$pages->seo_title 		= $request->seo_title;
		$pages->seo_url_slug 	= Str::slug($request->seo_url_slug);
		
		$rId = $id == '' ? '' : ','.$id;
		
		 $validator = Validator::make($request->all(), [
            'page_title' => 'required|max:191|unique:pages,page_title' . $rId,
			'seo_title' => 'required|max:191|unique:pages,seo_title' . $rId,
			'page_desc' => 'required|min:2',
			'website_type' => 'required',
			'seo_url_slug' => 'required|max:191|unique:pages,seo_url_slug' . $rId,
        ]);
        if($validator->fails()){
            return redirect('pages/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
		
		
		$pages->website_type      = $request->website_type;
		$pages->seo_description = $request->seo_description;
		$pages->seo_keywords    = $request->seo_keywords;
		$pages->seo_meta        = $request->seo_meta;
		$pages->status          = $request->status;
        $pages->save();
        return redirect('/pages')->with('status', 'Page Updated Successfully');
    }
	
	/**

     * Remove the specified resource from storage.

     */

    public function destroy(string $id)
    {

        $page = Pages::find($id);
        if(!empty($page)){
            $page->delete();
            return redirect('/pages')->with('status', 'Page Deleted Successfully');
        }
        else{
            return redirect('/pages');
        }

    }
}
