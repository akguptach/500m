<?php

namespace App\Services;

use App\Models\Pages;
use Illuminate\Support\Str;

/**
 * Class PageService.
 */
class PageService
{
    public function getPages()
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value'])) {
            $req_record['data'] = Pages::where('page_title', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $pages = Pages::where('page_title', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->get()->toArray();
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

                $req_record['data'][$i]['action'] = "<a href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_page(" . $del_msg . "," . $req_page_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action='" . $delete_page . " ' class='form-delete' id='page_form_" . $page['id'] . "'><input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $page['id'] . "'>

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
        $pages->save();
    }
}
