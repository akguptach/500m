<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\StudyLabelsModel;


class StudyLabelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            if(!empty($_GET['search']['value'])){
                $req_record['data'] = StudyLabelsModel::where('label_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $labels = StudyLabelsModel::where('label_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->get()->toArray();
            }
            else{
                $req_record['data'] = StudyLabelsModel::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $labels = StudyLabelsModel::orderBy('id', 'desc')->get()->toArray();

            }
            if(!empty($labels))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($labels);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $label){
                    $edit_page = 'studylabel/'.$label['id'].'/edit';
                    $del_page = route('studylabel.destroy', ['studylabel' => $label['id']]);
                    
                    $req_label_id = '"'.$label['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_label(".$del_msg.",".$req_label_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='study_label_form_".$label['id']."'>
                        <input type='hidden' value='".csrf_token() ."'  id='csrf_".$label['id']."'>
                    </form>";
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('study_label/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('study_label/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label_name' => 'required|unique:study_labels,label_name',			'price' => 'required',
        ]);
        if($validator->fails()){
            return redirect('studylabel/create')->withErrors($validator)->withInput();     
        }
        StudyLabelsModel::create(['label_name'=>$request->label_name,'price'=>$request->price]);
        return redirect('/studylabel')->with('status', 'Study Label Created Successfully');
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
        $datas = StudyLabelsModel::where('id',$id)->first();
        return view('study_label/edit',array('formAction' => route('studylabel.update', ['studylabel' => $id]),'data'=>$datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'label_name' => 'required|unique:study_labels,label_name,'.$id,			'price' => 'required',
        ]);
        if($validator->fails()){
            return redirect('studylabel/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        StudyLabelsModel::where('id', $id)->update([
            'label_name' => $request->label_name,			'price' => $request->price
        ]);
        return redirect('/studylabel')->with('status', 'Study Label Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $label = StudyLabelsModel::find($id);
        if(!empty($label)){
            $label->delete();
            return redirect('/studylabel')->with('status', 'Study Label Deleted Successfully');
        }
        else{
            return redirect('/studylabel');
        }
    }
}
