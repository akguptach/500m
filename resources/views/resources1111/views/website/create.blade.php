@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create <small>Website</small></h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('website.store')}}">
                            @csrf
                            <div class="card-body">
                              <div class="form-group">{{ HtmlHelper::WebsiteDropdown('website_type',old('website_type')) }}</div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Website name</label>
                                    <input type="text" name="website_name" class="form-control"  placeholder="Enter website name" value="{{old('website_name')}}">
                                    
                                </div>
                                @error('website_name')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label >Contact Person Name</label>
                                    <input type="text" name="person_name" class="form-control"  placeholder="Enter contact person name" value="{{old('person_name')}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Contact Person Email</label>
                                    <input type="email" name="email" class="form-control"  placeholder="Enter email" value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label>Contact Person Mobile number</label>
                                    <input type="text" name="mobile_no" class="form-control"  placeholder="Enter mobile number" value="{{old('mobile_no')}}">
                                </div>
                                
                                <div class="form-group">
                                    <label>Minimum Words Rate</label>
                                    <input type="number" name="price" class="form-control"  placeholder="Enter price" value="{{old('price')}}">
                                </div>								<div class="form-group">                                    <label >Additional Words Rate</label>                                    <input type="number" name="additional_words" class="form-control"  placeholder="Enter additional words" value="{{old('additional_words')}}">                                </div>
                                <div class="form-group">
                                    <label >Minimum No.of words</label>
                                    <input type="number" name="no_words" class="form-control"  placeholder="Enter no.of words" value="{{old('no_words')}}">
                                </div>
                                
                                <div class="form-group">
                                    <label >Currnecy</label>
                                    <select name="currency" class="form-control">
                                        <option value="">Select currency</option>
                                        @if(!empty($currencies))
                                          @foreach($currencies as $arrCurrency)
                                            <option value="{{$arrCurrency->currency}}"  @if(old("currency") == $arrCurrency->currency) selected @endif>{{$arrCurrency->currency}}</option>
                                          @endforeach
                                        @endif
                                    </select>
                                </div>								<div class="form-group">                                    <label >Currnecy Sign</label>                                    <input type="text" name="currency_sign" class="form-control"  placeholder="Enter Currency Sign" value="{{old('currency_sign')}}">                                </div>
                                <div class="form-group">
                                    <label >Txn fee (%)</label>
                                    <input type="text" name="txn_fee" class="form-control"  placeholder="Enter txn fee" value="{{old('txn_fee')}}">
                                </div>
                                <div class="form-group">
                                    <label >Admin commission (%)</label>
                                    <input type="text" name="admin_commission" class="form-control"  placeholder="Enter admin commission" value="{{old('admin_commission')}}">
                                </div>																<div class="form-group">                                    <label>Order Number Prefix</label>                                    <input type="text" name="order_prefix" class="form-control"  placeholder="Enter Order Prefix" value="{{old('order_prefix')}}">                                </div>								<div class="form-group">                                    <label>Order Number Starting From</label>                                    <input type="text" name="order_padding" class="form-control"  placeholder="Enter Order Padding Number" value="{{old('order_padding')}}">                                </div>								<div class="form-group">                                    <label >Status</label>                                    <select class="form-control select2" style="width: 100%;" name="status">                                      <option selected="selected" value="">Please select status</option>                                      <option value="active" <?php if(old('status') == 'active'){ echo 'selected';}?>>Active</option>                                      <option value="inactive" <?php if(old('status') == 'inactive'){ echo 'selected';}?>>Deactive</option>                                     </select>                                </div>								<h4>Website Admin Login Credentials</h4>								<hr>								<div class="form-group">                                    <label >Admin Username</label>                                    <input type="text" name="login_username" class="form-control"  placeholder="Enter Website Login UserName" value="{{old('login_username')}}">                                </div>								<div class="form-group">                                    <label>Admin Password</label>                                    <input type="text" name="login_password" class="form-control"  placeholder="Enter Website Login Password" value="{{old('login_password')}}">                                </div>
                                
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
    $(function () {
  $('#quickForm').validate({
    rules: {
      website_name: {
        required: true,
        url:true
      },
      person_name: {
        required: true,
        maxlength:150,
        minlength:2
      },
      email: {
        required: true,
        email:true
      },
      mobile_no: {
        required: true,
        number:true
      },
      website_type: {
        required: true,
      },
      price: {
        required: true,
        number:true
      },
      no_words: {
        required: true,
        number:true
      },
      additional_words: {
        required: true,
        number:true
      },
      currency: {
        required: true,
      },
      txn_fee: {
        required: true,
        number:true
      },
      admin_commission: {
        required: true,
      },
      status: {
        required: true,
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection