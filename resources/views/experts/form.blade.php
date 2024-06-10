


<div class="mb-3 row">
    <label for="first_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">First Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" type="text" id="first_name" value="{{ old('first_name', optional($expert)->first_name) }}" minlength="1" placeholder="Enter first name here...">
        {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="last_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Last Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" type="text" id="last_name" value="{{ old('last_name', optional($expert)->last_name) }}" minlength="1" placeholder="Enter last name here...">
        {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="email" class="col-form-label text-lg-end col-lg-2 col-xl-3">Email</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="email" id="email" value="{{ old('email', optional($expert)->email) }}" placeholder="Enter email here...">
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="dob" class="col-form-label text-lg-end col-lg-2 col-xl-3">Dob</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" type="text" id="dob" value="{{ old('dob', optional($expert)->dob) }}" minlength="1" placeholder="Enter dob here...">
        {!! $errors->first('dob', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

