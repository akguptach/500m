<?php

namespace App\Services;

use App\Models\Website;
use Illuminate\Support\Facades\Hash;

class WebsiteService
{

    public function getWebsites()
    {
        $req_record['data'] = array();
        $query = Website::query();
        $searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';


        if (isset($_GET['columns'][1]['search']['value']) && !empty($_GET['columns'][1]['search']['value'])) {
            $query->where('website_type', $_GET['columns'][1]['search']['value']);
        }


        if (!empty($searchValue)) {
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
        if (!empty($websites))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($websites);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $website) {
                $edit_page = 'website/' . $website['id'] . '/edit';
                $del_page = route('website.destroy', ['website' => $website['id']]);

                $req_website_id = '"' . $website['id'] . '"';

                $req_record['data'][$i]['action'] = "<a href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_website(" . $del_msg . "," . $req_website_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='website_form_" . $website['id'] . "'>
                        <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $website['id'] . "'>
                    </form>";
                $i++;
            }
        }
        return $req_record;
    }

    public function saveWebsite($request, string $id = null)
    {
        $website                  =   ($id) ? Website::find($id) : new Website();
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
        if ($request->login_password) {
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
    }
}