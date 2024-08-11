@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">

    <!-- row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Edit <small>Tutor</small></h4>
          </div>
          <div class="card-body">
            <div class="form-validation">
              <form id="quickForm" method="POST" action="{{$formAction}}">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-xl-6">
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">First Name<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="tutor_first_name" class="form-control" placeholder="Enter first name" value="{{$data->tutor_first_name}}" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Last Name<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" name="tutor_last_name" class="form-control" placeholder="Enter last name" value="{{$data->tutor_last_name}}" required>
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for=""> Email<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="email" name="tutor_email" class="form-control" placeholder="Enter Email" value="{{$data->tutor_email}}" required>
                        @error('tutor_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Contact Number<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input ype="tel"  title="Please enter valid phone number"  name="tutor_contact_no" class="form-control" placeholder="Enter contact no" value="{{$data->tutor_contact_no}}" required>
                        @error('tutor_contact_no')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Subject<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <select class="default-select wide form-control select2" style="width: 100%;" name="tutor_subject" required>
                          <option selected="selected" value="">Please Select Subject</option>
                          @if(!empty($subjects))
                          @foreach ($subjects as $subject)
                          <option value="{{$subject->id}}" <?php if ($subject->id  == $subject->id) {
                                                              echo 'selected';
                                                            } ?>>{{$subject->subject_name}}</option>
                          @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Status
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <select class="default-select wide form-control" name="status" required>
                          <option selected="selected" value="">Please Select Status</option>
                          <option value="active" <?php if ($data->status == 'active') {
                                                    echo 'selected';
                                                  } ?>>Active</option>
                          <option value="inactive" <?php if ($data->status == 'inactive') {
                                                      echo 'selected';
                                                    } ?>>Inactive</option>
                          <option value="baned" <?php if ($data->status == 'baned') {
                                                  echo 'selected';
                                                } ?>>Baned</option>

                        </select>
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Password<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="password" name="password" class="form-control" id="" placeholder="Enter Password">
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                <a href="{{route('tutor_view.profile_status',['profile_status'=>'pending'])}}" class="btn btn-primary">Back</a>
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
        tutor_name: {
          required: true,
          maxlength: 150,
          minlength: 2
        },
        tutor_email: {
          required: true,
          email: true
        },
        tutor_mobile: {
          required: true,
          number: true
        },
        tutor_subject: {
          required: true
        },
        password: {
          minlength: 5
        }
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