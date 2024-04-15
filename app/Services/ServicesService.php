<?php

namespace App\Services;

use App\Models\Service;
use App\Models\ServiceSpecification;

/**
 * Class ServicesService.
 */
class ServicesService extends BaseService
{
    public function getPages()
    {
        $filters = ['service_name'];
        $reqRecord  = $this->getBasePages(Service::class, $filters);
        $del_msg = '"' . 'Are you want to delete?' . '"';
        if (!empty($reqRecord['data'])) {
            foreach ($reqRecord['data'] as $index => $item) {
                $reqRecord['data'][$index]->seo_url_slug = ($item->seo) ? $item->seo->seo_url_slug : '';
                $editItem = 'services/edit/' . $item['id'];
                $deleteItem = 'services/' . $item['id'] . '/delete';

                $req_serv_id = $item['id'];

                $reqRecord['data'][$index]['action'] = "<a href='" . url($editItem) . "' >
                <i class='fas fa-edit' title='Edit'></i></a>
                &nbsp;&nbsp;&nbsp;
                <a href='javascript:void(0);' onclick='delete_service(" . $del_msg . "," . $req_serv_id . ")' >
                <i class='fas fa-trash'  title='Delete'>
                </i></a>
                <form method='POST' action='" . $deleteItem . " ' class='form-delete' id='service_form_" . $item['id'] . "'><input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $item['id'] . "'></form>";
            }
        }
        return $reqRecord;
    }

    public function storeSpecification($serviceSpecificationRequest)
    {
        $data = $serviceSpecificationRequest->all();

        $files = request()->file('addMoreSpecificationFields');

        $oldValues = ServiceSpecification::where('service_id', $serviceSpecificationRequest->service_id)->get();
        foreach ($data['addMoreSpecificationFields'] as $index => $fields) {

            $iconImg = '';
            if (isset($files[$index]['icon'])) {
                $icon = $files[$index]['icon'];
                $imageName = "og_image" . time() . '.' . $icon->getClientOriginalExtension();
                $icon->move(public_path('images/uploads/services/specification/icons/'), $imageName);
                $iconImg = env('APP_URL') . '/images/uploads/services/specification/icons/' . $imageName;
            }
            ServiceSpecification::Create([
                'service_id' => $serviceSpecificationRequest->service_id,
                'title' => $fields['title'],
                'description' => $fields['description'],
                'icon' => $iconImg,
            ]);
        }
        foreach ($oldValues as $obj) {
            $obj->delete();
        }
        return true;
    }
}
