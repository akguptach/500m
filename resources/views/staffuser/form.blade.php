<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
        placeholder="Enter name" value="{{ old('name', optional($user)->name) }}">
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>







<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
        placeholder="Enter email" value="{{ old('email', optional($user)->email) }}">
    {!! $errors->first('email', '<div class=" invalid-feedback">:message
    </div>') !!}
</div>


<div class="form-group">
    <label>Role</label>
    <select class="form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id">
        <option value="">Select Role</option>
        @foreach($roles as $role)
            <option @if(old('role_id', optional($user)->role_id) == $role->id) selected="selected" @endif value="{{$role->id}}">{{$role->role_name}}</option>
        @endforeach
    </select>
    {!! $errors->first('role_id', '<div class="invalid-feedback">:message</div>') !!}
</div>





<div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
        id="" value="" placeholder="Enter Password" id="">
    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
</div>