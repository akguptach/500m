@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit <small>Website</small></h3>
          </div>
          <form id="quickForm" method="POST" action="{{$formAction}}">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                {{ HtmlHelper::WebsiteDropdown('website_type',($data->website_type)?$data->website_type:old('website_type')) }}
              </div>
              <div class="form-group">
                <label>Website Name</label>
                <input type="text" name="website_name" class="form-control" placeholder="Enter Website Name" value="{{$data->website_name}}">

              </div>
              @error('website_name')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <div class="form-group">
                <label>Contact Person Name</label>
                <input type="text" name="person_name" class="form-control" placeholder="Enter Contact Person Name" value="{{$data->person_name}}">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{$data->email}}">
              </div>
              <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile Number" value="{{$data->mobile_no}}">
              </div>

              <div class="form-group">
                <label>Minimum Words Rate(Only For SOP)</label>
                <input type="number" name="price" class="form-control" placeholder="Enter price" value="{{$data->price}}">
              </div>
              <div class="form-group">
                <label>Additional Words Rate(Only For SOP)</label>
                <input type="number" name="additional_words" class="form-control" placeholder="Enter additional words" value="{{$data->additional_words}}">
              </div>
              <div class="form-group">
                <label>Minimum No.of words</label>
                <input type="number" name="no_words" class="form-control" placeholder="Enter no.of words" value="{{$data->no_words}}">
              </div>

              <div class="form-group">
                <label>Currnecy</label>
                <select name="currency" class="form-control">
                  <option value="">Select currency</option>
                  @if(!empty($currencies))
                  @foreach($currencies as $currency1)
                  <option value="{{$currency1->currency}}" @if($data->currency == $currency1->currency) selected @endif>{{$currency1->currency}}</option>
                  @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label>Currnecy Sign</label>
                <input type="text" name="currency_sign" class="form-control" placeholder="Enter Currency Sign" value="{{$data->currency_sign}}">
              </div>
              <div class="form-group">
                <label>Txn fee (%)</label>
                <input type="text" name="txn_fee" class="form-control" placeholder="Enter txn fee" value="{{$data->txn_fee}}">
              </div>
              <div class="form-group">
                <label>Admin commission (%)</label>
                <input type="text" name="admin_commission" class="form-control" placeholder="Enter admin commission" value="{{$data->admin_commission}}">
              </div>
              <div class="form-group">
                <label>Order Number Prefix</label>
                <input type="text" name="order_prefix" class="form-control" placeholder="Enter Order Prefix" value="{{$data->order_prefix}}">
                @error('order_prefix')<small class="text-danger">{{ $message }}</small>@enderror
              </div>
              <div class="form-group">
                <label>Order Number Starting From</label>
                <input type="text" name="order_padding" class="form-control" placeholder="Enter Order Padding Number" value="{{$data->order_padding}}"> @error('order_padding') <small class="text-danger">{{ $message }}</small>@enderror
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control select2" style="width: 100%;" name="status">
                  <option selected="selected" value="">Please Select Status</option>
                  <option value="active" @if($data->status == 'active') selected @endif>Active</option>
                  <option value="inactive" @if($data->status == 'inactive') selected @endif>Inactive</option>
                </select>
              </div>
              <h4>Website Day Wise Price</h4>
              <hr>
              <div class="form-group">
                <label>Subject Price(%)</label>
                <input type="text" name="subject_price" class="form-control" placeholder="Enter Suject Price" value="{{$data->subject_price}}">
                <small class="text-muted">Example: 10,-10</small>
              </div>
              <div class="form-group">
                <label>Day Wise Price(%)</label>
                <input type="text" name="website_price" class="form-control" placeholder="Enter Website Price day wise" value="{{$data->website_price}}">
                <small class="text-muted">Example: 12Hours:200,1day:180,2day:170</small>
              </div>
              <h4>Website Admin Login Credentials</h4>

              <hr>
              <div class="form-group">
                <label>Admin Username</label>
                <input type="text" name="login_username" class="form-control" placeholder="Enter Website Login UserName" value="{{$data->login_username}}">
              </div>
              <div class="form-group">
                <label>Admin Password</label>
                <input type="text" name="login_password" class="form-control" placeholder="Enter Website Login Password" value="{{old('login_password')}}">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{route('website.index')}}" class="btn btn-primary">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
  $(function() {
    $('#quickForm').validate({
      rules: {
        website_name: {
          required: true,
          url: true
        },
        person_name: {
          required: true,
          maxlength: 150,
          minlength: 2
        },
        email: {
          required: true,
          email: true
        },
        mobile_no: {
          required: true,
          number: true
        },
        website_type: {
          required: true,
        },
        price: {
          required: true,
          number: true
        },
        no_words: {
          required: true,
          number: true
        },
        additional_words: {
          required: true,
          number: true
        },
        currency: {
          required: true,
        },
        txn_fee: {
          required: true,
          number: true
        },
        admin_commission: {
          required: true,
        },
        status: {
          required: true,
        },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
@endsection