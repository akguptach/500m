<?php

namespace App\Services;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationService
{

    public function getNotifications($type)
    {
        $result = [];
         $query = Notification::whereHas('sendertable')->where('receivertable_type','App\Models\User')
        ->where('receivertable_id',Auth::user()->id);
        if($type == 'writer')
            $query->where('sendertable_type','App\Models\Tutor');
        else
        $query->where('sendertable_type','App\Models\Student');
        $result['data'] = $query->orderBy('created_at', 'desc')->paginate(10);
        return $result;
        
    }


    
}