<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WalletTransaction;
use App\Models\StudentWithdrawal;
use DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\TutorWithdrawal;

class WithdrawRequestController extends Controller
{

    public function __construct()
    {
    }
    

    public function index()
    {

        if (isset($_GET) && !empty($_GET['columns'])) {
            $studentWithdrawal = StudentWithdrawal::orderBy('id','desc');
            return DataTables::eloquent($studentWithdrawal)
            ->addIndexColumn()
            ->addColumn('created_at', function($row) {
                return \Carbon\Carbon::parse($row->created_at)->format('d/m/Y');
            })
            ->addColumn('student_name', function($row) {
                return $row->student->first_name;
            })

            /*->addColumn('wallet', function($row) {
                return $row->student->wallet_transactions->where('type','credit')->sum('amount')-$row->student->wallet_transactions->where('type','debit')->sum('amount');
            })*/

            ->addColumn('amount', function($row) {
                return '£'.$row->amount;
            })

            ->addColumn('wallet_balance', function($row) {
                return '£'.$row->wallet_balance;
            })


            ->addColumn('action', function($row) {
                return '<a href="'.route('withdraw_request_details',[$row->id]).'" style="color:blue;">View</a>';
            })
            ->addColumn('status', function($row) {
                if ($row->status == 'COMPLETED') {
                    return '<span class="badge bg-success" style="min-width: 80px;">Completed</span>';
                }else if ($row->status == 'DECLINED') {
                    return '<span class="badge bg-danger" style="min-width: 80px;">Declined</span>';
                }
                else {
                    return '<span class="badge bg-primary" style="min-width: 80px;">Pending</span>';
                } 
            })

            ->filterColumn('student_name', function($query, $keyword) {
                $query->whereHas('student', fn($q) => $q->where('first_name', 'LIKE', '%' . $keyword . '%'));
            })
            ->filterColumn('status', function($query, $keyword) {
                $query->where('status', $_GET['columns'][5]['search']['value']);
            })

            ->rawColumns(['status','action'])
            ->toJson();
        }else{
            return view('withdraw_requests.index');
        }

        

    }

    public function withdrawDetails($id)
    {
        $studentWithdrawal = StudentWithdrawal::where('id', $id)->first();
        $studentId = $studentWithdrawal->student->id;
        $credits = WalletTransaction::where('user_id', $studentId)->where('type','credit')->sum('amount');
        $debits = WalletTransaction::where('user_id', $studentId)->where('type','debit')->sum('amount');
        $balance = number_format($credits-$debits,2);
        return view('withdraw_requests.details',compact('studentWithdrawal','balance'));
    }

    public function declineRequest($id, Request $request)
    {
        try{
            $data = $request->all();
            $pendingRequest = StudentWithdrawal::where('id', $id)->where('status', 'PENDING')->first();
            if(!$pendingRequest){
                return redirect(route('withdraw_request_view'))->with('error', 'No pending withdraw request not found');
            }
            $pendingRequest->status = 'DECLINED';
            $pendingRequest->remarks = $data['remark'];
            $pendingRequest->save();
            

            $toEmail = $pendingRequest->student->email;
            $name = $pendingRequest->student->first_name;
            $message = 'Your withdraw request of $'.$pendingRequest->amount.' has been declined';
            $subject = 'Withdraw request declined';
            $this->sendWithdrawNotification($message, $name, $toEmail, $subject);
            return redirect(route('withdraw_request_view'))->with('success', 'Withdraw request has been declined');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function acceptRequest($id)
    {
        try{
            $pendingRequest = StudentWithdrawal::where('id', $id)->where('status', 'PENDING')->first();
            if(!$pendingRequest){
                return redirect(route('withdraw_request_view'))->with('error', 'No pending withdraw request not found');
            }

            $studentId = $pendingRequest->student_id;
            WalletTransaction::Create([
                'user_id'=>$studentId,
                'amount'=>$pendingRequest->amount,
                'type'=>'debit'
            ]);
            $pendingRequest->status = 'COMPLETED';
            $pendingRequest->save();

            $toEmail = $pendingRequest->student->email;
            $name = $pendingRequest->student->first_name;
            $message = 'Your withdraw request of $'.$pendingRequest->amount.' has been completed';
            $subject = 'Withdraw request completed';
            $this->sendWithdrawNotification($message, $name, $toEmail, $subject);


            return redirect(route('withdraw_request_view'))->with('success', 'Withdraw request has been completed');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function sendWithdrawNotification($message, $name, $toEmail, $subject){
            $data = ['messageContent' => $message, 'name'=>$name];
            try {
                Mail::send('emails.withdraw_request', $data, function ($message) use ($data, $toEmail, $subject) {
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $message->subject($subject);
                    $message->to(env('APP_TEST_EMAIL', $toEmail));
                });
            } catch (\Exception $e) {
                echo $e; die;
            }
    }


    public function tutorWithdrawRequests()
    {

        if (isset($_GET) && !empty($_GET['columns'])) {

            $TutorWithdrawal = TutorWithdrawal::orderBy('id','desc');
            return DataTables::eloquent($TutorWithdrawal)
            ->addIndexColumn()
            ->addColumn('created_at', function($row) {
                return \Carbon\Carbon::parse($row->created_at)->format('d/m/Y');
            })
            ->addColumn('tutor_name', function($row) {
                return $row->tutor->tutor_first_name;
            })

            /*->addColumn('wallet', function($row) {
                return $row->student->wallet_transactions->where('type','credit')->sum('amount')-$row->student->wallet_transactions->where('type','debit')->sum('amount');
            })*/

            ->addColumn('amount', function($row) {
                return '£'.$row->amount;
            })

            ->addColumn('wallet_balance', function($row) {
                return '£'.$row->balance;
            })


            ->addColumn('action', function($row) {
                return '<a href="'.route('tutor_withdraw_request_details',[$row->id]).'" style="color:blue;">View</a>';
            })
            ->addColumn('status', function($row) {
                if ($row->status == 'COMPLETED') {
                    return '<span class="badge bg-success" style="min-width: 80px;">Completed</span>';
                }else if ($row->status == 'DECLINED') {
                    return '<span class="badge bg-danger" style="min-width: 80px;">Declined</span>';
                }
                else {
                    return '<span class="badge bg-primary" style="min-width: 80px;">Pending</span>';
                } 
            })

            ->filterColumn('tutor_name', function($query, $keyword) {
                $query->whereHas('tutor', fn($q) => $q->where('tutor_first_name', 'LIKE', '%' . $keyword . '%'));
            })
            ->filterColumn('status', function($query, $keyword) {
                $query->where('status', $_GET['columns'][5]['search']['value']);
            })

            ->rawColumns(['status','action'])
            ->toJson();
        }else{
            return view('withdraw_requests.tutor');
        }

        

    }



    public function tutorWithdrawDetails($id)
    {
        $tutorWithdrawal = TutorWithdrawal::where('id', $id)->first();
        $tutorId = $tutorWithdrawal->tutor->id;
        $balance=0;
        return view('withdraw_requests.tutor_details',compact('tutorWithdrawal','balance'));
    }

    public function tutorDeclineRequest($id, Request $request)
    {
        try{
            $data = $request->all();
            $pendingRequest = TutorWithdrawal::where('id', $id)->where('status', 'PENDING')->first();
            if(!$pendingRequest){
                return redirect(route('tutor_withdraw_request_view'))->with('error', 'No pending withdraw request not found');
            }
            $pendingRequest->status = 'DECLINED';
            $pendingRequest->remarks = $data['remark'];
            $pendingRequest->save();
            

            $toEmail = $pendingRequest->tutor->tutor_email;
            $name = $pendingRequest->tutor->tutor_first_name;
            $message = 'Your withdraw request of $'.$pendingRequest->amount.' has been declined';
            $subject = 'Withdraw request declined';
            $this->sendWithdrawNotification($message, $name, $toEmail, $subject);
            return redirect(route('tutor_withdraw_request_view'))->with('success', 'Withdraw request has been declined');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function tutorAcceptRequest($id)
    {
        try{
            $pendingRequest = TutorWithdrawal::where('id', $id)->where('status', 'PENDING')->first();
            if(!$pendingRequest){
                return redirect(route('tutor_withdraw_request_view'))->with('error', 'No pending withdraw request not found');
            }
            $pendingRequest->status = 'COMPLETED';
            $pendingRequest->save();

            $toEmail = $pendingRequest->tutor->tutor_email;
            $name = $pendingRequest->tutor->tutor_first_name;
            $message = 'Your withdraw request of $'.$pendingRequest->amount.' has been completed';
            $subject = 'Withdraw request completed';
            $this->sendWithdrawNotification($message, $name, $toEmail, $subject);
            return redirect(route('tutor_withdraw_request_view'))->with('success', 'Withdraw request has been completed');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    
}
