@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create <small>Role</small></h3>
          </div>
          <form id="quickForm" method="POST" action="{{route('role.store')}}">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Role Name</label>
                <input type="text" name="role_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Role Name" value="{{old('role_name')}}">

              </div>
              @error('role_name')
              <small class="text-danger">{{ $message }}</small>
              @enderror
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('role.index')}}" class="btn btn-primary">Back</a>
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