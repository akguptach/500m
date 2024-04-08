<?php

namespace App\Services;

use App\Models\OrderRequest;
use App\Models\Tutor;
use App\Models\OrderAssign;
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
            if (OrderRequest::where('order_id', $request->order_id)->where('type', 'TUTOR')->whereIn('status', ['PENDING', 'ACCEPTED'])->count() > 0) {
                return ['Already Sent'];
            }

            OrderRequest::Create([
                'order_id' => $request->order_id,
                'student_id' => $request->student_id,
                'tutor_id' => $request->teacher_id,
                'admin_id' => Auth::user()->id,
                'message' => '',
                'delivery_date' => $request->delivery_date,
                'type' => 'TUTOR'
            ]);
        } else {
            if (OrderAssign::where('order_id', $request->order_id)->where('status', 'COMPLETED')->count() <= 0) {
                return ['Tutor has not completed this order'];
            } else if (OrderRequest::where('order_id', $request->order_id)->where('type', 'TUTOR')->where('tutor_id', $request->teacher_id)->count() > 0) {
                return ['You can not assign same tutor as QC'];
            } else if (OrderRequest::where('order_id', $request->order_id)->where('type', 'QC')->count() > 0) {
                return ['Request already Sent'];
            }
            OrderRequest::Create([
                'order_id' => $request->order_id,
                'student_id' => $request->student_id,
                'tutor_id' => $request->teacher_id,
                'admin_id' => Auth::user()->id,
                'message' => '',
                'delivery_date' => $request->delivery_date,
                'type' => 'QC'
            ]);
        }
        $tutor = Tutor::find($request->teacher_id);
        $data = ['name' => $tutor->tutor_first_name];
        try {
            Mail::send('emails.tutor_request', $data, function ($message) use ($data, $tutor) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->subject("Order Request");
                $message->to(env('APP_TEST_EMAIL', $tutor->tutor_email));
            });
        } catch (\Exception $e) {
        }
        return ['Request send successfully'];
    }
}
