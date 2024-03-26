<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Grades;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            if(!empty($_GET['search']['value'])){
                $req_record['data'] = Grades::where('grade_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $grades = Grades::where('grade_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->get()->toArray();
            }
            else{
                $req_record['data'] = Grades::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $grades = Grades::orderBy('id', 'desc')->get()->toArray();

            }
            if(!empty($grades))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($grades);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $grade){
                    $edit_page = 'grade/'.$grade['id'].'/edit';
                    $del_page = route('grade.destroy', ['grade' => $grade['id']]);
                    
                    $req_grade_id = '"'.$grade['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_grade(".$del_msg.",".$req_grade_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='grade_form_".$grade['id']."'>
                        <input type='hidden' value='".csrf_token() ."'  id='csrf_".$grade['id']."'>
                    </form>";
                    
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('grade/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grade/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grade_name' => 'required|unique:grades,grade_name',			'price' => 'required',
        ]);
        if($validator->fails()){
            return redirect('grade/create')->withErrors($validator)->withInput();     
        }
        Grades::create(['grade_name'=>$request->grade_name,'price'=>$request->price]);
        return redirect('/grade')->with('status', 'Grade Created Successfully');
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
        $datas = Grades::find($id);
        return view('grade/edit',array('formAction' => route('grade.update', ['grade' => $id]),'data'=>$datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'grade_name' => 'required|unique:grades,grade_name,'.$id,			'price' => 'required',
        ]);
        if($validator->fails()){
            return redirect('grade/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        Grades::where('id', $id)->update([
            'grade_name' => $request->grade_name,			'price' => $request->price
        ]);
        return redirect('/grade')->with('status', 'Grade Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grade=Grades::find($id);
        if(!empty($grade)){
            $grade->delete();
            return redirect('/grade')->with('status', 'Grade Deleted Successfully');
        }
        else{
            return redirect('/grade');
        }
    }
}
