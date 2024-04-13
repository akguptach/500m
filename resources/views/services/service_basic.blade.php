<div class="card">
    <div class="card-body">
        <form id="basic" method="POST" action="{{route('services.store.basic')}}">
            @csrf
            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
            <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="service_name" class="form-control" placeholder="" value="{{ old('service_name', @$service->service_name ) }}">
                @error('service_name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Service Description</label>
                <textarea id="service_description" name="service_description" class="form-control">{{ old('service_description', @$service->service_description ) }}</textarea>
                @error('service_description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit and Next</button>
                <a href="{{route('services_index')}}" class="btn btn-primary">Back</a>
            </div>

        </form>
    </div>
</div>