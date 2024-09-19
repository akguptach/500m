@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Edit <small>Subject(Only For Assignment)</small></h4>

          </div>
          <div class="card-body">
            <div class="form-validation">
              <form id="quickForm" method="POST" action="{{$formAction}}">
              @csrf
              @method('PUT')
                <div class="row">
                  <div class="col-xl-6">
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Subject Name
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" class="form-control" name="subject_name" placeholder="Enter Subject Name" value="{{$data->subject_name}}" required>
                        @error('subject_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Price
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="number" class="form-control" name="price" id="" placeholder="Enter Price" value="{{$data->price}}" required>
                        @error('price')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Additional Per Word Rate <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="number" min="0" 
                        max="1000" step="0.01" class="form-control" name="additional_word_rate" placeholder="Enter Per Word Rate" required value="{{$data->additional_word_rate}}">
                        @error('additional_word_rate')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                <a href="{{route('subject.index')}}" class="btn btn-primary">Back</a>
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
        subject_name: {
          required: true,
        },
        price: {
          required: true,
          number: true
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