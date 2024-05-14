<?php

namespace App\Services;

use App\Models\Service;
use App\Models\ServiceSpecification;
use App\Models\ServiceRating;
use App\Models\ServiceHowWork;
use App\Models\ServiceAssistButton;
use App\Models\ServiceWhyEducrafter;

/**
 * Class ServicesService.
 */
class ServicesService extends BaseService
{

    public function getBasePages1($ModelClass, $type, $filters)
    {
        $req_record['data'] = array();

        if (isset($_GET['search']['value']) && !empty($_GET['search']['value']) || isset($_GET['columns'][2]['search']['value']) && !empty($_GET['columns'][2]['search']['value']) || isset($_GET['columns'][3]['search']['value']) && !empty($_GET['columns'][3]['search']['value'])) {

            $req_record['data'] = $ModelClass::where('type', $type)->where(function ($q) use ($filters) {
                foreach ($filters as $filter) {
                    $q->orWhere($filter, 'LIKE', '%' . $_GET['search']['value'] . '%');
                }
            })
                ->where(function ($q) {
                    if (isset($_GET['columns'][2]['search']['value']) && !empty($_GET['columns'][2]['search']['value'])) {
                        $q->where('status', $_GET['columns'][2]['search']['value']);
                    }
                    if (isset($_GET['columns'][3]['search']['value']) && !empty($_GET['columns'][3]['search']['value'])) {
                        $q->where('website_type', $_GET['columns'][3]['search']['value']);
                    }
                })

                ->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get();




            $pages = $ModelClass::where('type', $type)->where(function ($q) use ($filters) {
                foreach ($filters as $filter) {
                    $q->orWhere($filter, 'LIKE', '%' . $_GET['search']['value'] . '%');
                }
            })
                ->where(function ($q) {
                    if (isset($_GET['columns'][2]['search']['value']) && !empty($_GET['columns'][2]['search']['value'])) {
                        $q->where('status', $_GET['columns'][2]['search']['value']);
                    }
                    if (isset($_GET['columns'][3]['search']['value']) && !empty($_GET['columns'][3]['search']['value'])) {
                        $q->where('website_type', $_GET['columns'][3]['search']['value']);
                    }
                })
                ->orderBy('id', 'desc')->get();
        } else {
            $req_record['data'] = $ModelClass::where('type', $type)->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get();
            $pages = $ModelClass::where('type', $type)->orderBy('id', 'desc')->get();
        }
        if (!empty($pages))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($pages);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;

        return $req_record;
    }

    public function getPages($type)
    {

        $filters = ['service_name', 'website_type'];
        $reqRecord  = $this->getBasePages1(Service::class, $type, $filters);
        $del_msg = '"' . 'Are you want to delete?' . '"';
        if (!empty($reqRecord['data'])) {
            foreach ($reqRecord['data'] as $index => $item) {



                $reqRecord['data'][$index]->seo_url_slug = ($item->seo) ? $item->seo->seo_url_slug : '';

                if ($type == 'PAGE')
                    $editItem = 'pages/edit/' . $item['id'];
                else
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

            $iconImg = isset($fields['icon_url']) ? $fields['icon_url'] : '';
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

    public function storeRatings($serviceRatingRequest)
    {
        $data = $serviceRatingRequest->all();

        $files = request()->file('addMoreRatingFields');

        $oldValues = ServiceRating::where('service_id', $serviceRatingRequest->service_id)->get();
        foreach ($data['addMoreRatingFields'] as $index => $fields) {

            $userImage = isset($fields['user_image_url']) ? $fields['user_image_url'] : '';
            if (isset($files[$index]['user_image'])) {
                $image = $files[$index]['user_image'];
                $imageName = "og_image" . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/uploads/services/ratings/user_image/'), $imageName);
                $userImage = env('APP_URL') . '/images/uploads/services/ratings/user_image/' . $imageName;
            }
            ServiceRating::Create([
                'service_id' => $serviceRatingRequest->service_id,
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



    public function storeHowWorks($serviceHowWorksRequest)
    {
        $data = $serviceHowWorksRequest->all();
        $files = request()->file('addMoreFields');

        $oldValues = ServiceHowWork::where('service_id', $serviceHowWorksRequest->service_id)->get();
        foreach ($data['addMoreFields'] as $index => $fields) {
            $iconImg = isset($fields['icon_url']) ? $fields['icon_url'] : '';
            if (isset($files[$index]['icon'])) {
                $icon = $files[$index]['icon'];
                $imageName = "og_image" . time() . '.' . $icon->getClientOriginalExtension();
                $icon->move(public_path('images/uploads/services/how_works/icons/'), $imageName);
                $iconImg = env('APP_URL') . '/images/uploads/services/how_works/icons/' . $imageName;
            }
            ServiceHowWork::Create([
                'service_id' => $serviceHowWorksRequest->service_id,
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


    public function storeAssistBtn($serviceAssistButtonRequest)
    {
        $data = $serviceAssistButtonRequest->all();
        $oldValues = ServiceAssistButton::where('service_id', $serviceAssistButtonRequest->service_id)->get();
        foreach ($data['addMoreFields'] as $index => $fields) {
            ServiceAssistButton::Create([
                'service_id' => $serviceAssistButtonRequest->service_id,
                'btn_text' => $fields['btn_text'],
                'btn_url' => $fields['btn_url'],
            ]);
        }
        foreach ($oldValues as $obj) {
            $obj->delete();
        }
        return true;
    }

    public function storeWhyEducrafter($serviceSpecificationRequest)
    {
        $data = $serviceSpecificationRequest->all();
        $files = request()->file('addMoreSpecificationFields');

        $oldValues = ServiceWhyEducrafter::where('service_id', $serviceSpecificationRequest->service_id)->get();
        foreach ($data['addMoreSpecificationFields'] as $index => $fields) {

            $iconImg = isset($fields['icon_url']) ? $fields['icon_url'] : '';
            if (isset($files[$index]['icon'])) {
                $icon = $files[$index]['icon'];
                $imageName = "og_image" . time() . '.' . $icon->getClientOriginalExtension();
                $icon->move(public_path('images/uploads/services/specification/icons/'), $imageName);
                $iconImg = env('APP_URL') . '/images/uploads/services/specification/icons/' . $imageName;
            }
            ServiceWhyEducrafter::Create([
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