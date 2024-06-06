@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create <small>Tutor</small></h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('tutor.store')}}">
                        @csrf
                        @method('PUT')
                        @include ('student.form', [
                        'student' => $student,
                        ])
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
        required:true,
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