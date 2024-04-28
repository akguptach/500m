<div class="card">
    <div class="card-body">
        <form id="basic" method="POST" action="{{route('services.store.basic')}}">
            @csrf
            <input type="hidden" name="service_id" value="{{Request::route('id') }}">

            <div class="form-group">
                <label>Website</label>
                <select name="website_type" class="form-control">
                    <option value="">Select website</option>
                    @if(!empty($websites))
                    @foreach($websites as $website)
                    <option value="{{$website->website_type}}" @if(old("website_type")==$website->website_type ||
                        @$service->website_type==$website->website_type) selected @endif>{{$website->website_type }}
                    </option>
                    @endforeach
                    @endif
                </select>
                @error('website_type')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="service_name" class="form-control" placeholder=""
                    value="{{ old('service_name', @$service->service_name ) }}">
                @error('service_name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="form-group">
                <label>Short Description</label>
                <textarea id="short_description" name="short_description"
                    class="form-control editor">{{ old('short_description', @$service->short_description ) }}</textarea>
                @error('short_description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>



            <div class="form-group">
                <label>Service Description</label>
                <textarea id="service_description" name="service_description"
                    class="form-control editor">{{ old('service_description', @$service->service_description ) }}</textarea>
                @error('service_description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="margin-top: 40px;">
                <label style="margin-top: 3px;margin-right: 10px;float: left;">Status</label>
                <label class="switch">
                    @if(@$service->status == 'ACTIVE')
                    <input type="checkbox" name="status" value="ACTIVE" checked>
                    @else
                    <input type="checkbox" name="status" value="ACTIVE">
                    @endif
                    <div class="slider round">
                        <!--ADDED HTML -->
                        <span class="on">Active</span>
                        <span class="off">Inactive</span>
                        <!--END-->
                    </div>
                </label>

                @error('status')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save and Next</button>
                <a href="{{route('services_index')}}" class="btn btn-primary">Back</a>
            </div>

        </form>
    </div>
</div>