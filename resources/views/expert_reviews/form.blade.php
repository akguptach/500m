<div class="mb-3 row">
    <label for="title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Title</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" type="text" id="title" value="{{ old('title', optional($expertReview)->title) }}" minlength="1" maxlength="255" placeholder="Enter title here...">
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>



<div class="mb-3 row">
    <label for="title_number" class="col-form-label text-lg-end col-lg-2 col-xl-3">Title Number</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('title_number') ? ' is-invalid' : '' }}" name="title_number" type="number" id="title_number" value="{{ old('title_number', optional($expertReview)->title_number) }}" minlength="1" maxlength="255" placeholder="">
        {!! $errors->first('title_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


<div class="mb-3 row">
    <label for="star_rating_number" class="col-form-label text-lg-end col-lg-2 col-xl-3">Star Rating</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('star_rating_number') ? ' is-invalid' : '' }}" name="star_rating_number" type="number" id="star_rating_number" value="{{ old('star_rating_number', optional($expertReview)->star_rating_number) }}" minlength="1" maxlength="255" placeholder="">
        {!! $errors->first('star_rating_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


<div class="mb-3 row">
    <label for="description" class="col-form-label text-lg-end col-lg-2 col-xl-3">Description</label>
    <div class="col-lg-10 col-xl-9">
        <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" minlength="1" maxlength="1000">{{ old('description', optional($expertReview)->description) }}</textarea>
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>



<div class="mb-3 row">
    <label for="review_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Review Date</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('review_date') ? ' is-invalid' : '' }} datepicker" autocomplete="off" name="review_date" type="text" id="review_date" value="{{ old('review_date', optional($expertReview)->review_date) }}" placeholder="Enter review date here...">
        {!! $errors->first('review_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="review_code" class="col-form-label text-lg-end col-lg-2 col-xl-3">Review Code</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('review_code') ? ' is-invalid' : '' }}" name="review_code" type="text" id="review_code" value="{{ old('review_code', optional($expertReview)->review_code) }}" minlength="1" placeholder="Enter review code here...">
        {!! $errors->first('review_code', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Status</label>
    <div class="col-lg-10 col-xl-9">

        <select class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" style="width: 100%;" name="status">
            <option selected="selected" value="">Please Select Status</option>
            <option value="active" @if(old('status', optional($expertReview)->status) == 'active') selected="selected"
                @endif>Active</option>
            <option value="inactive" @if(old('status', optional($expertReview)->status) == 'inactive')
                selected="selected" @endif >Inactive</option>

        </select>

        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<script src="{{ asset('vendor\bootstrap-datepicker-master\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
	j$ = jQuery.noConflict();
	j$(function() {
		var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

		j$("#review_date").datepicker({
			autoclose: true,

			todayBtn: 1, changeMonth: true, changeYear: true, format: 'yyyy-mm-dd', // Set the date format to yyyy-mm-dd
		}).on('change', function() {
			
		});

	});
</script>
