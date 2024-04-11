<?php

namespace App\Services;

/**
 * Class ServicesService.
 */
class BaseService
{
    public function getBasePages($ModelClass, $filters)
    {
        $req_record['data'] = array();

        if (!empty($_GET['search']['value'])) {
            $req_record['data'] = $ModelClass::where(function ($q) use ($filters) {
                foreach ($filters as $filter) {
                    $q->orWhere($filter, 'LIKE', '%' . $_GET['search']['value'] . '%');
                }
            })->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get();
            $pages = $ModelClass::where(function ($q) use ($filters) {
                foreach ($filters as $filter) {
                    $q->orWhere($filter, 'LIKE', '%' . $_GET['search']['value'] . '%');
                }
            })->orderBy('id', 'desc')->get();
        } else {
            $req_record['data'] = $ModelClass::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get();
            $pages = $ModelClass::orderBy('id', 'desc')->get();
        }
        if (!empty($pages))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($pages);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;

        return $req_record;
    }
}
