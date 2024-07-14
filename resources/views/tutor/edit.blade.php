@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit <small>Tutor</small></h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{$formAction}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" name="tutor_first_name" class="form-control" placeholder="Enter first name" value="{{$data->tutor_first_name}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" name="tutor_last_name" class="form-control" placeholder="Enter last name" value="{{$data->tutor_last_name}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label >Email</label>
                                    <input type="email" name="tutor_email" class="form-control"  placeholder="Enter email" value="{{$data->tutor_email}}">
                                </div>
                                @error('tutor_email')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label >Contact no</label>
                                    <input type="text" name="tutor_contact_no" class="form-control"  placeholder="Enter contact no" value="{{$data->tutor_contact_no}}">
                                </div>
                                @error('tutor_contact_no')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label >Subject</label>
                                    <select class="form-control" style="width: 100%;" name="tutor_subject">
                                      <option selected="selected" value="">Please Select Subject</option>
                                      @if(!empty($subjects))
                                        @foreach ($subjects as $subject)
                                          <option value="{{$subject->id}}" @if($subject->id == $data->tutor_subject) selected
                                            @endif>{{$subject->subject_name}}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Status</label>
                                    <select class="form-control" style="width: 100%;" name="status">
                                      <option selected="selected">Please Select Status</option>
                                      <option value="active"  @if($data->status == 'active') selected
                                            @endif>Active</option>
                                      <option value="inactive"  @if($data->status == 'inactive') selected
                                            @endif>Inactive</option>
                                      <option value="baned"  @if($data->status == 'baned') selected
                                            @endif>Baned</option>     
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Password</label>
                                    <input type="password" name="password" class="form-control"  placeholder="Enter Password">
                                </div>
                                @error('password')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('tutor_view.profile_status',['profile_status'=>$data->profile_status])}}" class="btn btn-primary">Back</a>
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
      tutor_name: {
        required: true,
        maxlength:150,
        minlength:2
      },
      tutor_email: {
        required: true,
        email:true
      },
      tutor_mobile: {
        required: true,
        number:true
      },
      tutor_subject: {
        required: true
      },
      password: {
        minlength:5
      }
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