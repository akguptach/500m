<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\WebsiteModel;
use App\Models\CountriesModel;
use Hash;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            $query = WebsiteModel::query();
            $searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';

            if(!empty($searchValue)){
                $query->where(function ($subquery) use ($searchValue) {
                    $subquery->orwhere('website_name', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('person_name', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('email', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('mobile_no', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('price', 'LIKE', '%' . $searchValue . '%');
                });
            }
            $query->orderBy('id', 'desc');
            $req_record['data'] = $query->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $websites = $query->get()->toArray();
            if(!empty($websites))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($websites);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $website){
                    $edit_page = 'website/'.$website['id'].'/edit';
                    $del_page = route('website.destroy', ['website' => $website['id']]);
                    
                    $req_website_id = '"'.$website['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_website(".$del_msg.",".$req_website_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='website_form_".$website['id']."'>
                        <input type='hidden' value='".csrf_token() ."'  id='csrf_".$website['id']."'>
                    </form>";
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('website/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['currencies'] = CountriesModel::all();
        return view('website/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website_name' => 'required|unique:websites,website_name',
            'person_name' => 'required|max:150|min:2',
            'email' => 'required|email',
            'mobile_no' => 'required|numeric',
            'website_type' => 'required',
            'price' => 'required',
            'no_words' => 'required|numeric',
            'additional_words' => 'required',
            'currency' => 'required',
			'currency_sign' => 'required',
			'login_username' => 'required|min:5',
			'login_password' => 'required|min:5',
			'order_prefix' => 'required',
			'order_padding' => 'required',
            'txn_fee' => 'required',
            'admin_commission' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return redirect('website/create')->withErrors($validator)->withInput();     
        }
        $website                    = new WebsiteModel();
        $website->website_name      = $request->website_name;
        $website->person_name       = $request->person_name;
        $website->email             = $request->email;
        $website->mobile_no         = $request->mobile_no;
        $website->website_type      = $request->website_type;
        $website->price              = $request->price;
        $website->no_words          = $request->no_words;
        $website->additional_words  = $request->additional_words;
        $website->currency          = $request->currency;
		
		$website->currency_sign     = $request->currency_sign;
		$website->login_username     = $request->login_username;
		$website->login_password     = Hash::make($request->login_password);
		$website->order_prefix       = $request->order_prefix;
		$website->order_padding      = $request->order_padding;
		
        $website->txn_fee           = $request->txn_fee;
        $website->admin_commission  = $request->admin_commission;
        $website->status            = $request->status;
        $website->save();
        return redirect('/website')->with('status', 'Website Created Successfully');
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
        $datas = WebsiteModel::find($id);
        $currencies = CountriesModel::all();

        return view('website/edit',array('formAction' => route('website.update', ['website' => $id]),'data'=>$datas,'currencies'=>$currencies));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'website_name' => 'required|unique:websites,website_name,'.$id,
            'person_name' => 'required|max:150|min:2',
            'email' => 'required|email',
            'mobile_no' => 'required|numeric',
            'website_type' => 'required',
            'price' => 'required',
            'no_words' => 'required|numeric',
            'additional_words' => 'required',
            'currency' => 'required',
			'currency_sign' => 'required',
			'login_username' => 'required|min:5',
			'order_prefix' => 'required',
			'order_padding' => 'required',
            'txn_fee' => 'required',
            'admin_commission' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return redirect('website/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        $website                    = WebsiteModel::find($id);
        $website->website_name      = $request->website_name;
        $website->person_name       = $request->person_name;
        $website->email             = $request->email;
        $website->mobile_no         = $request->mobile_no;
        $website->website_type      = $request->website_type;
        $website->price              = $request->price;
        $website->no_words          = $request->no_words;
        $website->additional_words  = $request->additional_words;
        $website->currency          = $request->currency;
		$website->currency_sign     = $request->currency_sign;
		$website->login_username     = $request->login_username;
		if($request->login_password)
		{
		$website->login_password     = Hash::make($request->login_password);
		}
		
		$website->website_price      = $request->website_price;
		$website->subject_price      = $request->subject_price;
		
		
		$website->order_prefix       = $request->order_prefix;
		$website->order_padding      = $request->order_padding;
        $website->txn_fee           = $request->txn_fee;
        $website->admin_commission  = $request->admin_commission;
        $website->status            = $request->status;
        $website->save();
        return redirect('/website')->with('status', 'Website Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $website = WebsiteModel::find($id);
        if(!empty($website)){
            $website->delete();
            return redirect('/website')->with('status', 'Website Deleted Successfully');
        }
        else{
            return redirect('/website');
        }
    }
}
