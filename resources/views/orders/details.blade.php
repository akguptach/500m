@extends('layouts.app')

@section('content')

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <div class="card card-primary">

                        <div class="card-header">

                            <h3 class="card-title">Edit <small>Price Master</small></h3>

                        </div>

                       <form id="quickForm" method="POST" action="">

                            @csrf
                            @method('PUT')
                            <div class="card-body">
							
							    <div class="form-group">

                                    <label >Website</label>

                                    <select class="form-control select2" style="width: 100%;" name="website_id">

                                      <option selected="selected" value="">Please Select Website</option>

                                      @if(!empty($websites))

                                        @foreach ($websites as $website)

                                          <option value="{{$website->id}}" @if($website->id == $data->website_id) selected

                                            @endif >{{$website->website_name}}</option>

                                        @endforeach

                                      @endif

                                    </select>

                                </div>
								
								<div class="form-group">

                                    <label >Subject</label>

                                    <select class="form-control select2" style="width: 100%;" name="subject_id">

                                      <option selected="selected" value="">Please Select Subject</option>

                                      @if(!empty($subjects))

                                        @foreach ($subjects as $subject)

                                          <option value="{{$subject->id}}" @if($subject->id == $data->subject_id) selected

                                            @endif >{{$subject->subject_name}}</option>

                                        @endforeach

                                      @endif
									  
									  
									  

                                    </select>

                                </div>
								
								<div class="form-group">

                                    <label >Task type</label>

                                    <select class="form-control select2" style="width: 100%;" name="task_type_id">

                                      <option selected="selected" value="">Please Select Task type</option>

                                      @if(!empty($tasktypes))

                                        @foreach ($tasktypes as $arrTasktype)

                                          <option value="{{$arrTasktype->id}}" @if($arrTasktype->id == $data->task_type_id) selected @endif>{{$arrTasktype->type_name}}</option>

                                        @endforeach

                                      @endif

                                    </select>

                                </div>
								<div class="form-group">
                                    <label>Lebel of study</label>
										<select class="form-control select2" style="width: 100%;" name="studylabel_id">
											<option selected="selected" value="">Please Select Lebel of study</option>
										    @if(!empty($levelstudy))
												@foreach ($levelstudy as $arrLevelstudy)
												  <option value="{{$arrLevelstudy->id}}" @if($arrLevelstudy->id == $data->studylabel_id) selected @endif >{{$arrLevelstudy->level_name}}</option>
												@endforeach
										    @endif

										</select>
                                </div>
								<div class="form-group">
                                    <label>Grade</label> 
										<select class="form-control select2" style="width: 100%;" name="grade_id">
											<option selected="selected" value="">Please Select Grade</option>
										    @if(!empty($grades))
												@foreach ($grades as $arrGrades)
												  <option value="{{$arrGrades->id}}" @if($arrGrades->id == $data->grade_id) selected @endif>{{$arrGrades->grade_name}}</option>
												@endforeach
										    @endif

										</select>
                                </div>
								<div class="form-group">
                                    <label>Referencing Style</label> 
										<select class="form-control select2" style="width: 100%;" name="referencing_style_id">
											<option selected="selected" value="">Please Select Referencing Style</option>
										    @if(!empty($referencing))
												@foreach ($referencing as $arrReferencing)
												  <option value="{{$arrReferencing->id}}" @if($arrReferencing->id == $data->referencing_style_id) selected @endif>{{$arrReferencing->style}}</option>
												@endforeach
										    @endif

										</select>
                                </div>
								
								
                                
								
								
								
								
								
                                <div class="form-group">

                                    <label for="exampleInputEmail1">Number of words </label>

                                    <input type="text" name="no_of_words" class="form-control" id="exampleInputEmail1" placeholder="Enter Words Count" value="{{$data->no_of_words}}">

                                    

                                </div>
								
								<div class="form-group">

                                    <label for="exampleInputEmail1">Rate</label>

                                    <input type="text" name="rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Rate" value="{{$data->rate}}">

                                    

                                </div>
								<div class="form-group">

                                    <label for="exampleInputEmail1">Additional word rate</label>

                                    <input type="text" name="additional_word_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Additional word rate" value="{{$data->additional_word_rate}}">

                                    

                                </div>

                                @error('no_of_words')

                                  <div class="alert alert-danger">{{ $message }}</div>

                                @enderror

                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary">Submit</button>

                                

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

<script src="{{ asset('js/plugins/jquery-validation/additional-methods.min.js') }}"></script>

<script>

    $(function () {

  $('#quickForm').validate({

    rules: {

      type_name: {

        required: true,

      },

    },

    errorElement: 'span',

    errorPlacement: function (error, element) {

      error.addClass('invalid-feedback');

      element.closest('.form-group').append(error);

    },

    highlight: function (element, errorClass, validClass) {

      $(element).addClass('is-invalid');

    },

    unhighlight: function (element, errorClass, validClass) {

      $(element).removeClass('is-invalid');

    }

  });

});

</script>

@endsection