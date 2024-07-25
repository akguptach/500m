<div class="card-body">

    <div class="mb-3 row">
        <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Name</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name"
                value="{{ old('name', optional($serviceKeyword)->name) }}" minlength="1" maxlength="255"
                placeholder="Enter name here...">
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="mb-3 row">
        <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Active</label>
        <div class="col-lg-10 col-xl-9">
            <input style="margin-top: 8px;" class="l{{ $errors->has('status') ? ' is-invalid' : '' }}" 
            name="status" type="checkbox" value="1"
                id="status" @if(old('status', optional($serviceKeyword)->status) == 1) checked="checked" @endif >
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>