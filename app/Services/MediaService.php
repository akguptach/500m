<?php
namespace App\Services;
use App\Models\Media;
use App\Models\Subscription;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class MediaService
{

    public function getMedia()
    {
        $req_record['data'] = array();
        $query = Media::query();

        $query->orderBy('id', 'desc');
        $req_record['data'] = $query->get()->toArray();
        $websites = $query->get()->toArray();
        
        if (!empty($websites))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($websites);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        
        return $req_record;
    }
    public function subscription()
    {
        $req_record['data'] = array();
        $query = Subscription::query();
        $query->orderBy('id', 'desc');
         $data = $query->get()->toArray();

        foreach($data as $index=>$website){
            $data[$index]['created_at'] = Carbon::parse($website['created_at'])->format('d/m/Y');
        }
        $req_record['data'] = $data;

        $websites = $query->get()->toArray();
        
        if (!empty($websites))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($websites);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        
        return $req_record;
    }
}
