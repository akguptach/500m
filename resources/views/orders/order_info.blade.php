<div class="col-md-3">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <h3 class="profile-username text-center">Order Details</h3>
            <p class="text-muted text-center">{{ $data['student']['first_name'] . ' ' . $data['student']['last_name'] }}</p>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Website</b> <a class="float-right">{{$data['website']['website_name']}}</a>
                </li>
                <li class="list-group-item">
                    <b>Subject</b> <a class="float-right">{{$data['subject']['subject_name']}}</a>
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
                    <b>Attachment</b> <a class="float-right">{{$data['fileupload']}}</a>
                </li>
            </ul>

            <a href="#" class="btn btn-block btn-success btn-lg"><b>Approved</b></a>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>