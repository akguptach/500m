<div class="card-body">

    <div class="mb-3 row">
        <label>First name</label>
        <input type="text" name="first_name" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}"
            placeholder="Enter first name" value="{{ old('first_name', optional($user)->first_name) }}">
        {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>



    <div class="mb-3 row">
        <label>Last name</label>
        <input type="text" name="last_name" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="Enter last name"
            value="{{ old('last_name', optional($user)->last_name) }}"">
            {!! $errors->first('last_name', '<div class=" invalid-feedback">:message
    </div>') !!}
</div>



<div class="mb-3 row">
    <label>Email</label>
    <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter email"
        value="{{ old('email', optional($user)->email) }}"">
            {!! $errors->first('email', '<div class=" invalid-feedback">:message
</div>') !!}
</div>




@if(!$user)
<div class="mb-3 row">
    <label>Password</label>
    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="" value="" placeholder="Enter Password" id="">
    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
</div>
@endif



<div class="mb-3 row">
    <label>About</label>
    <input type="text" name="about" class="form-control {{ $errors->has('about') ? ' is-invalid' : '' }}" placeholder=""
        value="{{ old('about', optional($user)->about) }}"">
            {!! $errors->first('about', '<div class=" invalid-feedback">:message
</div>') !!}
</div>




<div class="mb-3 row">
    <label>Location</label>
    <input type="text" name="location" class="form-control {{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="Enter location"
        value="{{ old('location', optional($user)->location) }}"">
            {!! $errors->first('location', '<div class=" invalid-feedback">:message
</div>') !!}
</div>



<div class="mb-3 row">
    <label>Referal Link</label>
    <input type="text" name="referal_link" class="form-control {{ $errors->has('referal_link') ? ' is-invalid' : '' }}" placeholder="Enter referal link"
        value="{{ old('referal_link', optional($user)->referal_link) }}"">
            {!! $errors->first('referal_link', '<div class=" invalid-feedback">:message
</div>') !!}
</div>







<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{route('students.student.index')}}" class="btn btn-primary">Back</a>
</div>