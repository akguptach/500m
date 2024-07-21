@extends('layouts.app')

@section('content')
<style>
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #dc3545;
        }
    </style>
<div class="card text-bg-theme">
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Experts</h4>
                    <div class="float-right">
                        <a href="{{ route('experts.expert.index') }}" class="btn btn-primary">
                            view Expert
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="form-validation">
                        <form class="needs-validation" method="POST" action="{{ route('experts.expert.update', $expert->id) }}" id="edit_expert_form" name="edit_expert_form" accept-charset="UTF-8" enctype="multipart/form-data">
                            @method('PUT') {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">First Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" value="{{ old('first_name', optional($expert)->first_name) }}" name="first_name" class="form-control" id="validationCustom01" placeholder="Enter first name.." required>
                                            {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Enter Image
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <!-- <input type="file" class="form-control" id="validationCustom01" placeholder="Enter Last name.." required> -->
                                            <input type="file" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="" value="" placeholder="">
                                            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="">Website Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <!-- <select class="default-select wide form-control" id=""> -->
                                            {{ HtmlHelper::WebsiteDropdown('website_type', old('website_type', optional($expert)->website_type), false, '', 'website_type') }}
                                            {!! $errors->first('website_type', '<div class="invalid-feedback">:message</div>') !!}
                                            <!-- </select> -->
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Rating Number
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" value="{{ old('rating_numbers', optional($expert)->rating_numbers) }}" name="rating_numbers" class="form-control" id="validationCustom01" placeholder="Enter Rating number" required>
                                            {!! $errors->first('rating_numbers', '<div class="invalid-feedback">:message</div>') !!}

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="">Online Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select id="status" class="default-select wide form-control {{ $errors->has('online_status') ? ' is-invalid' : '' }}" name="online_status">

                                                <option value="Online" @if(old('online_status', optional($expert)->online_status)=='Online' ) selected="selected" @endif>Online</option>
                                                <option value="Offline" @if(old('online_status', optional($expert)->online_status)=='Offline' ) selected="selected" @endif>Offline</option>
                                            </select>
                                            {!! $errors->first('online_status', '<div class="invalid-feedback">:message</div>') !!}

                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Qualification
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" value="{{ old('qualification', optional($expert)->qualification) }}" name="qualification" class="form-control" id="validationCustom01" placeholder="qualification.." required>
                                            {!! $errors->first('qualification', '<div class="invalid-feedback">:message</div>') !!}

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Total Order
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" value="{{ old('total_orders', optional($expert)->total_orders) }}" class="form-control" id="validationCustom01" name="total_orders" placeholder="Location.." required>

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom06">Success Rate
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" value="{{ old('success_rate', optional($expert)->success_rate) }}" name="success_rate" id="validationCustom06" placeholder="link" required>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="">Language
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            @php($lang = old('language', optional($expert)->language))
                                            @if(is_array($lang))
                                            @php($lang = implode(',', $lang))
                                            @endif
                                            <select id="language" class="default-select wide form-control {{ $errors->has('language') ? ' is-invalid' : '' }}" name="language[]" multiple="multiple">

                                                <option value="English" @if(str_contains($lang, 'English' )) selected="selected" @endif>English</option>
                                                <option value="Hindi" @if(str_contains($lang, 'Hindi' )) selected="selected" @endif>Hindi</option>
                                            </select>
                                            {!! $errors->first('language', '<div class="invalid-feedback">:message</div>') !!}
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="">Competences
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            @php($competences = old('competences', optional($expert)->competences))
                                            @if(is_array($competences))
                                            @php($competences = implode(',', $competences))
                                            @endif

                                            <select class="default-select wide form-control {{ $errors->has('competences') ? ' is-invalid' : '' }}" name="competences[]" id="competences" multiple="multiple">
                                                @if(!empty($subjects))
                                                @foreach ($subjects as $subject)
                                                <option @if(str_contains($competences, $subject->subject_name)) selected="selected" @endif
                                                    value="{{$subject->subject_name}}">{{$subject->subject_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            {!! $errors->first('competences', '<div class="invalid-feedback">:message</div>') !!}
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12">
                                <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom06">Description
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <textarea class="form-control" name="description" id="ckeditor" placeholder="link" required>{{ old('description', optional($expert)->description) }}</textarea>
                                            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div></div>
                                <div class="col-xl-12">
                                    @php($oldArray = [])
                                    @if(old('addMoreSubject') && count(old('addMoreSubject')) > 0)
                                    @php($oldArray = old('addMoreSubject'))
                                    @elseif($expert && $expert->subjects && count($expert->subjects) >0)
                                    @php($oldArray = $expert->subjects)
                                    @endif

                                    @php($i = 0)


                                    <div id="subject-container">
                                        @if(count($oldArray)>0)

                                        @php($i = count($oldArray)-1)
                                        @foreach($oldArray as $index=>$filed)
                                        <div class="mb-3 row subject-row">
                                            <label for="ratingno" class="col-form-label data-bs-target col-lg-2 col-xl-3">@if($index == 0) Subject @endif
                                            </label>
                                            <div class="col-lg-8 col-xl-3 expert_subject1">
                                                <select class="form-control" name="addMoreSubject[{{$index}}][expert_subject]">
                                                    @if(!empty($subjects))
                                                    @foreach ($subjects as $subject)

                                                    @if(@$filed['subject_id'] == $subject->id)
                                                    <option value="{{$subject->id}}" selected="selected">{{$subject->subject_name}}</option>
                                                    @else
                                                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                                    @endif

                                                    @endforeach
                                                    @endif
                                                </select>

                                                @php($e = 'addMoreSubject.'.$index.'.expert_subject')
                                                @error($e)
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-xl-3 expert_subject1">
                                                <input value="{{@$filed['subject_number']}}" type="text" class="form-control" name="addMoreSubject[{{$index}}][subject_number]" placeholder="Enter subject number">
                                                @php($e = 'addMoreSubject.'.$index.'.subject_number')
                                                @error($e)
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-xl-3 expert_subject1">
                                                @if($index == 0)
                                                <button type="button" class="btn btn-outline-primary" id="add-more-subject">Add More</button>
                                                @else
                                                <button type="button" class="btn btn-outline-danger remove-subject">Remove</button>
                                                @endif

                                            </div>
                                        </div>
                                        @endforeach

                                        @else
                                        <div class="mb-3 row">
                                            <label for="ratingno" class="col-form-label data-bs-target col-lg-2 col-xl-3">Subject</label>
                                            <div class="col-lg-8 col-xl-3 expert_subject1">
                                                <select class="form-control" name="addMoreSubject[0][expert_subject]">
                                                    @if(!empty($subjects))
                                                    @foreach ($subjects as $subject)
                                                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-xl-3 expert_subject1">
                                                <input type="text" class="form-control" name="addMoreSubject[0][subject_number]" placeholder="Enter subject number">
                                            </div>
                                            <div class="col-lg-4 col-xl-3 expert_subject1">
                                                <button type="button" class="btn btn-outline-primary" id="add-more-subject">Add More</button>
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    @php($oldPaperArray = [])
                                    @if(old('addMorePaper') && count(old('addMorePaper')) > 0)
                                    @php($oldPaperArray = old('addMorePaper'))
                                    @elseif($expert && $expert->papers && count($expert->papers) >0)
                                    @php($oldPaperArray = $expert->papers)
                                    @endif

                                    @php($j = 0)
                                    <div id="paper-type-container">

                                        @if(count($oldPaperArray)>0)

                                        @php($j = count($oldPaperArray)-1)
                                        @foreach($oldPaperArray as $p_index=>$filed)
                                        <div class="mb-3 row paper-row">
                                            <label for="ratingno" class="col-form-label col-lg-2 col-xl-3">@if($p_index == 0) Paper @endif</label>
                                            <div class="col-lg-8 col-xl-3 expert_subject1">
                                                <input value="{{@$filed['type_of_paper']}}" type="text" class="form-control" name="addMorePaper[{{$p_index}}][type_of_paper]" placeholder="Enter paper type">
                                                @php($e = 'addMorePaper.'.$p_index.'.type_of_paper')
                                                @error($e)
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-xl-3 expert_subject1">
                                                <input value="{{@$filed['paper_number']}}" type="text" class="form-control" name="addMorePaper[{{$p_index}}][paper_number]" placeholder="Enter paper number">
                                                @php($e = 'addMorePaper.'.$p_index.'.paper_number')
                                                @error($e)
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-xl-3 expert_subject1">
                                                @if($p_index == 0)
                                                <button type="button" class="btn btn-outline-primary" id="add-more-paper">Add More</button>
                                                @else
                                                <button type="button" class="btn btn-outline-danger remove-paper">Remove</button>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="mb-3 row paper-row">
                                            <label for="ratingno" class="col-form-label  col-lg-2 col-xl-3">Paper</label>
                                            <div class="col-lg-8 col-xl-3 expert_subject1">
                                                <input type="text" class="form-control" name="addMorePaper[{{$j}}][type_of_paper]" placeholder="Enter paper type">

                                            </div>
                                            <div class="col-lg-4 col-xl-3 expert_subject1">
                                                <input type="text" class="form-control" name="addMorePaper[{{$j}}][paper_number]" placeholder="Enter paper number">

                                            </div>
                                            <div class="col-lg-4 col-xl-3 expert_subject1">
                                                <button type="button" class="btn btn-outline-primary" id="add-more-paper">Add More</button>
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                    </div>
                    <button type="submit" class="btn me-2 btn-primary">Submit</button>
                    <button type="submit" class="btn me-2 btn-primary">Back</button>
                    </form>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#language').multiSelect();
                        $('.language .multi-select-button').html("{{$lang}}")
                        $('#competences').multiSelect();
                        $('.competences .multi-select-button').html("{{$competences}}")
                    });
                </script>
                <script>
                    $(function() {
                        // Summernote    
                        $('.editor').summernote()

                    });

                    $(document).ready(function() {
                        var i = '0';
                        var j = '0';

                        $('#add-more-subject').click(function() {
                            ++i;
                            $("#subject-container").append(`<div class="mb-3 row subject-row">
                                    <label for="ratingno" class="col-form-label data-bs-target col-lg-2 col-xl-3"></label>
                                    <div class="col-lg-8 col-xl-3 expert_subject1">
                                    <select class="form-control" name="addMoreSubject[${i}][expert_subject]">
                                        @if(!empty($subjects))
                                        @foreach ($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    </div>
                                    <div class="col-lg-4 col-xl-3 expert_subject1">
                                        <input type="text" class="form-control" name="addMoreSubject[${i}][subject_number]" placeholder="Enter subject number">
                                    </div>
                                    <div class="col-lg-4 col-xl-3 expert_subject1">
                                        <button type="button" class="btn btn-outline-danger remove-subject">Remove</button>
                                    </div>
                                </div>`);
                        });
                        $(document).on('click', '.remove-subject', function() {
                            $(this).parents('.subject-row').remove();
                        });


                        $('#add-more-paper').click(function() {
                            ++j;
                            $("#paper-type-container").append(`<div class="mb-3 row paper-row">
                                    <label for="ratingno" class="col-form-label data-bs-target col-lg-2 col-xl-3"></label>
                                    <div class="col-lg-8 col-xl-3 expert_subject1">
                                        <input type="text" class="form-control" name="addMorePaper[${j}][type_of_paper]" placeholder="Enter paper type">
                                    </div>
                                    <div class="col-lg-4 col-xl-3 expert_subject1">
                                        <input type="text" class="form-control" name="addMorePaper[${j}][paper_number]" placeholder="Enter paper number">
                                    </div>
                                    <div class="col-lg-4 col-xl-3 expert_subject1">
                                        <button type="button" class="btn btn-outline-danger remove-paper">Remove</button>
                                    </div>
                                </div>`);
                        });
                        $(document).on('click', '.remove-paper', function() {
                            $(this).parents('.paper-row').remove();
                        });

                    })
                </script>
            </div>
        </div>
    </div>
</div>
<!-- <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>



@endsection