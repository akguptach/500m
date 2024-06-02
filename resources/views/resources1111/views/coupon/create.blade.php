@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create <small>Subject(Only For Assignment)</small></h3>
          </div>
          <form id="quickForm" method="POST" action="{{route('subject.store')}}">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Subject Name</label>
                <input type="text" name="subject_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Subject Name" value="{{old('subject_name')}}">

              </div>
              @error('subject_name')
              <small class="text-danger">{{ $message }}</small>
              @enderror
              <div class="form-group">
                <label for="exampleInputEmail1">Price ( Is set according to minimum words in website manager )</label>
                <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="Enter Price" value="{{old('price')}}">
              </div>
              @error('price')
              <small class="text-danger">{{ $message }}</small>
              @enderror

              <div class="form-group">
                <label for="exampleInputEmail1">Additional Per Word Rate</label>
                <input type="text" name="additional_word_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Per Word Rate" value="{{old('additional_word_rate')}}">
              </div>
              @error('additional_word_rate')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{route('subject.index')}}" class="btn btn-primary">Back</a>
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