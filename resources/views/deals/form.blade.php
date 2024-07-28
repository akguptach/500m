
<div class="mb-3 row">
    <label for="title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Title</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" type="text" id="title" value="{{ old('title', optional($deal)->title) }}" minlength="1" maxlength="255" placeholder="Enter title here...">
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="image" class="col-form-label text-lg-end col-lg-2 col-xl-3">Image</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" type="number" id="image" value="{{ old('image', optional($deal)->image) }}" placeholder="Enter image here...">
        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="short_description" class="col-form-label text-lg-end col-lg-2 col-xl-3">Short Description</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('short_description') ? ' is-invalid' : '' }}" name="short_description" type="text" id="short_description" value="{{ old('short_description', optional($deal)->short_description) }}" minlength="1" placeholder="Enter short description here...">
        {!! $errors->first('short_description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="long_description" class="col-form-label text-lg-end col-lg-2 col-xl-3">Long Description</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('long_description') ? ' is-invalid' : '' }}" name="long_description" type="text" id="long_description" value="{{ old('long_description', optional($deal)->long_description) }}" minlength="1" placeholder="Enter long description here...">
        {!! $errors->first('long_description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="url" class="col-form-label text-lg-end col-lg-2 col-xl-3">Website Url</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" type="text" id="url" value="{{ old('url', optional($deal)->url) }}" minlength="1" placeholder="Enter Website url here...">
        {!! $errors->first('url', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="price" class="col-form-label text-lg-end col-lg-2 col-xl-3">Price</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" type="text" id="price" value="{{ old('price', optional($deal)->price) }}" minlength="1" placeholder="Enter price here...">
        {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="other_price" class="col-form-label text-lg-end col-lg-2 col-xl-3">Other Price</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('other_price') ? ' is-invalid' : '' }}" name="other_price" type="text" id="other_price" value="{{ old('other_price', optional($deal)->other_price) }}" minlength="1" placeholder="Enter other price here...">
        {!! $errors->first('other_price', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

