@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit <small>Service Keyword</small></h3>
                    </div>
                    <form method="POST" class="needs-validation" novalidate action="{{ route('service_keywords.service_keyword.update', $serviceKeyword->id) }}" id="edit_service_keyword_form" name="edit_service_keyword_form" accept-charset="UTF-8" >
                        @csrf
                        @method('PUT')
                        @include ('service_keywords.form', [
                        'serviceKeyword' => $serviceKeyword,
                        ])
                        <div class="mb-3 row">
                            <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3"></label>
                            <div class="col-lg-10 col-xl-9">
                                <input style="margin-left: 12px;" class="btn btn-primary" type="submit" value="Update">
                            </div>
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
    $('#create_service_keyword_form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 150,
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