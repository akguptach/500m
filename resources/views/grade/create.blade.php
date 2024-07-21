@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">

    <!-- row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Create Task Type</h4>

          </div>
          <div class="card-body">
            <div class="form-validation">
              <form id="quickForm" method="POST" action="{{route('grade.store')}}">
                @csrf
                <div class="row">
                  <div class="col-xl-6">

                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Grade Name<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="grade_name" class="form-control" required placeholder="Enter Grade Name" value="{{old('grade_name')}}">
                        @error('grade_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Price <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="number" class="form-control" value="{{old('price')}}" name="price" placeholder="Enter price" required>
                        @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>



                  </div>
                  <div class="col-xl-6">



                  </div>
                </div>
                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                <a href="{{route('grade.index')}}" class="btn btn-primary">Back</a>

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
        grade_name: {
          required: true,
        },
        price: {
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