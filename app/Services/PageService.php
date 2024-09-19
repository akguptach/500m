<?php

namespace App\Services;

use App\Models\Pages;
use App\Models\ContactUs;
use App\Models\PageRating;
use Illuminate\Support\Str;
use DataTables;

/**
 * Class PageService.
 */
class PageService
{
    public function getPages()
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value']) || isset($_GET['columns'][1]['search']['value']) && !empty($_GET['columns'][1]['search']['value'])) {

            $req_record['data'] = Pages::where(function ($q) {
                if (!empty($_GET['search']['value'])) {
                    $q->where('page_title', 'LIKE', '%' . $_GET['search']['value'] . '%');
                }
                if (isset($_GET['columns'][1]['search']['value']) && !empty($_GET['columns'][1]['search']['value'])) {
                    $q->where('website_type', $_GET['columns'][1]['search']['value']);
                }
            })->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();


            $pages = Pages::where(function ($q) {
                if (!empty($_GET['search']['value'])) {
                    $q->where('page_title', 'LIKE', '%' . $_GET['search']['value'] . '%');
                }
                if (isset($_GET['columns'][1]['search']['value']) && !empty($_GET['columns'][1]['search']['value'])) {
                    $q->where('website_type', $_GET['columns'][1]['search']['value']);
                }
            })->orderBy('id', 'desc')->get()->toArray();
        } else {
            $req_record['data'] = Pages::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $pages = Pages::orderBy('id', 'desc')->get()->toArray();
        }
        if (!empty($pages))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($pages);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $page) {
                $edit_page = 'pages/' . $page['id'] . '/edit';
                $delete_page = 'pages/' . $page['id'] . '/delete';

                $req_page_id = '"' . $page['id'] . '"';

                $req_record['data'][$i]['action'] = "<a class='btn btn-xs sharp btn-primary' href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='btn btn-xs sharp btn-danger' onclick='delete_page(" . $del_msg . "," . $req_page_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action='" . $delete_page . " ' class='form-delete' id='page_form_" . $page['id'] . "'><input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $page['id'] . "'>

                    </form>";
                $i++;
            }
        }
        return $req_record;
    }

    public function savePage($request, $id = null)
    {
        $pages = ($id) ? Pages::find($id) : new Pages();
        $pages->page_title     = $request->page_title;
        $pages->page_desc      = $request->page_desc;
        $pages->seo_title      = $request->seo_title;
        $pages->seo_url_slug     = Str::slug($request->seo_url_slug);
        $pages->seo_description  = $request->seo_description;
        $pages->seo_keywords    = $request->seo_keywords;
        $pages->seo_meta        = $request->seo_meta;
        $pages->status          = $request->status;
        $pages->website_type          = $request->website_type;
        if ($request->has("og_image")) {
            $picture = request()->file('og_image');
            $imageName = "og_image" . time() . '.' . $picture->getClientOriginalExtension();
            $picture->move(public_path('images/uploads/pages/'), $imageName);
            $pages->og_image = 'images/uploads/pages/' . $imageName;
        }
        $pages->save();
        return $pages;
    }

    public function storeRatings($pageRatingRequest)
    {
        $data = $pageRatingRequest->all();

        $files = request()->file('addMoreRatingFields');

        $oldValues = PageRating::where('page_id', $pageRatingRequest->page_id)->get();
        foreach ($data['addMoreRatingFields'] as $index => $fields) {

            $userImage = isset($fields['user_image_url']) ? $fields['user_image_url'] : '';
            if (isset($files[$index]['user_image'])) {
                $image = $files[$index]['user_image'];
                $imageName = "og_image" . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/uploads/pages/ratings/user_image/'), $imageName);
                $userImage = env('APP_URL') . '/images/uploads/pages/ratings/user_image/' . $imageName;
            }
            PageRating::Create([
                'page_id' => $pageRatingRequest->page_id,
                'star_rating' => $fields['star_rating'],
                'address' => $fields['address'],
                'description' => $fields['description'],
                'user_image' => $userImage,
            ]);
        }
        foreach ($oldValues as $obj) {
            $obj->delete();
        }
        return true;
    }
    public function contactUsEnquiry($type)
    {
        $query = ContactUs::orderBy('id', 'desc');
        if($type == 'completed'){
            $query->where('customer_attendant',1);
        }else{
            $query->where('customer_attendant',0); 
        }
        return DataTables::eloquent($query)
        ->addColumn('action', function($row) use($type){
            if($type != 'completed')
                return '<form class="customer-attendant-form" method="POST" action="'.route('contact.customer.attendant',$row->id).'">'.csrf_field().'<button type="button" class="btn btn-success me-2 customer-attendant-btn" name="customer_attendant_btn" data-id="'.$row->id.'" class="btn btn-link " title="Inactivate Expert" onclick="return new_modal(event, &quot;Click Ok to attendant customer.&quot;)">Customer attendant</button></form>';
            else
                return '';
        })
        ->rawColumns(['action'])
        ->toJson();
        /*
        $req_record['data'] = array();
        if (!empty($_GET['search']['value'])) {
            $req_record['data'] = ContactUs::orderBy('id', 'desc')->get()->toArray();
            $styles = ContactUs::orderBy('id', 'desc')->get()->toArray();
        } else {
            $req_record['data'] = ContactUs::orderBy('id', 'desc')->get()->toArray();
            $styles = ContactUs::orderBy('id', 'desc')->get()->toArray();
        }
        
        if (!empty($styles))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($styles);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;       
        return $req_record;*/
    }
}