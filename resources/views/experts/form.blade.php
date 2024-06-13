<div class="mb-3 row">
    <label for="first_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">First Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" type="text"
            id="first_name" value="{{ old('first_name', optional($expert)->first_name) }}" minlength="1"
            placeholder="Enter first name here...">
        {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="image" class="col-form-label text-lg-end col-lg-2 col-xl-3">Enter image</label>
    <div class="col-lg-10 col-xl-9">
        <input type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id=""
            value="" placeholder="">
        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="rating" class="col-form-label text-lg-end col-lg-2 col-xl-3">Rating</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('ratings', optional($expert)->ratings) }}" type="text"
            class="form-control{{ $errors->has('ratings') ? ' is-invalid' : '' }}" name="ratings" id="" value=""
            placeholder="Enter Rating" id="">
        {!! $errors->first('ratings', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Rating number</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('rating_numbers', optional($expert)->rating_numbers) }}" type="text"
            class="form-control{{ $errors->has('rating_numbers') ? ' is-invalid' : '' }}" name="rating_numbers" id=""
            value="" placeholder="Enter Rating number" id="">
        {!! $errors->first('rating_numbers', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Online Status</label>
    <div class="col-lg-10 col-xl-9">
        <select id="status" class="form-control{{ $errors->has('online_status') ? ' is-invalid' : '' }}"
            name="online_status">

            <option value="Online" @if(old('online_status', optional($expert)->online_status) == 'Online') selected="selected" @endif >Online</option>
            <option value="Offline" @if(old('online_status', optional($expert)->online_status) == 'Offline') selected="selected" @endif >Offline</option>
        </select>
        {!! $errors->first('online_status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Qualifications</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('qualification', optional($expert)->qualification) }}" type="text"
            class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification" id=""
            value="" placeholder="Enter Qualification" id="">
        {!! $errors->first('qualification', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Total Orders</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('total_orders', optional($expert)->total_orders) }}" type="text"
            class="form-control{{ $errors->has('total_orders') ? ' is-invalid' : '' }}" name="total_orders" id=""
            value="" placeholder="Enter Total Orders" id="">
        {!! $errors->first('total_orders', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Success rate</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('success_rate', optional($expert)->success_rate) }}" type="text"
            class="form-control{{ $errors->has('success_rate') ? ' is-invalid' : '' }}" name="success_rate" id=""
            value="" placeholder="Enter Success Rate" id="">
        {!! $errors->first('success_rate', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Description</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('description', optional($expert)->description) }}" type="text"
            class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="" value=""
            placeholder="Enter Description" id="">
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Language</label>
    <div class="col-lg-10 col-xl-9">
        <select id="status" class="form-control{{ $errors->has('language') ? ' is-invalid' : '' }}" name="language">

            <option value="English" @if(old('language', optional($expert)->language) == 'English') selected="selected" @endif>English</option>
            <option value="Hindi" @if(old('language', optional($expert)->language) == 'Hindi') selected="selected" @endif>Hindi</option>
        </select>
        {!! $errors->first('language', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Competences</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('competences', optional($expert)->competences) }}" type="text"
            class="form-control{{ $errors->has('competences') ? ' is-invalid' : '' }}" name="competences" id="" value=""
            placeholder="Enter Competences" id="competences">
        {!! $errors->first('competences', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Subject</label>
    <div class="col-lg-10 col-xl-9">
        <select id="subject" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject">

            <option value="english" @if(old('subject', optional($expert)->subject) == 'english') selected="selected" @endif>English</option>
            <option value="hindi" @if(old('subject', optional($expert)->subject) == 'hindi') selected="selected" @endif>Hindi</option>
        </select>
        {!! $errors->first('subject', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Subject number</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('subject_number', optional($expert)->subject_number) }}" type="text"
            class="form-control{{ $errors->has('first_subject_numbername') ? ' is-invalid' : '' }}"
            name="subject_number" id="" value="" placeholder="Subject Number" id="">
        {!! $errors->first('subject_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Types of Paper</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('type_of_paper', optional($expert)->type_of_paper) }}" type="text"
            class="form-control{{ $errors->has('type_of_paper') ? ' is-invalid' : '' }}" name="type_of_paper" id=""
            value="" placeholder="Enter Paper Type" id="">
        {!! $errors->first('type_of_paper', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Paper Number</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('paper_number', optional($expert)->paper_number) }}" type="text"
            class="form-control{{ $errors->has('paper_number') ? ' is-invalid' : '' }}" name="paper_number" id=""
            value="" placeholder="Enter Paper Number" id="">
        {!! $errors->first('paper_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>