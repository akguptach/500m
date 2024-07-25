@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- 
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
    </div> -->

    <!-- row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Edit <small>Website</h4>
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
            @endforeach
            @endif
          </div>
          <div class="card-body">
            <div class="form-validation">
              <form id="quickForm" method="POST" action="{{$formAction}}">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-xl-6">
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Website
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        {{ HtmlHelper::WebsiteDropdown('website_type',($data->website_type)?$data->website_type:old('website_type'),false) }}
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Website Name<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" class="form-control" name="website_name" placeholder="Enter website name" value="{{$data->website_name}}" required>
                        @error('website_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>




                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Contact Person Name<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="person_name" class="form-control" required placeholder="Enter contact person name" value="{{$data->person_name}}">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Contact Person Email<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="email" name="email" class="form-control" required placeholder="Enter email" value="{{$data->email}}">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Contact Person Mobile Number<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="tel" name="mobile_no"  pattern="[7-9]{1}[0-9]{9}" title="Please enter valid phone number"  class="form-control" placeholder="Enter mobile number" value="{{$data->mobile_no}}" required>

                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Minimum Words Rate<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="number" name="price" class="form-control" placeholder="Enter price" value="{{$data->price}}" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Additional Words Rate<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="number" name="additional_words" class="form-control" placeholder="Enter additional words" value="{{$data->additional_words}}" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Minimun No. of Words<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="number" name="no_words" class="form-control" placeholder="Enter no.of words" value="{{$data->no_words}}" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Currency
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <select name="currency" class="default-select wide form-control" required>
                          <option value="">Select currency</option>
                          @if(!empty($currencies))
                          @foreach($currencies as $arrCurrency)
                          <option value="{{$arrCurrency->currency}}" @if($data->currency == $arrCurrency->currency) selected @endif>{{$arrCurrency->currency}}</option>
                          @endforeach
                          @endif
                        </select>

                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Currency Sign<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="currency_sign" class="form-control" placeholder="Enter Currency Sign" value="{{$data->currency_sign}}" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Txn Fee(%)<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="number" name="txn_fee" class="form-control" placeholder="Enter txn fee" value="{{$data->txn_fee}}" required>
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Admin Commision(%)<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="number" name="admin_commission" class="form-control" placeholder="Enter admin commission" value="{{$data->admin_commission}}" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Order Number Prefix<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="order_prefix" class="form-control" placeholder="Enter Order Prefix" value="{{$data->order_prefix}}" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Order Number Starting From<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="order_padding" class="form-control" placeholder="Enter Order Padding Number" value="{{$data->order_padding}}" required>
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Status
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <select class="default-select wide form-control select2" name="status" id="status" required>
                          <option selected="selected" value="">Please select status</option>
                          <option value="active" <?php if ($data->status == 'active') {
                                                    echo 'selected';
                                                  } ?>>Active</option>
                          <option value="inactive" <?php if ($data->status == 'inactive') {
                                                      echo 'selected';
                                                    } ?>>Deactive</option>
                        </select>
                        <div class="invalid-feedback">
                          Please select a one.
                        </div>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <div class="col-lg-10">
                        <h5>Website Day Wise Price</h5>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Subject Price(%)<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                      <input type="text" name="subject_price" class="form-control" placeholder="Enter Suject Price" value="{{$data->subject_price}}">
                      <small class="text-muted">Example: 10,-10</small>
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Day Wise Price(%)<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                      <input type="text" name="website_price" class="form-control" placeholder="Enter Website Price day wise" value="{{$data->website_price}}">
                <small class="text-muted">Example: 12Hours:200,1day:180,2day:170</small>
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>






                    
                    <div class="mb-3 row">
                      <div class="col-lg-10">
                        <h5>WEBSITE ADMIN LOGIN CREDENTIALS</h5>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Admin Username<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" class="form-control" name="login_username" class="form-control" placeholder="Enter Website Login UserName" value="{{$data->login_username}}" required>
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Admin Password<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="login_password" class="form-control" placeholder="Enter Website Login Password" value="{{old('login_password')}}">
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                <a href="{{route('website.index')}}" class="btn btn-primary">Back</a>

              </form>
            </div>
          </div>
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