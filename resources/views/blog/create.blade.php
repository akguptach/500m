@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.min.css') }}">
<!-- Bootstrap Datepicker CSS CDN -->
<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create <small>Blog</small></h3>
          </div>
          <form id="quickForm" method="POST" action="{{route('blog.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Website</label>
                <select name="website_id" class="form-control">
                  <option value="">Select website</option>
                  @if(!empty($websites))
                  @foreach($websites as $website1)
                  <option value="{{$website1->id}}" @if(old("website_id")==$website1->id) selected @endif>{{$website1->website_type }}</option>
                  @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label>Blog Title</label>
                <input type="text" name="blog_title" class="form-control" placeholder="Enter Blog Title" value="{{old('blog_title')}}">
                @error('blog_title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control">
                  <option value="">Select Category</option>
                  @if(!empty($categories))
                  @foreach($categories as $category)
                  <option value="{{$category->id}}" @if(old("category_id")==$category->id) selected @endif>{{$category->category_name}}</option>
                  @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label>Blog date</label>
                <input type="text" name="blog_date" class="form-control datepicker" placeholder="Select Blog Date" value="{{old('blog_date')}}">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="blog_image">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                  </div>
                </div>
                @error('blog_image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label>Blog Description</label>
                <textarea id="summernote" name="blog_description">{{old("blog_description")}}</textarea>
                @error('blog_description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('blog.index')}}" class="btn btn-primary">Back</a>
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
        website_id: {
          required: true,
        },
        blog_title: {
          required: true,
          minlength: 2
        },
        blog_date: {
          required: true
        },
        category_id: {
          required: true,
        },
        blog_img: {
          required: true,
        },
        blog_desc: {
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
<script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>

<script>
  $(function() {
    // Summernote
    $('#summernote').summernote();
    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy', // Adjust the format as needed
      autoclose: true,
    });
  });
</script>
@endsection