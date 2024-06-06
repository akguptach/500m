<div class="card-body">

                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="Enter first name" value="{{ old('first_name', optional($student)->first_name) }}">
                                </div>
                                @error('first_name')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Enter last name" value="{{ old('last_name', optional($student)->last_name) }}"">
                                </div>
                                @error('last_name')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label >Email</label>
                                    <input type="email" name="email" class="form-control"  placeholder="Enter email" value="{{ old('email', optional($student)->email) }}"">
                                </div>
                                @error('email')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label >Contact no</label>
                                    <input type="text" name="phone_number" class="form-control"  placeholder="Enter contact no" value="{{ old('phone_number', optional($student)->phone_number) }}"">
                                </div>
                                @error('phone_number')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <?php /*<div class="form-group">
                                    <label >Subject</label>
                                    <select class="form-control" style="width: 100%;" name="tutor_subject">
                                      <option selected="selected">Please Select Subject</option>
                                      @if(!empty($subjects))
                                        @foreach ($subjects as $subject)
                                          <option value="{{$subject->id}}" @if($subject->id == $data->tutor_subject) selected
                                            @endif>{{$subject->subject_name}}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                </div>*/ ?>


                                <div class="form-group">
                                    <label >Status</label>
                                    <select class="form-control" style="width: 100%;" name="status">
                                      <option selected="selected">Please Select Status</option>
                                      <option value="active"  @if(old('status', optional($student)->status) == 'active') selected="selected" @endif>Active</option>
                                      <option value="inactive"  @if(old('status', optional($student)->status) == 'inactive') selected="selected" @endif >Inactive</option>
                                      <option value="baned"  @if(@$data->status == 'baned') selected
                                            @endif>Baned</option>     
                                    </select>
                                </div>
                                @error('status')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <?php /*<div class="form-group">
                                    <label >Password</label>
                                    <input type="password" name="password" class="form-control"  placeholder="Enter Password">
                                </div>
                                @error('password')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror*/ ?>

                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('students.student.index')}}" class="btn btn-primary">Back</a>
                            </div>