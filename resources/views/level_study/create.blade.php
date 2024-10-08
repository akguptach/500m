@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">

    <!-- row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Create level</h4>

          </div>
          <div class="card-body">
            <div class="form-validation">
              <form id="quickForm" method="POST" action="{{route('level_study.store')}}">
                @csrf
                <div class="row">
                  <div class="col-xl-6">
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Price Type
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        {{ HtmlHelper::PriceTypeDropdown('website_type',old('website_type'),false,'','') }}
                        @error('website_type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">
                          Please select a one.
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Level Name <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="level_name" class="form-control" placeholder="Enter Level Name" value="{{old('level_name')}}" required>
                        @error('level_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Additional Percentage Price <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="number" name="price" class="form-control" placeholder="Enter Price" value="{{old('price')}}" required>
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
                <a href="{{route('level_study.index')}}" class="btn btn-primary">Back</a>

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
        level_name: {
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