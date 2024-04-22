<form id="quickForm" method="POST" action="{{$formAction}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">


        

          
        <div class="form-group">

            <label>Website</label>

            <select name="website_type" class="form-control">

                <option value="">Select website</option>

                @if(!empty($websites))

                @foreach($websites as $website1)

                <option value="{{$website1->website_type}}" @if($data->website_type == $website1->website_type) selected @endif>{{$website1->website_type }}</option>

                @endforeach

                @endif

            </select>
            @error('website_type')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Page Title</label>
            <input type="text" name="page_title" class="form-control" placeholder="" value="{{$data->page_title}}">
        </div>
        <div class="form-group">
            <label>Page Description</label>
            <textarea id="summernote" name="page_desc" class="form-control">{{$data->page_desc}}</textarea>
            @error('page_desc')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="">Select</option>
                <option value="1" @if($data->status=='1') {{ 'selected'; }} @endif >Active</option>
                <option value="0" @if($data->status=='0') {{ 'selected'; }} @endif >Not Active</option>
            </select>
        </div>

        <h4>SEO Settings</h4>
        <hr>
        <div class="form-group">
            <label>SEO Title</label>
            <input type="text" name="seo_title" class="form-control" placeholder="" value="{{$data->seo_title}}">
        </div>
        <div class="form-group">
            <label>Friendly URL</label>
            <input type="text" name="seo_url_slug" class="form-control" placeholder="" value="{{$data->seo_url_slug}}">
        </div>
        <div class="form-group">
            <label>Meta Description</label>
            <textarea id="seo_description" name="seo_description" class="form-control">{{$data->seo_description}}</textarea>
        </div>
        <div class="form-group">
            <label>Meta Keywords</label>
            <input type="text" name="seo_keywords" class="form-control" placeholder="" value="{{$data->seo_keywords}}">
        </div>
        <div class="form-group">
            <label>Meta Tags</label>
            <textarea id="seo_meta" name="seo_meta" class="form-control">{{$data->seo_meta}}</textarea>
            <p class="help-block">ex. &lt;meta name="description" content="We sell products that help you" /&gt;</p>
        </div>

        <div class="form-group">
            <label>Og Image</label>
            <input type="file" name="og_image">
        </div>

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Save and Next</button>
        <a href="{{route('pages')}}" class="btn btn-primary">Back</a>
    </div>
</form>
<script>
    $(document).ready(function() {
      if (location.hash) {
        console.log('location.hash', location.hash)
        var tabID = location.hash;
        $('.nav-tabs button[data-target="' + tabID + '"]').tab('show');
      }
      $(document.body).on("click", "button[data-toggle='tab']", function(event) {
        location.hash = this.getAttribute("data-target");
      });
    });
    $(window).on("popstate", function() {
      var anchor = location.hash || $("button[data-toggle='tab']").first().attr("data-target");
      $("button[data-target='" + anchor + "']").tab("show");
    });
  </script>