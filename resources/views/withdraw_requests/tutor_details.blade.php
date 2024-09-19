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
                                            <td>Tutor Name</td>
                                            <td>{{$tutorWithdrawal->tutor->tutor_first_name}} {{$tutorWithdrawal->tutor->tutor_last_name}}</td>
                                        </tr>

                                        <tr>
                                            <td>Total Wallet amount</td>
                                            <td>£{{$tutorWithdrawal->balance}}</td>
                                        </tr>

                                        <tr>
                                            <td>Withdraw Amount</td>
                                            <td>£{{$tutorWithdrawal->amount}}</td>
                                        </tr>
                                        <tr>
                                            <td>Request Date</td>
                                            <td>{{\Carbon\Carbon::parse($tutorWithdrawal->created_at)->format('d/m/Y')}}</td>
                                        </tr>

                                        <tr>
                                            <td style="vertical-align: baseline;">Payment Method</td>
                                            <td>
                                                @php($bank=$tutorWithdrawal->tutor->bank)
                                                @php($address=$tutorWithdrawal->tutor->address)
                                                    <table>
                                                        <tr>
                                                            <td>Account Holder Name</td>
                                                            <td>{{$bank->account_holder_name}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Bank Name</td>
                                                            <td>{{$bank->bank_name}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>Branch Name</td>
                                                            <td>{{$bank->branch}}</td>
                                                        </tr>


                                                        <tr>
                                                            <td>Account Number</td>
                                                            <td>{{$bank->account_no}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>IFSC Code</td>
                                                            <td>{{$bank->ifsc_code}}</td>
                                                        </tr>
<!--------->




                                                        <tr>
                                                            <td>Short Code</td>
                                                            <td>{{$bank->short_code}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>IBN Number</td>
                                                            <td>{{$bank->ibn_number}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Country</td>
                                                            <td>{{$address->country}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td>State</td>
                                                            <td>{{$address->state}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>City</td>
                                                            <td>{{$address->city}}</td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td>Zip Code</td>
                                                            <td>{{$address->zip_code}}</td>
                                                        </tr>


                                                    </table>
                                                    
                                               
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <td>
                                                <div style="display: flex;">
                                                @if($tutorWithdrawal->status == 'PENDING')
                                                    <form action="{{route('tutor_accept_withdraw_requests',[$tutorWithdrawal->id])}}" method="POST">
                                                        @csrf
                                                        <button type="submit" name="ACCEPT" class="btn btn-primary me-2">Accept</button>
                                                    </form>
                                                    <form id="rejectForm" action="{{route('tutor_decline_withdraw_requests',[$tutorWithdrawal->id])}}" method="POST">
                                                    @csrf
                                                        <button type="button" id="reject" name="REJECT" class="btn btn-danger me-2">Reject</button>
                                                    </form>
                                                @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if ($tutorWithdrawal->status == 'COMPLETED')
                                                    <button type="button" class="btn btn-success me-2" disabled>Completed</button>
                                                @elseif($tutorWithdrawal->status == 'DECLINED')
                                                    <button type="button" class="btn btn-danger me-2" disabled>Declined</button>
                                                @endif 
                                                <a href="{{route('tutor_withdraw_request_view')}}" class="btn btn-primary me-2">Back</a>
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