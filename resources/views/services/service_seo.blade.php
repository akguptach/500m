<div class="card">
    <div class="card-body">
        <form id="quickForm" method="POST" action="{{route('services.store.seo')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
            <div class="form-group">
                <label>Seo Title</label>
                <input type="text" name="seo_title" class="form-control" placeholder="" value="{{old('seo_title')}}">
                @error('seo_title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Seo Keywords</label>
                <input type="text" name="seo_keywords" class="form-control" placeholder="" value="{{old('seo_keywords')}}">
                @error('seo_keywords')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Seo Url</label>
                <input type="text" name="seo_url_slug" class="form-control" placeholder="" value="{{old('seo_url_slug')}}">
                @error('seo_url_slug')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Seo Meta</label>
                <input type="text" name="seo_meta" class="form-control" placeholder="" value="{{old('seo_meta')}}">
                @error('seo_meta')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>



            <div class="form-group">
                <label>Seo Description</label>
                <textarea id="seo_description" name="seo_description" class="form-control">{{old('seo_description')}}</textarea>
                @error('seo_description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Seo OG Image</label>
                <input type="text" name="og_image" class="form-control" placeholder="" value="{{old('og_image')}}">
                @error('og_image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            @if(Request::route('id'))
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit and Next</button>
                <a href="{{route('pages')}}" class="btn btn-primary">Back</a>
            </div>
            @endif

        </form>
    </div>
</div>