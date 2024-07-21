@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">

    <!-- row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Create FAQ</h4>

          </div>
          <div class="card-body">
            <div class="form-validation">
              <form id="quickForm" method="POST" action="{{route('faq.store')}}">
                @csrf
                <div class="row">
                  <div class="col-xl-6">

                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Website
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <select name="website_id" class="default-select wide form-control" required>
                          <option value="">Select website</option>
                          @if(!empty($websites))
                          @foreach($websites as $website1)
                          <option value="{{$website1->id}}" @if(old("website_id")==$website1->id) selected @endif>{{$website1->website_type }}</option>
                          @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Question<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text"  name="question" class="form-control"placeholder="Enter Question" value="{{old('question')}}" required>
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Answer<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="answer" class="form-control"placeholder="Enter Answer" value="{{old('answer')}}" required>
                        <div class="invalid-feedback">
                          ..
                        </div>
                      </div>
                    </div>




                  </div>
                  <div class="col-xl-6">



                  </div>
                </div>
                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                <a href="{{route('faq.index')}}" class="btn btn-primary">Back</a>

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
        website_id: {
          required: true,
        },
        question: {
          required: true,
          minlength: 2
        },
        answer: {
          required: true,
          minlength: 2
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