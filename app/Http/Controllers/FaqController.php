<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Faq;
use App\Models\WebsiteModel;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            $query = Faq::query();
            $searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';

            if(!empty($searchValue)){
                $query->where(function ($subquery) use ($searchValue) {
                    $subquery->orwhere('question', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('answer', 'LIKE', '%' . $searchValue . '%');
                });
            }
            $query->orderBy('id', 'desc');
            $req_record['data'] = $query->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $faqs = $query->get()->toArray();
            if(!empty($faqs))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($faqs);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $faq){
                    $edit_page = 'faq/'.$faq['id'].'/edit';
                    $del_page = route('faq.destroy', ['faq' => $faq['id']]);
                    
                    $req_faq_id = '"'.$faq['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_faq(".$del_msg.",".$req_faq_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='faq_form_".$faq['id']."'>
                        <input type='hidden' value='".csrf_token() ."'  id='csrf_".$faq['id']."'>
                    </form>";
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('faq/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['faqs'] = Faq::all();
        $data['websites']   = WebsiteModel::all();
        return view('faq/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|min:2',
            'answer' => 'required',
            'website_id' => 'required',
        ]);
        if($validator->fails()){
            return redirect('faq/create')->withErrors($validator)->withInput();     
        }
        $faq                      = new Faq();
        $faq->question            = $request->question;
        $faq->answer              = $request->answer;
        $faq->website_id          = $request->website_id;
        $faq->save();
        return redirect('/faq')->with('status', 'FAQ Created Successfully');
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
        $datas = Faq::find($id);
        $websites   = WebsiteModel::all();
        return view('faq/edit',array('formAction' => route('faq.update', ['faq' => $id]),'data'=>$datas,'websites'=>$websites));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|min:2',
            'answer' => 'required',
            'website_id' => 'required',

        ]);
        if($validator->fails()){
            return redirect('faq/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        $faq                      = Faq::find($id);
        $faq->question            = $request->question;
        $faq->answer              = $request->answer;
        $faq->website_id          = $request->website_id;
        $faq->save();
        return redirect('/faq')->with('status', 'FAQ Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::find($id);
        if(!empty($faq)){
            $faq->delete();
            return redirect('/faq')->with('status', 'FAQ Deleted Successfully');
        }
        else{
            return redirect('/faq');
        }
    }
}
