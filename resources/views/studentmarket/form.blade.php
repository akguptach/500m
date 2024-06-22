

<style>
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: .25rem;
    font-size: 80%;
    color: #dc3545;
}
</style>
<div class="mb-3 row">
    <label for="category_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Category Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="category_name" type="text" id="category_name" value="{{ old('category_name', optional($dealCategory)->category_name) }}" minlength="1" placeholder="Enter category name here...">
        {!! $errors->first('category_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="rating" class="col-form-label text-lg-end col-lg-2 col-xl-3">Website Type</label>
    <div class="col-lg-10 col-xl-9">
        {{ HtmlHelper::WebsiteDropdown('website_type', old('website_type', optional($dealCategory)->website_type), false, '', 'website_type') }}
        {!! $errors->first('website_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="rating" class="col-form-label text-lg-end col-lg-2 col-xl-3">Status</label>
    <div class="col-lg-10 col-xl-9">
    <select name="status" class="form-control" id="status">
    <option value="active">Active</option>
    <option value="inactive">Inactive</option>
  </select>    
    </div>
</div>










