@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                            @endif
                            <h4 class="card-title">Withdraw Request</h4>
                            <div class="table-responsive">
                                <table class="table" id="example1">
                                    <tbody>
                                        <tr>
                                            <td>Student Name</td>
                                            <td>{{$studentWithdrawal->student->first_name}} {{$studentWithdrawal->student->last_name}}</td>
                                        </tr>

                                        <tr>
                                            <td>Total Wallet amount</td>
                                            <td>£{{$studentWithdrawal->wallet_balance}}</td>
                                        </tr>

                                        <tr>
                                            <td>Withdraw Amount</td>
                                            <td>£{{$studentWithdrawal->amount}}</td>
                                        </tr>
                                        <tr>
                                            <td>Request Date</td>
                                            <td>{{\Carbon\Carbon::parse($studentWithdrawal->created_at)->format('d/m/Y')}}</td>
                                        </tr>

                                        <tr>
                                            <td>Payment Method</td>
                                            <td>
                                                @if($studentWithdrawal->student->payment_method->default_payment == 'UPI')
                                                    UPI: {{$studentWithdrawal->student->payment_method->upi_id}}
                                                @elseif($studentWithdrawal->student->payment_method->default_payment == 'BANK')
                                                    <table>
                                                        <tr>
                                                            <td>Account Holder Name</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->account_holder_name}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Bank Name</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->bank_name}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Branch Name</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->branch}}</td>
                                                        </tr>


                                                        <tr>
                                                            <td>Account Number</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->account_no}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>IFSC Code</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->ifsc_code}}</td>
                                                        </tr>
<!--------->




                                                        <tr>
                                                            <td>Short Code</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->short_code}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>IBN Number</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->ibn_number}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Country</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->country}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>State</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->state}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>City</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->city}}</td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td>Zip Code</td>
                                                            <td>{{$studentWithdrawal->student->payment_method->zip_code}}</td>
                                                        </tr>


                                                    </table>
                                                    
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <td>
                                                <div style="display: flex;">
                                                @if($studentWithdrawal->status == 'PENDING')
                                                    <form action="{{route('accept_withdraw_requests',[$studentWithdrawal->id])}}" method="POST">
                                                        @csrf
                                                        <button type="submit" name="ACCEPT" class="btn btn-primary me-2">Accept</button>
                                                    </form>
                                                    <form id="rejectForm" action="{{route('decline_withdraw_requests',[$studentWithdrawal->id])}}" method="POST">
                                                    @csrf
                                                        <button type="button" id="reject" name="REJECT" class="btn btn-danger me-2">Reject</button>
                                                    </form>
                                                @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if ($studentWithdrawal->status == 'COMPLETED')
                                                    <button type="button" class="btn btn-success me-2" disabled>Completed</button>
                                                @elseif($studentWithdrawal->status == 'DECLINED')
                                                    <button type="button" class="btn btn-danger me-2" disabled>Declined</button>
                                                @endif 
                                                <a href="{{route('withdraw_request_view')}}" class="btn btn-primary me-2">Back</a>
                                            </td>
                                        </tr>
                                        
                                       
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="reason">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="modal-body">
                <textarea placeholder="Reason for rejection" class="form-control" id="remark"></textarea>
                <div id="error"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitReject">Submit</button>
                <button type="button" class="btn btn-danger closebtn">Cancel</button>
            </div>

        </div>
    </div>
</div>
<script> 
$(document).ready(function(){

    $('#reject').click(function(){
        $("#reason").modal('show');

    });
    $('.closebtn').click(function(){
        $("#reason").modal('hide');

    })

    $('#submitReject').click(function(){
        if($("#remark").val() ==''){
            $("#error").html('<div style="color:red;">Please enter reason first</div>'); 
        }else{
            var inputRowHTML = '<input name="remark" type="text"  placeholder="New Field" value="'+$("#remark").val()+'"/>';
            $("#rejectForm").prepend(inputRowHTML);
            $("#rejectForm").submit();
        }
    })
    

})
</script>

@endsection