<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            
            if(!empty($_GET['search']['value'])){
                $subjects = Subject::where('subject_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->get()->toArray();
                $req_record['data'] = Subject::where('subject_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            }
            else{
                $subjects = Subject::orderBy('id', 'desc')->get()->toArray();

                $req_record['data'] = Subject::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            }
            if(!empty($subjects))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($subjects);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $subject1){
					
					
					$req_record['data'][$i]['status']=($subject1['status'] == '1') ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-success">Deactive</span>';
                    $edit_page = 'subject/'.$subject1['id'].'/edit';
                    $del_page = route('subject.destroy', ['subject' => $subject1['id']]);
                    $req_subject_id = '"'.$subject1['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_subject(".$del_msg.",".$req_subject_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='subject_form_".$subject1['id']."'>
                    <input type='hidden' value='".csrf_token() ."'  id='csrf_".$subject1['id']."'>
                </form>";
                    $i++;
                }
            }
            echo json_encode($req_record);

        }
        else{
            return view('subject/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subject/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_name' => 'required|unique:subjects,subject_name',
			'price' => 'required',
			'additional_word_rate' => 'required'
        ]);
        if($validator->fails()){
            return redirect('subject/create')->withErrors($validator)->withInput();     
        }
        Subject::create(
		['subject_name'=>$request->subject_name,'price'=>$request->price,'additional_word_rate'=>$request->additional_word_rate
		]);
        return redirect('/subject')->with('status', 'Subject Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datas = Subject::where('id',$id)->first();
        return view('subject/edit',array('formAction' => route('subject.update', ['subject' => $id]),'data'=>$datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'subject_name' => 'required|unique:subjects,subject_name,'.$id,
			'price' => 'required',
			'additional_word_rate' => 'required',
        ]);
        if($validator->fails()){
            return redirect('subject/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        Subject::where('id', $id)->update([
            'subject_name' => $request->subject_name,
			'price' => $request->price,
			'additional_word_rate' => $request->additional_word_rate,
			
        ]);
        return redirect('/subject')->with('status', 'Subject Updated Successfully');
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::find($id);
        if(!empty($subject)){
            $subject->delete();
            return redirect('/subject')->with('status', 'Subject Deleted Successfully');
        }
        else{
            return redirect('/subject');
        }
    }
}
