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
    <label for="title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Title</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" type="text" id="title"
            value="{{ old('title', optional($deal)->title) }}" minlength="1" maxlength="255"
            placeholder="Enter title here...">
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Category</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-control {{ $errors->has('deal_category') ? ' is-invalid' : '' }}" style="width: 100%;" name="deal_category">
            <option selected="selected" value="">Please Select Category</option>
            @if(!empty($dealCategories))
            @foreach ($dealCategories as $dealCategory)
            <option value="{{$dealCategory->id}}" @if(@$deal->deal_category == $dealCategory->id) selected="selected"
                @endif>{{$dealCategory->category_name}}</option>
            @endforeach
            @endif
        </select>
        {!! $errors->first('deal_category', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="rating" class="col-form-label text-lg-end col-lg-2 col-xl-3">Website Type</label>
    <div class="col-lg-10 col-xl-9">
        {{ HtmlHelper::WebsiteDropdown('website_type', old('website_type', optional(@$deal)->website_type), false, '', 'website_type') }}
        {!! $errors->first('website_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="image" class="col-form-label text-lg-end col-lg-2 col-xl-3">Image</label>
    <div class="col-lg-10 col-xl-9">
        <img src="{{ old('image', optional($deal)->image) }}" width="50px;"/>
        <input class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" type="file" id="image"
            value="{{ old('image', optional($deal)->image) }}" placeholder="Enter image here...">
        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="short_description" class="col-form-label text-lg-end col-lg-2 col-xl-3">Short Description</label>
    <div class="col-lg-10 col-xl-9">
        <textarea placeholder="Enter short description here..."
            class="form-control {{ $errors->has('short_description') ? ' is-invalid' : '' }}"
            name="short_description">{{ old('short_description', optional($deal)->short_description) }}</textarea>
        {!! $errors->first('short_description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="long_description" class="col-form-label text-lg-end col-lg-2 col-xl-3">Long Description</label>
    <div class="col-lg-10 col-xl-9">
        <textarea placeholder="Enter long description here..."
            class="editor form-control {{ $errors->has('long_description') ? ' is-invalid' : '' }}"
            name="long_description">{{ old('long_description', optional($deal)->long_description) }}</textarea>
        {!! $errors->first('long_description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="url" class="col-form-label text-lg-end col-lg-2 col-xl-3">Website url</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" type="text" id="url"
            value="{{ old('url', optional($deal)->url) }}" minlength="1" placeholder="Enter website url here...">
        {!! $errors->first('url', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


<div class="mb-3 row">
    <label for="price" class="col-form-label text-lg-end col-lg-2 col-xl-3">Price Type</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-control {{ $errors->has('price_type') ? ' is-invalid' : '' }}" name="price_type"
            id="price_type">
            <option value="">select</option>
            <option value="Price" @if( old('price_type', optional(@$deal)->price_type) == 'Price') selected="selected" @endif>Price</option>
            <option value="Voucher_Code" @if( old('price_type', optional(@$deal)->price_type) == 'Voucher_Code') selected="selected" @endif>Voucher Code</option>
        </select>
        {!! $errors->first('price_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


<div class="mb-3 row Price" style="display: none;">
    <label for="price" class="col-form-label text-lg-end col-lg-2 col-xl-3">Price and Offer Price</label>
    <div class="col-lg-10 col-xl-3">
        <label for="price" class="col-form-label" style="font-weight:normal;">Price</label>
        <input class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" type="number"
            id="price" value="{{ old('price', optional($deal)->price) }}" minlength="1" placeholder="Enter price">
        {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-lg-10 col-xl-3">
        <label for="offer_price" class="col-form-label" style="font-weight:normal;">Offer Price</label>
        <input class="form-control {{ $errors->has('offer_price') ? ' is-invalid' : '' }}" name="offer_price"
            type="number" id="offer_price" value="{{ old('offer_price', optional($deal)->offer_price) }}" minlength="1"
            placeholder="Enter Offer Price">
        {!! $errors->first('offer_price', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>



<div class="mb-3 row Voucher_Code" style="display: none;">
    <label for="voucher_code" class="col-form-label text-lg-end col-lg-2 col-xl-3">Voucher Code</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('voucher_code') ? ' is-invalid' : '' }}" name="voucher_code"
            type="number" id="voucher_code" value="{{ old('voucher_code', optional($deal)->voucher_code) }}"
            minlength="1" placeholder="Enter voucher code">
        {!! $errors->first('voucher_code', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>




<div class="mb-3 row">
    <label for="other_price" class="col-form-label text-lg-end col-lg-2 col-xl-3">Other Price</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('other_price') ? ' is-invalid' : '' }}" name="other_price"
            type="number" id="other_price" value="{{ old('other_price', optional($deal)->other_price) }}" minlength="1"
            placeholder="Enter other price here...">
        {!! $errors->first('other_price', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.min.css') }}">
<script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
$(function() {
    // Summernote    
    $('.editor').summernote()

});

$(document).ready(function() {
    hideShowPrice("{{old('price_type', optional(@$deal)->price_type)}}")
    $('#price_type').change(function() {
        hideShowPrice($(this).val())
    });
})

function hideShowPrice(val) {
    if (val == 'Price') {
        $('.Price').show();
        $('.Voucher_Code').hide();
    } else if (val == 'Voucher_Code') {
        $('.Voucher_Code').show();
        $('.Price').hide();
    } else {
        $('.Voucher_Code').hide();
        $('.Price').hide();
    }
}
</script>