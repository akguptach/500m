<link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.min.css') }}">
<script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>
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
    <label for="rating" class="col-form-label text-lg-end col-lg-2 col-xl-3">Website Type</label>
    <div class="col-lg-10 col-xl-9">
        {{ HtmlHelper::WebsiteDropdown('website_type', old('website_type', optional($expert)->website_type), false, '', 'website_type') }}
        {!! $errors->first('website_type', '<div class="invalid-feedback">:message</div>') !!}
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
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Satisfied Students</label>
    <div class="col-lg-10 col-xl-9">
        <input value="{{ old('satisfied_students', optional($expert)->satisfied_students) }}" type="text"
            class="form-control{{ $errors->has('satisfied_students') ? ' is-invalid' : '' }}" name="satisfied_students" id="satisfied_students"
            value="" placeholder="Enter satisfied students number" id="">
        {!! $errors->first('satisfied_students', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Online Status</label>
    <div class="col-lg-10 col-xl-9">
        <select id="status" class="form-control{{ $errors->has('online_status') ? ' is-invalid' : '' }}"
            name="online_status">

            <option value="Online" @if(old('online_status', optional($expert)->online_status) == 'Online')
                selected="selected" @endif >Online</option>
            <option value="Offline" @if(old('online_status', optional($expert)->online_status) == 'Offline')
                selected="selected" @endif >Offline</option>
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
        <textarea name="description"
            class="editor form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description', optional($expert)->description) }}</textarea>
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row language">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Language</label>
    <div class="col-lg-10 col-xl-9">

        @php($lang = old('language', optional($expert)->language))
        @if(is_array($lang))
        @php($lang = implode(',', $lang))
        @endif
        <select id="language" class="form-control{{ $errors->has('language') ? ' is-invalid' : '' }}" name="language[]"
            multiple="multiple">

            <option value="English" @if(str_contains($lang, 'English' )) selected="selected" @endif>English</option>
            <option value="Hindi" @if(str_contains($lang, 'Hindi' )) selected="selected" @endif>Hindi</option>
        </select>
        {!! $errors->first('language', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row competences">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Help To</label>
    <div class="col-lg-10 col-xl-9">

        @php($competences = old('competences', optional($expert)->competences))
        @if(is_array($competences))
        @php($competences = implode(',', $competences))
        @endif
        <div class="competences-ajax">
        <select class="form-control{{ $errors->has('competences') ? ' is-invalid' : '' }}" name="competences[]"
            id="competences" multiple="multiple">
            
        </select>
        </div>
        {!! $errors->first('competences', '<div class="invalid-feedback">:message</div>') !!}
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


<div class="mb-3 row">
    <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3"></label>
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
    <div class="mb-3 row subject-row">
        <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">@if($index == 0) Skills @endif
        </label>
        <div class="col-lg-1 col-xl-1">
            <input type="checkbox" name="addMoreSubject[{{$index}}][show_on_home]" @if(@$filed['show_on_home']==1)
                checked="checked" @endif>
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
            <input value="{{@$filed['subject_number']}}" type="text" class="form-control"
                name="addMoreSubject[{{$index}}][subject_number]" placeholder="Enter subject number">
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
        <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3">Subject</label>

        <div class="col-lg-1 col-xl-1">
            <input type="checkbox" name="addMoreSubject[0][show_on_home]">
        </div>

        <div class="col-lg-7 col-xl-2 expert_subject1">
            <select class="form-control" name="addMoreSubject[0][expert_subject]">
                @if(!empty($subjects))
                @foreach ($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="col-lg-4 col-xl-3 expert_subject1">
            <input type="text" class="form-control" name="addMoreSubject[0][subject_number]"
                placeholder="Enter subject number">
        </div>
        <div class="col-lg-4 col-xl-3 expert_subject1">
            <button type="button" class="btn btn-outline-primary" id="add-more-subject">Add More</button>
        </div>
    </div>
    @endif

</div>

<hr>









<link href="{{ asset('css/multi-select.css') }}" rel="stylesheet" />
<script src="{{asset('js/jquery.multi-select.min.js')}}"></script>
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
@php($webType = old('website_type', optional($expert)->website_type))
<script>
$(document).ready(function() {


    $.ajax({
            url: "{{route('get_task_types')}}?website_type={{$webType}}&competences={{$competences}}",
            success: function(html) {
                $('.competences-ajax').html(html);
            }
        });
        
    $('#website_type').change(function() {
        $.ajax({
            url: "{{route('get_task_types')}}?website_type="+$(this).val()+'&competences={{$competences}}',
            success: function(html) {
                $('.competences-ajax').html(html);
            }
        });
    })


    $('#language').multiSelect();
    $('.language .multi-select-button').html("{{$lang}}")
    //$('.competences .multi-select-button').html("{{$competences}}")
});
</script>
<script>
$(function() {
    // Summernote    
    $('.editor').summernote()

});

$(document).ready(function() {
    var i = '{{$i}}';
    

    $('#add-more-subject').click(function() {
        ++i;
        $("#subject-container").append(`<div class="mb-3 row subject-row">
        <label for="ratingno" class="col-form-label text-lg-end col-lg-2 col-xl-3"></label>

        <div class="col-lg-1 col-xl-1">
            <input type="checkbox" name="addMoreSubject[${i}][show_on_home]" >
        </div>
        <div class="col-lg-7 col-xl-2 expert_subject1">
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