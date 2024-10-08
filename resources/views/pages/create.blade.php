@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.min.css') }}">
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add <small>Page</small></h3>
          </div>
          <form id="quickForm" method="POST" action="{{route('pages.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Website</label>
                <select name="website_type" class="form-control">
                  <option value="">Select website</option>
                  @if(!empty($websites))
                  @foreach($websites as $website1)
                  <option value="{{$website1->website_type}}" @if(old("website_type")==$website1->website_type) selected @endif>{{$website1->website_type }}</option>
                  @endforeach
                  @endif
                </select>
                @error('website_type')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label>Page Title</label>
                <input type="text" name="page_title" class="form-control" placeholder="" value="{{old('page_title')}}">
                @error('page_title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>



              <div class="form-group">

                <label>Page Description</label>

                <textarea id="summernote" name="page_desc" class="form-control">{{old('page_desc')}}</textarea>

                @error('page_desc')

                <small class="text-danger">{{ $message }}</small>

                @enderror

                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="">Select</option>
                    <option value="1" @if(old('status')=='1' ) selected="selected" @endif>Active</option>
                    <option value="0" @if(old('status')=='0' ) selected="selected" @endif>Not Active</option>
                  </select>
                  @error('status')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>


              </div>
              <h4>SEO Settings</h4>
              <hr>
              <div class="form-group">
                <label>SEO Title</label>
                <input type="text" name="seo_title" class="form-control" placeholder="" value="{{old('seo_title')}}">
                @error('seo_title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label>Friendly URL</label>
                <input type="text" name="seo_url_slug" class="form-control" placeholder="" value="{{old('seo_url_slug')}}">
                @error('seo_url_slug')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label>Meta Description</label>
                <textarea id="seo_description" name="seo_description" class="form-control">{{old('seo_description')}}</textarea>
                @error('seo_description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label>Meta Keywords</label>
                <input type="text" name="seo_keywords" class="form-control" placeholder="" value="{{old('seo_keywords')}}">
                @error('seo_keywords')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label>Meta Tags</label>
                <textarea id="seo_meta" name="seo_meta" class="form-control">{{old('seo_meta')}}</textarea>
                <p class="help-block">ex. &lt;meta name="description" content="We sell products that help you" /&gt;</p>
                @error('seo_meta')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label>Og Image</label>
                <input type="file" name="og_image">
                @error('og_image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>



            <div class="card-footer">

              <button type="submit" class="btn btn-primary">Submit</button>

              <a href="{{route('pages')}}" class="btn btn-primary">Back</a>

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
        page_desc: {
          required: true
        },
        page_title: {
          required: true
        },
        seo_url_slug: {
          required: true
        },
        seo_title: {
          required: true
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

<script>
  $(function() {

    // Summernote

    $('#summernote').summernote()

  })
</script>

@endsection