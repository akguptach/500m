<?php

namespace App\Services;

use App\Models\Service;
use App\Models\ServiceSeo;

/**
 * Class ServicesService.
 */
class ServicesService extends BaseService
{
    public function getPages()
    {
        $filters = ['service_name'];
        $reqRecord  = $this->getBasePages(Service::class, $filters);
        if (!empty($reqRecord['data'])) {
            foreach ($reqRecord['data'] as $index => $item) {
                $reqRecord['data'][$index]->seo_url_slug = ($item->seo) ? $item->seo->seo_url_slug : '';
                $editItem = 'service/' . $item['id'] . '/edit';
                $deleteItem = 'service/' . $item['id'] . '/delete';
                $reqRecord['data'][$index]['action'] = "<a href='" . url($editItem) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_page('Are you want to delete?'," . $item['id'] . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action='" . $deleteItem . " ' class='form-delete' id='page_form_" . $item['id'] . "'><input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $item['id'] . "'></form>";
            }
        }
        return $reqRecord;
    }
}
