<?php

namespace App\Services;
use App\Models\Notification;

class NotificationService
{

    public function getNotifications()
    {
        $result = [];
        $result['data'] = Notification::orderBy('created_at', 'desc')->paginate(10);
        return $result;
        
    }


    
}