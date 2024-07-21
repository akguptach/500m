@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Edit <small>Role</small></h4>

          </div>
          <div class="card-body">
            <div class="form-validation">
              <form id="quickForm" method="POST"  action="{{$formAction}}">
              @csrf
              @method('PUT')
                <div class="row">
                  <div class="col-xl-6">
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Role Name<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="role_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Role Name" value="{{$data->role_name}}" required>
                        @error('role_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                <a href="{{route('role.index')}}" class="btn btn-primary">Back</a>
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
        role_name: {
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