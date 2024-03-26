<?php

namespace App\Services;

use App\Models\Faq;

class FaqService
{

    public function getFaqs()
    {
        $req_record['data'] = array();
        $query = Faq::query();
        $searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';

        if (!empty($searchValue)) {
            $query->where(function ($subquery) use ($searchValue) {
                $subquery->orwhere('question', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('answer', 'LIKE', '%' . $searchValue . '%');
            });
        }
        $query->orderBy('id', 'desc');
        $req_record['data'] = $query->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
        $faqs = $query->get()->toArray();
        if (!empty($faqs))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($faqs);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $faq) {
                $edit_page = 'faq/' . $faq['id'] . '/edit';
                $del_page = route('faq.destroy', ['faq' => $faq['id']]);

                $req_faq_id = '"' . $faq['id'] . '"';

                $req_record['data'][$i]['action'] = "<a href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_faq(" . $del_msg . "," . $req_faq_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='faq_form_" . $faq['id'] . "'>
                        <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $faq['id'] . "'>
                    </form>";
                $i++;
            }
        }
        return $req_record;
    }

    public function saveFaq($request, $id = null)
    {
        $faq                      = ($id) ? Faq::find($id) : new Faq();
        $faq->question            = $request->question;
        $faq->answer              = $request->answer;
        $faq->website_id          = $request->website_id;
        $faq->save();
    }
}
