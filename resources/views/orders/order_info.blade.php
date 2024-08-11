<div class="col-md-3">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <h3 class="profile-username text-center">Order Details</h3>
            <p class="text-muted text-center">{{ isset($data['student']['first_name']) ? $data['student']['first_name'] : '' }} {{ isset($data['student']['last_name']) ? ' ' . $data['student']['last_name'] : '' }}
            </p>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Website</b> <a class="float-right">{{$data['website']['website_name']}}</a>
                </li>
                <li class="list-group-item">
                    <b>Subject</b> <a class="float-right">@if(isset($data['subject']) &&
                        isset($data['subject']['subject_name']) && $data['subject']['subject_name'])
                        {{$data['subject']['subject_name']}}
                        @else
                        {{@$data['subject_name']}}
                        @endif</a>
                </li>
                <li class="list-group-item">
                    <b>No Of Words</b> <a class="float-right">{{$data['no_of_words']}}</a>
                </li>
                <li class="list-group-item">
                    <b>Amount</b> <a class="float-right">{{$data['price']}}</a>
                </li>
                <li class="list-group-item">
                    <b>Currency</b> <a class="float-right">{{$data['currency_code']}}</a>
                </li>
                <li class="list-group-item">
                    <b>Delivery Date</b> <a class="float-right">{{date('m-d-Y', strtotime($data['delivery_date']))}}</a>
                </li>
                <li class="list-group-item">
                    <b>Student's Attachment</b> 
                    <p><a target="_blank" class="float-right1" href="{{$data['fileupload']}}"
                        style="overflow-wrap: anywhere;">View attachment</a></p>
                </li>

                @if(isset($data['teacherAssigned']) && $data['teacherAssigned']['status'] == 'COMPLETED')
                <li class="list-group-item">
                    <b>Teacher's Attachment</b> <p><a target="_blank" class="float-right1"
                        href="{{$data['teacherAssigned']['attachment']}}" class="float-right"
                        style="overflow-wrap: anywhere;">View attachment</a></p>
                </li>
                @endif

                @if(isset($data['qcAssigned']) && $data['qcAssigned']['status'] == 'COMPLETED')
                <li class="list-group-item">
                    <b>Qc's Attachment</b> <p><a target="_blank" class="float-right1"
                        href="{{$data['teacherAssigned']['attachment']}}" class="float-right"
                        style="overflow-wrap: anywhere;">View attachment</a></p>
                </li>
                @endif




                @if(isset($data['teacherAssigned']))
                <li class="list-group-item">
                    <b>Tutor Budget</b> <a class="float-right">{{$data['teacherAssigned']['tutor_price']}}
                        {{$data['currency_code']}}</a>
                </li>
                @endif
                @if(isset($data['qcAssigned']))
                <li class="list-group-item">
                    <b>Qc Budget</b> <a class="float-right">{{$data['qcAssigned']['qc_price']}}
                        {{$data['currency_code']}}</a>
                </li>
                @endif


            </ul>

            @if(isset($type) && $type == 'TUTOR' && !$orderAssign && isset($orderRequestSent) &&
            $orderRequestSent->status == 'ACCEPTED')
            <form method="POST" action="{{route('submit_budget',['id'=>$orderRequestSent->id])}}">
                @csrf
                <div class="form-group">
                    <label for="inputEstimatedBudget">Tutor Final budget</label>
                    <input type="number" id="inputEstimatedBudget" class="form-control" name="final_budget_amount">
                    @error('final_budget_amount')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <input type="submit" name="final_budget" value="Approved" class="btn btn-success float-right">
            </form>
            @endif

            @if(isset($type) && $type == 'QC' && !$orderAssign && isset($orderRequestSent) && $orderRequestSent->status
            == 'ACCEPTED')
            <form method="POST" action="{{route('submit_budget',['id'=>$orderRequestSent->id])}}">
                @csrf
                <div class="form-group">
                    <label for="inputEstimatedBudget">Qc Final budget</label>
                    <input type="number" id="inputEstimatedBudget" class="form-control" name="final_budget_amount">
                    @error('final_budget_amount')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <input type="submit" name="final_budget" value="Approved" class="btn btn-success float-right">
            </form>
            @endif


            
            @if(isset($data['teacherAssigned']) && $data['teacherAssigned']['status'] == 'COMPLETED' &&
            isset($data['qcAssigned']) && $data['qcAssigned']['status'] == 'COMPLETED')
                
                @if($data['status'] !='DELIVERED')
                <form method="POST" action="{{route('deliver_to_student',['id'=>$data['id']])}}">
                    @csrf
                    <button type="submit" class="btn btn-success float-right">
                        Deliver to Student
                    </button>
                </form>
                @else
                <h5 style="text-align: center;">Delivered to Student</h5>
                @endif

            @endif

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>