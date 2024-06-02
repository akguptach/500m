@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit <small>Study Label</small></h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{$formAction}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Study Label Name</label>
                                    <input type="text" name="label_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Study Label Name" value="{{$data->label_name}}">
                                </div>
                                @error('label_name')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror								<div class="form-group">                                    <label for="exampleInputEmail1">Price</label>                                    <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="Enter Price" value="{{$data->price}}">                                </div>                                @error('price')                                  <div class="alert alert-danger">{{ $message }}</div>                                @enderror							</div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('studylabel.index')}}" class="btn btn-primary">Back</a>
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
      label_name: {
        required: true,
      },	  price: {        required: true,      },
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