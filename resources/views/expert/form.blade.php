<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<style>
    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
    }
</style>
<?php /*<ul>
     @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
     @endforeach
</ul>*/ ?>

<div class="col-md-6">
    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="first_name">First Name <span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" type="text" id="first_name" value="{{ old('first_name', optional($expert)->first_name) }}" minlength="1" placeholder="Enter first name here...">
            {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="image">Enter image <span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            <input type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="" value="" placeholder="">
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="website_manager">Website Manager <span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            {{ HtmlHelper::WebsiteDropdown('website_manager', old('website_manager', optional($expert)->website_manager), false, '', 'website_manager') }}
            {!! $errors->first('website_manager', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="rating_numbers">Rating number <span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            <input value="{{ old('rating_numbers', optional($expert)->rating_numbers) }}" type="text" class="form-control{{ $errors->has('rating_numbers') ? ' is-invalid' : '' }}" name="rating_numbers" id="" value="" placeholder="Enter Rating number" id="">
            {!! $errors->first('rating_numbers', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="satisfied_students">Satisfied Students <span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            <input value="{{ old('satisfied_students', optional($expert)->satisfied_students) }}" type="text" class="form-control{{ $errors->has('satisfied_students') ? ' is-invalid' : '' }}" name="satisfied_students" id="satisfied_students" value="" placeholder="Enter satisfied students number" id="">
            {!! $errors->first('satisfied_students', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="online_status">Online Status <span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            <select id="status" class="form-control{{ $errors->has('online_status') ? ' is-invalid' : '' }}" name="online_status">
                <option value="Online" @if(old('online_status', optional($expert)->online_status) == 'Online')
                    selected="selected" @endif >Online</option>
                <option value="Offline" @if(old('online_status', optional($expert)->online_status) == 'Offline')
                    selected="selected" @endif >Offline</option>
            </select>
            {!! $errors->first('online_status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="qualification">Qualifications <span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            <input value="{{ old('qualification', optional($expert)->qualification) }}" type="text" class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification" id="" value="" placeholder="Enter Qualification" id="">
            {!! $errors->first('qualification', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="total_orders">Total Orders <span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            <input value="{{ old('total_orders', optional($expert)->total_orders) }}" type="text" class="form-control{{ $errors->has('total_orders') ? ' is-invalid' : '' }}" name="total_orders" id="" value="" placeholder="Enter Total Orders" id="">
            {!! $errors->first('total_orders', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="success_rate">Success rate <span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            <input value="{{ old('success_rate', optional($expert)->success_rate) }}" type="text" class="form-control{{ $errors->has('success_rate') ? ' is-invalid' : '' }}" name="success_rate" id="" value="" placeholder="Enter Success Rate" id="">
            {!! $errors->first('success_rate', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>


<div class="form-group row col-md-12">
    <label class="col-lg-2 col-form-label" for="description">Description<span class="text-danger">*</span>
    </label>
    <div class="col-lg-10">
        <textarea id="ckeditor" name="description" class="editor form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description', optional($expert)->description) }}</textarea>
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group row language ">
        <label class="col-lg-4 col-form-label" for="language">Language<span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            @php($lang = old('language', optional($expert)->language))
            @if(is_array($lang))
            @php($lang = implode(',', $lang))
            @endif
            <select id="language" class="form-control{{ $errors->has('language') ? ' is-invalid' : '' }}" name="language[]" multiple="multiple">

                <option value="English" @if(str_contains($lang, 'English' )) selected="selected" @endif>English</option>
                <option value="Hindi" @if(str_contains($lang, 'Hindi' )) selected="selected" @endif>Hindi</option>
            </select>
            {!! $errors->first('language', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group row language ">
        <label class="col-lg-4 col-form-label" for="website_type">Website Type<span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            <select id="website_type" class="form-control {{ $errors->has('website_type') ? ' is-invalid' : '' }}" required>

                <option value="SOP">Sop</option>
                <option value="Essay">Essay</option>
            </select>
            {!! $errors->first('website_type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group row competences">
        <label class="col-lg-4 col-form-label" for="competences">Help To<span class="text-danger">*</span>
        </label>
        <div class="col-lg-6">
            @php($competences = old('competences', optional($expert)->competences))
            @if(is_array($competences))
            @php($competences = implode(',', $competences))
            @endif
            <div class="competences-ajax">
                <select class="form-control {{ $errors->has('competences') ? ' is-invalid' : '' }}" name="competences[]" id="competences" multiple="multiple" required>

                </select>
            </div>
            {!! $errors->first('competences', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>

<hr>
@php($oldArray = [])
@if(old('addMoreSubject') && count(old('addMoreSubject')) > 0)
@php($oldArray = old('addMoreSubject'))
@elseif($expert && $expert->subjects && count($expert->subjects) >0)
@php($oldArray = $expert->subjects)
@endif

@php($i = 0)

<div class="form-group row col-md-12">
    <label class="col-lg-1 col-form-label" for=""></label>
    </label>
    <div class="col-lg-1 col-xl-1">
        Show on home
    </div>
    <div class="col-lg-6 col-xl-2 expert_subject1">

    </div>
    <div class="col-lg-4 col-xl-3 expert_subject1">

    </div>
    <div class="col-lg-4 col-xl-3 expert_subject1">
    </div>
</div>

<div id="subject-container">
    @if(count($oldArray)>0)

    @php($i = count($oldArray)-1)
    @foreach($oldArray as $index=>$filed)
    <div class="form-group row  subject-row">
        <label class="col-lg-1 col-form-label" for="">@if($index == 0) Skills @endif</label>
        <div class="col-lg-1 col-xl-1">
            <input type="checkbox" name="addMoreSubject[{{$index}}][show_on_home]" @if(@$filed['show_on_home']==1) checked="checked" @endif>
        </div>
        <div class="col-lg-6 col-xl-2 expert_subject1">
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
    <div class="form-group row  subject-row">
        <label class="col-lg-1 col-form-label" for="">Subject</label>
        <div class="col-lg-1 col-xl-1">
            <input type="checkbox" name="addMoreSubject[0][show_on_home]">
        </div>
        <div class="col-lg-6 col-xl-2 expert_subject1">
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
<hr>
<style>
    .multi-select-button {
        width: 100% !important;
        max-width: 100%;
        padding: 5px;
    }

    .multi-select-container {
        width: 100% !important;
    }

    .expert-subjects .multi-select-container {
        width: 100%;
    }

    .expert-subjects .multi-select-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-clip: padding-box;
        background-color: #fff;
        border: 1px solid #d2d6da;
        border-radius: .5rem;
        color: #495057;
        display: block;
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.4rem;
        padding: .5rem .75rem;
        transition: box-shadow .15s ease, border-color .15s ease;
        width: 100%;
        max-width: 100%;
    }
</style>
<link href="{{ asset('css/multi-select.css') }}" rel="stylesheet" />
<script src="{{asset('js/jquery.multi-select.min.js')}}"></script>
@php($webType = old('website_type', optional($expert)->website_type))
<script>
    $(document).ready(function() {


        $.ajax({
            url: "{{route('get_task_types')}}?website_type={{$webType}}&competences={{$competences}}",
            success: function(html) {
                // html = html.querySelector('select');
                $('.competences-ajax').html(html);

                $('#competences').selectpicker('refresh');
                console.log("!212");

            }
        });

        $('#website_type').change(function() {
            $.ajax({
                url: "{{route('get_task_types')}}?website_type=" + $(this).val() + '&competences={{$competences}}',
                success: function(html) {
                    // html = html.querySelector('select');
                    $('.competences-ajax').html(html);
                    setTimeout(function() {
                        $('#competences').selectpicker('refresh');
                    }, 2000);
                    console.log("!212");
                }
            });
        })

        $('.language .multi-select-button').html("{{$lang}}")
        $('.competences .multi-select-button').html("{{$competences}}")
    });
</script>
<script>
    $(document).ready(function() {
        var i = '{{$i}}';


        $('#add-more-subject').click(function() {
            ++i;

            $("#subject-container").append(`<div class="form-group row  subject-row">
        <label class="col-lg-1 col-form-label" for=""></label>

        <div class="col-lg-1 col-xl-1">
            <input type="checkbox" name="addMoreSubject[${i}][show_on_home]" >
        </div>
        <div class="col-lg-6 col-xl-2 expert_subject1">
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




    })
</script>