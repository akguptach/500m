<?php

namespace App\Services;

use App\Models\OrderRequest;
use App\Models\Tutor;
use App\Models\QcOrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * Class OrderRequestService.
 */
class OrderRequestService
{

    public function sendRequest($request, $type = 'tutor')
    {
        if ($type == 'tutor') {
            OrderRequest::Create([
                'order_id' => $request->order_id,
                'student_id' => $request->student_id,
                'tutor_id' => $request->teacher_id,
                'admin_id' => Auth::user()->id,
                'message' => '',
                'delivery_date' => $request->delivery_date
            ]);
        } else {
            QcOrderRequest::Create([
                'order_id' => $request->order_id,
                'student_id' => $request->student_id,
                'qc_id' => $request->teacher_id,
                'admin_id' => Auth::user()->id,
                'message' => '',
                'delivery_date' => $request->delivery_date
            ]);
        }
        $tutor = Tutor::find($request->teacher_id);
        $data = ['name' => $tutor->tutor_first_name];
        Mail::send('emails.tutor_request', $data, function ($message) use ($data, $tutor) {
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $message->subject("Order Request");
            $message->to(env('APP_TEST_EMAIL', $tutor->tutor_email));
        });
        return ['Request send successfully'];
    }
}
