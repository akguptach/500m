@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit <small>Task Type</small></h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{$formAction}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Task type name</label>
                                    <input type="text" name="type_name" class="form-control" id="exampleInputEmail1" placeholder="Enter type name" value="{{$data->type_name}}">
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label >Website type</label>
                                    <select class="form-control select2" style="width: 100%;" name="website_type">
                                      <option selected="selected" value="">Please select website type</option>
                                      <option value="Essay Help" @if($data->website_type == 'Essay Help') selected @endif>Essay Help</option>
                                      <option value="SOP" @if($data->website_type == 'SOP') selected @endif>SOP</option> 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Price(%)</label>
                                    <input type="number" name="price" class="form-control"  placeholder="Enter price" value="{{$data->price}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label >Status</label>
                                    <select class="form-control select2" style="width: 100%;" name="status">
                                      <option selected="selected" value="">Please select status</option>
                                      <option value="active" @if($data->status == 'active') selected @endif>Active</option>
                                      <option value="inactive" @if($data->status == 'inactive') selected @endif>Inactive</option> 
                                    </select>
                                </div>
                                @error('type_name')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('tasktype.index')}}" class="btn btn-primary">Back</a>
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
      type_name: {
        required: true,
      },
      website_type: {
        required: true,
      },
      price: {
        required: true,
        number:true
      },
      status: {
        required: true,
      },
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