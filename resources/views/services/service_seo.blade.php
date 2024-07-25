<div class="card">
    <div class="card-body">
        <form id="quickForm" method="POST" action="{{route('services.store.seo')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
            <div class="form-group">
                <label>H1 Tag</label>
                <input type="text" name="seo_title" class="form-control" placeholder=""
                    value="{{old('seo_title',@$service->seo->seo_title)}}">
                @error('seo_title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Meta Keywords</label>
                <input type="text" name="seo_keywords" class="form-control" placeholder=""
                    value="{{old('seo_keywords',@$service->seo->seo_keywords)}}">
                @error('seo_keywords')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="seo_url_slug" class="form-control" placeholder=""
                    value="{{old('seo_url_slug',@$service->seo->seo_url_slug)}}">
                @error('seo_url_slug')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Meta Title</label>
                <input type="text" name="seo_meta" class="form-control" placeholder=""
                    value="{{old('seo_meta', @$service->seo->seo_meta)}}">
                @error('seo_meta')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>



            <div class="form-group">
                <label>Meta Description</label>
                <textarea id="seo_description" name="seo_description"
                    class="form-control">{{old('seo_description',@$service->seo->seo_description)}}</textarea>
                @error('seo_description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <div><img src="{{@$service->seo->og_image}}" width="100px" /></div>
                <label>OG Image</label>
                <input type="file" name="og_image" class="form-control" placeholder="">
                @error('og_image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Button Title</label>
                <input type="text" name="button_title" class="form-control" placeholder=""
                    value="{{ old('button_title', @$service->seo->button_title ) }}">
                @error('button_title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <?php /*<div class="form-group">
                <label>Button Url</label>
                <input type="text" name="button_url" class="form-control" placeholder=""
                    value="{{ old('button_url', @$service->seo->button_url ) }}">

                @error('button_url')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>*/ ?>

            @if(Request::route('id'))
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save and Next</button>
                <a href="{{route('services_index')}}" class="btn btn-primary">Back</a>
            </div>
            @endif

        </form>
    </div>
</div>