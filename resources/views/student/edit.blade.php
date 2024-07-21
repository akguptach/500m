@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit <small>Student</small></h3>
                    </div>
                    <div class="card-body">
                        <form id="quickForm" method="POST"  action="{{route('students.student.update',$student->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="">First name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="first_name" placeholder="Enter First name" value="{{ old('first_name', optional($student)->first_name) }}" required>
                                            @error('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="">Last name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="last_name" placeholder="Enter Last name" value="{{ old('last_name', optional($student)->last_name) }}" required>
                                            @error('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="">Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email', optional($student)->email) }}" required>
                                            @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="">Contact no.
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number"  value="{{ old('phone_number', optional($student)->phone_number) }}" required>
                                            @error('phone_number')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="">Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" style="width: 100%;" name="status">
                                                <option selected="selected">Please Select Status</option>
                                                <option value="active" @if(old('status', optional($student)->status) == 'active') selected="selected" @endif>Active</option>
                                                <option value="inactive" @if(old('status', optional($student)->status) == 'inactive') selected="selected" @endif >Inactive</option>
                                            </select>
                                            @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn me-2 btn-primary">Submit</button>
                            <a href="{{route('tasktype.index')}}" class="btn btn-primary">Back</a>
                        </form>
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