<div class="col-md-3">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <h3 class="profile-username text-center">Order Details11</h3>
            <p class="text-muted text-center">{{ $data['student']['first_name'] . ' ' . $data['student']['last_name'] }}
            </p>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Website</b> <a class="float-right">{{$data['website']['website_name']}}</a>
                </li>
                <li class="list-group-item">
                    <b>Subject11</b> <a class="float-right"></a>
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
                    <b>Student's Attachment</b> <a target="_blank" class="float-right" href="{{$data['fileupload']}}"
                        style="overflow-wrap: anywhere;">{{$data['fileupload']}}</a>
                </li>




                @if(isset($data['teacherAssigned']) && $data['teacherAssigned']['status'] == 'COMPLETED')
                <li class="list-group-item">
                    <b>Teacher's Attachment--</b> <a target="_blank" class="float-right"
                        href="{{$data['teacherAssigned']['attachment']}}" class="float-right"
                        style="overflow-wrap: anywhere;">{{$data['teacherAssigned']['attachment']}}</a>
                </li>
                @endif

                @if(isset($data['qcAssigned']) && $data['qcAssigned']['status'] == 'COMPLETED')
                <li class="list-group-item">
                    <b>Qc's Attachment--</b> <a target="_blank" class="float-right"
                        href="{{$data['teacherAssigned']['attachment']}}" class="float-right"
                        style="overflow-wrap: anywhere;">{{$data['qcAssigned']['attachment']}}</a>
                </li>
                @endif

                @if(isset($data['teacherAssigned']) && $data['teacherAssigned']['status'] == 'COMPLETED' && isset($data['qcAssigned']) && $data['qcAssigned']['status'] == 'COMPLETED')

                <button type="submit" name="final_budget" value="Deliver to Student" class="btn btn-success float-right">

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


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>