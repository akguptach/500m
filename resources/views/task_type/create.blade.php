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
                            <form id="quickForm" method="POST" action="{{route('tasktype.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="">Task Type Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="type_name" placeholder="Enter task type name" value="{{old('type_name')}}" required>
                                                @error('type_name')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="">Price Type
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                {{ HtmlHelper::PriceTypeDropdown('website_type',old('website_type'),false,'','') }}
                                                @error('website_type')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="">Price(%) <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" name="price" class="form-control" placeholder="Enter price Name" value="{{old('price')}}" required>
                                                @error('price')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="">Status
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control"  name="status">
                                                    <option selected="selected" value="">Please select status</option>
                                                    <option value="active" <?php if (old('status') == 'active') {
                                                                                echo 'selected';
                                                                            } ?>>Active</option>
                                                    <option value="inactive" <?php if (old('status') == 'inactive') {
                                                                                    echo 'selected';
                                                                                } ?>>Inactive</option>
                                                </select>
                                                @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-xl-6">



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
    </div>
</section>
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    $(function() {
        $('#quickForm').validate({
            rules: {
                type_name: {
                    required: true,
                },
                website_type: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true
                },
                status: {
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