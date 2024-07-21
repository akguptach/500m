<?php

namespace App\Services;

use App\Models\Categories;

/**
 * Class CategoriesService.
 */
class CategoriesService
{
    public function getCategories()
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value'])) {
            $req_record['data'] = Categories::where('category_name', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $categories = Categories::where('category_name', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->get()->toArray();
        } else {
            $req_record['data'] = Categories::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $categories = Categories::orderBy('id', 'desc')->get()->toArray();
        }
        if (!empty($categories))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($categories);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $category) {
                $edit_category = 'categories/' . $category['id'] . '/edit';
                $req_record['data'][$i]['action'] = "<a class='btn btn-xs sharp btn-primary' href='" . url($edit_category) . "' ><i class='fas fa-edit' title='Edit'></i></a>";
                $i++;
            }
        }
        return $req_record;
    }

    public function save($request, $id = null)
    {
        $categories                 = ($id) ? Categories::find($id) : new Categories();
        $categories->category_name  = $request->category_name;
        $categories->save();
    }
}
