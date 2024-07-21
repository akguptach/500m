@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.min.css') }}">
<!-- Bootstrap Datepicker CSS CDN -->
<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
<section class="content">
  <div class="container-fluid">
    <!-- row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Edit <small>Blog</small></h4>
          </div>
          <div class="card-body">
            <div class="form-validation">
              <form id="quickForm" novalidate method="POST" action="{{$formAction}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-xl-6">
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Website
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <select name="website_id" class="default-select wide form-control">
                          <option value="">Select website</option>
                          @if(!empty($websites))
                          @foreach($websites as $website1)
                          <option value="{{$website1->id}}" @if($data->website_id==$website1->id) selected @endif>{{$website1->website_type }}</option>
                          @endforeach
                          @endif
                        </select>
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="validationCustom01">Blog Title
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="text" required name="blog_title" class="form-control" placeholder="Blog Title" value="{{$data->blog_title}}">
                        @error('blog_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="">Category
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <select name="category_id" class="default-select wide form-control">
                          <option value="">Select Category</option>
                          @if(!empty($categories))
                          @foreach($categories as $category)
                          <option value="{{$category->id}}" @if($data->category_id==$category->id) selected @endif>{{$category->category_name}}</option>
                          @endforeach
                          @endif
                        </select>
                        <div class="invalid-feedback">
                          ....
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="validationCustom01">Blog Date
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="date" name="blog_date" onkeydown="return false" id="blog_date" class="form-control datepicker" placeholder="Select Blog Date" value="{{$data->blog_date}}" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-lg-4 col-form-label" for="validationCustom01">Image
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6">
                        <input type="file" class="form-control custom-file-input" id="exampleInputFile" name="blog_image">
                        <img src="<?= url('/') . '/' . $data->blog_image; ?>" style="width:75px;height:75px;">

                        @error('blog_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    
                  </div>
                  <div class="col-md-12">
                  <div class="mb-3 row">
                      <label class="col-lg-2 col-form-label" for="validationCustom01">Blog Description
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-10">
                        <textarea class="form-control" placeholder="Enter Blog Description" required id="ckeditor" name="blog_description">{{$data->blog_description}}</textarea>
                        @error('blog_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                <a href="{{route('blog.index')}}" class="btn btn-primary">Back</a>
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
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

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
    // $('#summernote').summernote();
    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy', // Adjust the format as needed
      autoclose: true,
    });
  });
</script>
<script>
	j$ = jQuery.noConflict();
	j$(function() {
		var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

		j$("#blog_date").datepicker({
			autoclose: true,
			startDate: today,
			todayBtn: 1, changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd', // Set the date format to yyyy-mm-dd
		}).on('change', function() {
			
		});

	});
</script>
@endsection