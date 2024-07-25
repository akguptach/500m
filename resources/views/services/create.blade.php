@extends('layouts.app')
@section('content')
<!-- <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script> -->

<style>
.nav-item {
    padding-right: 2px;
}

.switch {
    position: relative;
    display: inline-block;
    width: 125px;
    height: 34px;
}

.switch input {
    display: none;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ca2222;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked+.slider {
    background-color: #2ab934;
}

input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked+.slider:before {
    -webkit-transform: translateX(55px);
    -ms-transform: translateX(55px);
    transform: translateX(85px);
}

/*------ ADDED CSS ---------*/
.on {
    display: none;
}

.on,
.off {
    color: white;
    position: absolute;
    transform: translate(-50%, -50%);
    top: 50%;
    left: 50%;
    font-size: 10px;
    font-family: Verdana, sans-serif;
}

input:checked+.slider .on {
    display: block;
}

input:checked+.slider .off {
    display: none;
}

/*--------- END --------*/

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>
<section class="content-header">
    <div class="container-fluid">

        @if(Session::has('status'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('status') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $type=='PAGE'?'Pages':'Services' }}</h4>
                <div class="float-right">
                    @if($type=='PAGE')
                        <a href="{{ route('pages') }}" class="btn btn-primary">View Pages</a>
                    @else
                        <a href="{{ route('services_index') }}" class="btn btn-primary">View Services</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <div class="custom-tab-1">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#home1" href="#home1">
                                Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#seo" href="#seo"> Seo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#faq" href="#faq"> Faq</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#specifications"
                                href="#specifications">Website Content</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ratings"
                                href="#ratings">Ratings</a>
                        </li>
                        <?php /*<li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#how_works" href="#how_works"> How it works</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#why_educrafter" href="#why_educrafter"> Why Educrafter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#assist_buttons" href="#assist_buttons">Assist you Button</a>
                        </li>*/ ?>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home1" role="tabpanel">
                            <div class="pt-4">
                                <form class="needs-validation" method="POST" action="{{route('services.store.basic')}}">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{Request::route('id') }}">
                                    <input type="hidden" name="content_type" value="{{$type}}">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="">Select Website
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select name="website_type"
                                                        class="default-select wide form-control">
                                                        <option value="">Select website</option>
                                                        @if(!empty($websites))
                                                        @foreach($websites as $website)
                                                        <option value="{{$website->website_type}}"
                                                            @if(old("website_type")==$website->website_type ||
                                                            @$service->website_type==$website->website_type) selected
                                                            @endif>{{$website->website_type }}
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    @error('website_type')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    <div class="invalid-feedback">
                                                        ....
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="">Select Keyword
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    {{HtmlHelper::ServiceKeywordDropdown('service_keyword_id',['default'=>old('service_keyword_id', @$service->service_keyword_id),'required'=>true])}}
                                                    @error('service_keyword_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    <div class="invalid-feedback">
                                                        ....
                                                    </div>
                                                </div>
                                            </div>





                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">Services
                                                    Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="service_name"
                                                        placeholder="Services" required
                                                        value="{{ old('service_name', @$service->service_name ) }}">
                                                    @error('service_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-lg-2">Short Description
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <textarea id="short_description" name="short_description"
                                                class="form-control editor">{{ old('short_description', @$service->short_description ) }}</textarea>
                                            @error('short_description')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>
                                    </div>

                                    <?php /*<div class="row mt-3">
                                        <label class="col-lg-2">Services Description
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <textarea id="service_description" name="service_description" class="form-control editor">{{ old('service_description', @$service->service_description ) }}</textarea>
                                            @error('service_description')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>*/
                                    ?>

                                    <div class="row mt-3">
                                        <label class="col-lg-2">Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <label class="switch">
                                                @if(@$service->status == 'ACTIVE')
                                                <input type="checkbox" name="status" value="ACTIVE" checked>
                                                @else
                                                <input type="checkbox" name="status" value="ACTIVE">
                                                @endif
                                                <div class="slider round">
                                                    <!--ADDED HTML -->
                                                    <span class="on">Active</span>
                                                    <span class="off">Inactive</span>
                                                    <!--END-->
                                                </div>
                                            </label>

                                            @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>


                                    </div>

                                    <br><br>

                                    <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                    <a href="{{route('services_index')}}" class="btn btn-primary">Back</a>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="seo">
                            <div class="pt-4">
                                <form class="needs-validation" id="quickForm" method="POST"
                                    action="{{route('services.store.seo')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{Request::route('id') }}">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">H1 Tag -
                                                    Service Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="seo_title" class="form-control"
                                                        placeholder=""
                                                        value="{{old('seo_title',@$service->seo->seo_title)}}">
                                                    @error('seo_title')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">Meta
                                                    Keyword
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="seo_keywords" class="form-control"
                                                        placeholder=""
                                                        value="{{old('seo_keywords',@$service->seo->seo_keywords)}}">
                                                    @error('seo_keywords')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">Slug
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="seo_url_slug" class="form-control"
                                                        placeholder=""
                                                        value="{{old('seo_url_slug',@$service->seo->seo_url_slug)}}">
                                                    @error('seo_url_slug')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">Meta
                                                    Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="seo_meta" class="form-control"
                                                        placeholder=""
                                                        value="{{old('seo_meta', @$service->seo->seo_meta)}}">
                                                    @error('seo_meta')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">Meta
                                                    Description
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <textarea id="seo_description" name="seo_description"
                                                        class="form-control">{{old('seo_description',@$service->seo->seo_description)}}</textarea>
                                                    @error('seo_description')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">OG Image
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div><img src="{{@$service->seo->og_image}}" width="100px" /></div>

                                                    <input type="file" name="og_image" class="form-control"
                                                        placeholder="">
                                                    @error('og_image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">Button
                                                    Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="button_title" class="form-control"
                                                        placeholder=""
                                                        value="{{ old('button_title', @$service->seo->button_title ) }}">
                                                    @error('button_title')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <?php /* <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom01">Button URL
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="button_url" class="form-control" placeholder="" value="{{ old('button_url', @$service->seo->button_url ) }}">

                                                    @error('button_url')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            */ ?>

                                        </div>
                                    </div>
                                    @if(Request::route('id'))
                                    <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                    <a href="blog.php" class="btn btn-primary">Back</a>
                                    @endif

                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="faq">
                            <div class="pt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive table-bordered">
                                                    <form id="basic" method="POST"
                                                        action="{{route('services.store.faq')}}">
                                                        @csrf
                                                        <input type="hidden" name="service_id"
                                                            value="{{Request::route('id') }}">
                                                        <table
                                                            class="table table-bordered table-responsive table-bordered-sm"
                                                            id="dynamicAddRemove">
                                                            <thead>
                                                                <tr>
                                                                    <th>Question/Answer</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if($service && $service->faq && count($service->faq)
                                                                >0)
                                                                @foreach($service->faq as $index=>$fileds)
                                                                <tr>
                                                                    <th>
                                                                        <div class="card">
                                                                            <div class="card-body">

                                                                                <input type="text"
                                                                                    name="addMoreInputFields[{{$index}}][question]"
                                                                                    placeholder="Enter Question"
                                                                                    class="form-control"
                                                                                    value="{{$fileds->question}}" />
                                                                                <br>
                                                                                <br>
                                                                                <textarea
                                                                                    name="addMoreInputFields[{{$index}}][answer]"
                                                                                    id="addMoreInputFields[{{$index}}][answer]"
                                                                                    placeholder="Enter Answer"
                                                                                    class="form-control editor">{{$fileds->answer}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <td> <button type="button"
                                                                            class="btn btn-outline-danger remove-input-field">Delete</button>
                                                                    </td>
                                                                </tr>
                                                                @endforeach

                                                                @else
                                                                <tr>
                                                                    <td>
                                                                        <table class="table child-table">
                                                                            <tr>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        name="addMoreInputFields[0][question]"
                                                                                        id="addMoreInputFields[0][question]"
                                                                                        placeholder="Enter Question"
                                                                                        class="form-control" />
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <textarea
                                                                                        name="addMoreInputFields[0][answer]"
                                                                                        placeholder="Enter Answer"
                                                                                        class="form-control editor"></textarea>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
                                                                @endif

                                                            </tbody>
                                                        </table>
                                                        @error('question')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror

                                                        @if(Request::route('id'))
                                                        <div class="card-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                            <a href="{{route('services_index')}}"
                                                                class="btn btn-primary">Back</a>
                                                            @if(Request::route('id'))
                                                            <button type="button" name="add" id="dynamic-ar"
                                                                class="btn btn-outline-primary float-right">Add
                                                                More</button>
                                                            @endif
                                                        </div>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="specifications">
                            <div class="pt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <form id="basic" method="POST"
                                                    action="{{route('services.store.specification')}}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="service_id"
                                                        value="{{Request::route('id') }}">
                                                    <table class="table table-bordered" id="specificationAddRemove">
                                                        <tr>
                                                            <th>Title/Description</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        @php $oldArray = []; @endphp
                                                        @if(old('addMoreSpecificationFields') &&
                                                        count(old('addMoreSpecificationFields')) > 0)
                                                        @php $oldArray = old('addMoreSpecificationFields') @endphp
                                                        @elseif($service && $service->specification &&
                                                        count($service->specification) >0)
                                                        @php $oldArray = $service->specification; @endphp
                                                        @endif

                                                        @php $i = 0; @endphp

                                                        @if(count($oldArray)>0)
                                                        @php $i = count($oldArray)-1; @endphp
                                                        @foreach($oldArray as $index=>$filed)
                                                        <tr>
                                                            <td>
                                                                <input type="text"
                                                                    name="addMoreSpecificationFields[{{$index}}][title]"
                                                                    placeholder="Enter Title" class="form-control"
                                                                    value="{{@$filed['title']}}" require />
                                                                @php $e = 'addMoreSpecificationFields.'.$index.'.title';
                                                                @endphp
                                                                @error($e)
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                <br>
                                                                <div style="display: flex;">
                                                                    <input type="hidden" class="form-control"
                                                                        name="addMoreSpecificationFields[{{$index}}][icon_url]"
                                                                        id="WorkImageIcon_{{@$filed['id']}}"
                                                                        value="{{@$filed['icon']}}" />
                                                                    <button type="button"
                                                                        class="btn btn-primary text-center btnimageModal1"
                                                                        rel="{{@$filed['id']}}">
                                                                        Select Icon
                                                                    </button>
                                                                    <div class="col-sm-1">
                                                                        <img src="{{@$filed['icon']}}"
                                                                            alt="Image Description"
                                                                            class="WorkViewImage_{{@$filed['id']}}"
                                                                            style="width: 40px; border-radius: 21px;">
                                                                    </div>
                                                                </div>
                                                                @php $e = 'addMoreSpecificationFields.'.$index.'.icon';
                                                                @endphp
                                                                @error($e)
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                <br>
                                                                <textarea
                                                                    name="addMoreSpecificationFields[{{$index}}][description]"
                                                                    placeholder="Enter Description"
                                                                    class="form-control editor"
                                                                    require>{{@$filed['description']}}</textarea>
                                                                @php $e =
                                                                'addMoreSpecificationFields.'.$index.'.description';
                                                                @endphp
                                                                @error($e)
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                </br>
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-outline-danger remove-input-field">Delete</button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td>
                                                                <input type="text"
                                                                    name="addMoreSpecificationFields[0][title]"
                                                                    placeholder="Enter Title" class="form-control"
                                                                    require />
                                                                <br>
                                                                <div style="display: flex;">
                                                                    <input type="hidden" class="form-control"
                                                                        id="WorkImageIcon_{{@$filed['id']}}"
                                                                        value="{{@$filed['icon']}}" />
                                                                    <button type="button"
                                                                        class="btn btn-primary text-center btnimageModal1"
                                                                        rel="{{@$filed['id']}}">
                                                                        Select Icon
                                                                    </button>
                                                                    <div class="col-sm-1">
                                                                        <img src="{{@$filed['icon']}}"
                                                                            alt="Image Description"
                                                                            class="WorkViewImage_{{@$filed['id']}}"
                                                                            style="width: 40px; border-radius: 21px;">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <textarea
                                                                    name="addMoreSpecificationFields[0][description]"
                                                                    placeholder="Enter Description"
                                                                    class="form-control editor" require></textarea>

                                                            </td>

                                                            <td>

                                                            </td>

                                                        </tr>
                                                        @endif

                                                    </table>


                                                    @if(Request::route('id'))
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <a href="{{route('services_index')}}"
                                                            class="btn btn-primary">Back</a>
                                                        @if(Request::route('id'))
                                                        <button type="button" name="add" id="add_more_specification"
                                                            class="btn btn-outline-primary float-right">Add
                                                            More</button>
                                                        @endif
                                                    </div>
                                                    @endif

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ratings">
                            <div class="pt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <form id="basic" method="POST"
                                                    action="{{route('services.store.ratings')}}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="service_id"
                                                        value="{{Request::route('id') }}">
                                                    <table class="table table-bordered" id="ratingsAddRemove">
                                                        <tr>
                                                            <th>Stars</th>
                                                            <th>Name</th>
                                                            <th>Description</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        @php $oldArray = []; @endphp
                                                        @if(old('addMoreRatingFields') &&
                                                        count(old('addMoreRatingFields')) > 0)
                                                        @php $oldArray = old('addMoreRatingFields') @endphp
                                                        @elseif($service && $service->ratings &&
                                                        count($service->ratings) >0)
                                                        @php $oldArray = $service->ratings; @endphp
                                                        @endif

                                                        @php $r = 0; @endphp

                                                        @if(count($oldArray)>0)
                                                        @php $r = count($oldArray)-1; @endphp
                                                        @foreach($oldArray as $index=>$filed)
                                                        <tr>
                                                            <td>
                                                                <input type="text"
                                                                    name="addMoreRatingFields[{{$index}}][star_rating]"
                                                                    placeholder="Enter Title" class="form-control"
                                                                    value="{{@$filed['star_rating']}}" require />
                                                                @php $e = 'addMoreRatingFields.'.$index.'.star_rating';
                                                                @endphp
                                                                @error($e)
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </td>

                                                            <td>
                                                                <input type="text"
                                                                    name="addMoreRatingFields[{{$index}}][address]"
                                                                    placeholder="Enter address" class="form-control"
                                                                    value="{{@$filed['address']}}" require />
                                                                @php $e = 'addMoreRatingFields.'.$index.'.address';
                                                                @endphp
                                                                @error($e)
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <textarea
                                                                    name="addMoreRatingFields[{{$index}}][description]"
                                                                    placeholder="Enter Description" class="form-control"
                                                                    require>{{@$filed['description']}}</textarea>
                                                                @php $e = 'addMoreRatingFields.'.$index.'.description';
                                                                @endphp
                                                                @error($e)
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </td>



                                                            <td><button type="button"
                                                                    class="btn btn-outline-danger remove-input-field">Delete</button>
                                                            </td>
                                                        </tr>
                                                        @php $r = $r; @endphp
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td>
                                                                <input type="text"
                                                                    name="addMoreRatingFields[0][star_rating]"
                                                                    placeholder="Enter rating" class="form-control"
                                                                    require />
                                                            </td>

                                                            <td>
                                                                <input type="text"
                                                                    name="addMoreRatingFields[0][address]"
                                                                    placeholder="Enter Name" class="form-control"
                                                                    require />
                                                            </td>
                                                            <td>
                                                                <textarea name="addMoreRatingFields[0][description]"
                                                                    placeholder="Enter address" class="form-control"
                                                                    require></textarea>
                                                            </td>

                                                            <td>
                                                            </td>
                                                        </tr>
                                                        @endif

                                                    </table>


                                                    @if(Request::route('id'))
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <a href="{{route('services_index')}}"
                                                            class="btn btn-primary">Back</a>
                                                        @if(Request::route('id'))
                                                        <button type="button" name="add" id="add_more_rating"
                                                            class="btn btn-outline-primary float-right">Add
                                                            More</button>
                                                        @endif
                                                    </div>
                                                    @endif

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="how_works">
                            <div class="pt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <form id="basic" method="POST"
                                                    action="{{route('services.store.how_works')}}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="service_id"
                                                        value="{{Request::route('id') }}">
                                                    <table class="table table-bordered" id="howworksAddRemove">
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Icon</th>
                                                            <th>Description</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        @php $oldArray = []; @endphp
                                                        @if(old('addMoreFields') && count(old('addMoreFields')) > 0)
                                                        @php $oldArray = old('addMoreFields') @endphp
                                                        @elseif($service && $service->howWorks &&
                                                        count($service->howWorks) >0)
                                                        @php $oldArray = $service->howWorks; @endphp
                                                        @endif
                                                        @php $i = 0; @endphp
                                                        @if(count($oldArray)>0)
                                                        @php $i = count($oldArray)-1; @endphp
                                                        @foreach($oldArray as $index=>$filed)
                                                        <tr>
                                                            <td>
                                                                <input type="text"
                                                                    name="addMoreFields[{{$index}}][title]"
                                                                    placeholder="Enter Title" class="form-control"
                                                                    value="{{@$filed['title']}}" require />

                                                                @php $e = 'addMoreFields.'.$index.'.title'; @endphp
                                                                @error($e)
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <div style="display: flex;">
                                                                    <input type="hidden" class="form-control"
                                                                        name="addMoreFields[{{$index}}][icon_url]"
                                                                        id="WorkImageIcon_{{@$filed['id']}}"
                                                                        value="{{@$filed['icon']}}" />
                                                                    <button type="button"
                                                                        class="btn btn-primary text-center btnimageModal2"
                                                                        rel="{{@$filed['id']}}">
                                                                        Select icon
                                                                    </button>
                                                                    <div class="col-sm-1">
                                                                        <img src="{{@$filed['icon']}}"
                                                                            alt="Image Description"
                                                                            class="WorkViewImage_{{@$filed['id']}}"
                                                                            style="width: 40px; border-radius: 21px;">
                                                                    </div>
                                                                </div>
                                                                @php $e = 'addMoreFields.'.$index.'.icon'; @endphp
                                                                @error($e)
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <textarea name="addMoreFields[{{$index}}][description]"
                                                                    placeholder="Enter Description" class="form-control"
                                                                    require>{{@$filed['description']}}</textarea>
                                                                @php $e = 'addMoreFields.'.$index.'.description';
                                                                @endphp
                                                                @error($e)
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </td>
                                                            <td><button type="button"
                                                                    class="btn btn-outline-danger remove-input-field">Delete</button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="addMoreFields[0][title]"
                                                                    placeholder="Enter Title" class="form-control"
                                                                    require />
                                                            </td>
                                                            <td>
                                                                <div style="display: flex;">
                                                                    <input type="hidden" class="form-control"
                                                                        id="WorkImageIcon_{{@$filed['id']}}"
                                                                        value="{{@$filed['icon']}}" />
                                                                    <button type="button"
                                                                        class="btn btn-primary text-center btnimageModal2"
                                                                        rel="{{@$filed['id']}}">
                                                                        Select icon
                                                                    </button>
                                                                    <div class="col-sm-1">
                                                                        <img src="{{@$filed['icon']}}"
                                                                            alt="Image Description"
                                                                            class="WorkViewImage_{{@$filed['id']}}"
                                                                            style="width: 40px; border-radius: 21px;">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <textarea name="addMoreFields[0][description]"
                                                                    placeholder="Enter Description" class="form-control"
                                                                    require></textarea>
                                                            </td>

                                                            <td>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                    @if(Request::route('id'))
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <a href="{{route('services_index')}}"
                                                            class="btn btn-primary">Back</a>
                                                        @if(Request::route('id'))
                                                        <button type="button" name="add" id="add_more_how_works"
                                                            class="btn btn-outline-primary float-right">Add
                                                            More</button>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="why_educrafter">
                            <div class="pt-4">
                                <div class="card">
                                    <div class="card-body">
                                        <form id="basic" method="POST"
                                            action="{{route('services.store.why_educrafter')}}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
                                            <table class="table table-bordered" id="why_educrafterAddRemove">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Icon</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                                @php $oldArray = []; @endphp
                                                @if(old('addMoreSpecificationFields') &&
                                                count(old('addMoreSpecificationFields')) > 0)
                                                @php $oldArray = old('addMoreSpecificationFields') @endphp
                                                @elseif($service && $service->whyEducrafter &&
                                                count($service->whyEducrafter) >0)
                                                @php $oldArray = $service->whyEducrafter; @endphp
                                                @endif

                                                @php $i = 0; @endphp

                                                @if(count($oldArray)>0)
                                                @php $i = count($oldArray)-1; @endphp
                                                @foreach($oldArray as $index=>$filed)
                                                <tr>
                                                    <td>
                                                        <input type="text"
                                                            name="addMoreSpecificationFields[{{$index}}][title]"
                                                            placeholder="Enter Title" class="form-control"
                                                            value="{{@$filed['title']}}" require />

                                                        @php $e = 'addMoreSpecificationFields.'.$index.'.title'; @endphp
                                                        @error($e)
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <div style="display: flex;">

                                                            <input type="hidden" class="form-control"
                                                                name="addMoreSpecificationFields[{{$index}}][icon_url]"
                                                                id="ImageIcon_{{@$filed['id']}}"
                                                                value="{{@$filed['icon']}}" />
                                                            <button type="button"
                                                                class="btn btn-primary text-center btnimageModal3"
                                                                rel="{{@$filed['id']}}">
                                                                Select icon
                                                            </button>
                                                            <div class="col-sm-6">
                                                                <img src="{{@$filed['icon']}}" alt="Image Description"
                                                                    class="viewImage_{{@$filed['id']}}"
                                                                    style="width: 40px; border-radius: 21px;">
                                                            </div>
                                                        </div>
                                                        @php $e = 'addMoreSpecificationFields.'.$index.'.icon'; @endphp
                                                        @error($e)
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <textarea
                                                            name="addMoreSpecificationFields[{{$index}}][description]"
                                                            placeholder="Enter Description" class="form-control"
                                                            require>{{@$filed['description']}}</textarea>
                                                        @php $e = 'addMoreSpecificationFields.'.$index.'.description';
                                                        @endphp
                                                        @error($e)
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </td>
                                                    <td><button type="button"
                                                            class="btn btn-outline-danger remove-input-field">Delete</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td>
                                                        <input type="text" name="addMoreSpecificationFields[0][title]"
                                                            placeholder="Enter Title" class="form-control" require />
                                                    </td>
                                                    <td>
                                                        <div style="display: flex;">
                                                            <input type="hidden" class="form-control"
                                                                id="ImageIcon_{{@$filed['id']}}"
                                                                value="{{@$filed['icon']}}" />
                                                            <button type="button"
                                                                class="btn btn-primary text-center btnimageModal3"
                                                                rel="{{@$filed['id']}}">
                                                                Select icon
                                                            </button>
                                                            <div class="col-sm-6">
                                                                <img src="{{@$filed['icon']}}" alt="Image Description"
                                                                    class="viewImage_{{@$filed['id']}}"
                                                                    style="width: 40px; border-radius: 21px;">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea name="addMoreSpecificationFields[0][description]"
                                                            placeholder="Enter Description" class="form-control"
                                                            require></textarea>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                @endif

                                            </table>
                                            @if(Request::route('id'))
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{route('services_index')}}" class="btn btn-primary">Back</a>
                                                @if(Request::route('id'))
                                                <button type="button" name="add" id="add_more_why_educrafter"
                                                    class="btn btn-outline-primary float-right">Add More</button>
                                                @endif
                                            </div>
                                            @endif

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="assist_buttons">
                            <div class="pt-4">
                                <div class="card">
                                    <div class="card-body">
                                        <form id="basic" method="POST" action="{{route('services.store.assist_btn')}}">
                                            @csrf
                                            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
                                            <table class="table table-bordered" id="buttonsAddRemove">
                                                <tr>
                                                    <th>Button Text</th>
                                                    <th>Button URL</th>
                                                    <th>Action</th>
                                                </tr>
                                                @php $oldArray = []; @endphp
                                                @if(old('addMoreFields') && count(old('addMoreFields')) > 0)
                                                @php $oldArray = old('addMoreFields') @endphp
                                                @elseif($service && $service->assistBtns && count($service->assistBtns)
                                                >0)
                                                @php $oldArray = $service->assistBtns; @endphp
                                                @endif

                                                @php $i = 0; @endphp

                                                @if(count($oldArray)>0)
                                                @php $i = count($oldArray)-1; @endphp
                                                @foreach($oldArray as $index=>$filed)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="addMoreFields[{{$index}}][btn_text]"
                                                            placeholder="Enter Title" class="form-control"
                                                            value="{{@$filed['btn_text']}}" require />
                                                        @php $e = 'addMoreFields.'.$index.'.btn_text'; @endphp
                                                        @error($e)
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        {{ HtmlHelper::ServicePageDropdown("addMoreFields[$index][btn_url]",@$filed["btn_url"],[],['id'=>['value'=>Request::route('id'),'statement'=>'!='] ,'type'=>['statement'=>'=','value'=>'SERVICE']]) }}
                                                        @php $e = 'addMoreFields.'.$index.'.btn_url'; @endphp
                                                        @error($e)
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </td>
                                                    <td><button type="button"
                                                            class="btn btn-outline-danger remove-input-field">Delete</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td>
                                                        <input type="text" name="addMoreFields[0][btn_text]"
                                                            placeholder="Enter Button Text" class="form-control"
                                                            require />
                                                    </td>
                                                    <td>
                                                        {{ HtmlHelper::ServicePageDropdown('addMoreFields[0][btn_url]','',[],['id'=>['value'=>Request::route('id'),'statement'=>'!='],'type'=>['statement'=>'=','value'=>'PAGE']]) }}
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                @endif
                                            </table>
                                            @if(Request::route('id'))
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{route('services_index')}}" class="btn btn-primary">Back</a>
                                                @if(Request::route('id'))
                                                <button type="button" name="add" id="add_more_btns"
                                                    class="btn btn-outline-primary float-right">Add
                                                    More</button>
                                                @endif
                                            </div>
                                            @endif

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- specifications modal -->
    <div class="modal fade" id="IconModal" tabindex="-1" role="dialog" aria-labelledby="IconModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image Icon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="imageForm" name="imageForm" method="POST" action="">
                        <div class="row">
                            @foreach($ImageIcon as $icon)
                            <div class="col-sm-2">
                                <img src="{{ $icon->image }}" alt="Image Description" class="clickableImage"
                                    style="width: 60px;border: 1px solid #000;padding: 2px;">
                            </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="clickbtn" name="clickbtn" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- how workd modal -->
    <div class="modal fade" id="IconModalWork" tabindex="-1" role="dialog" aria-labelledby="IconModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image Icon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="imageForm" name="imageForm" method="POST" action="">
                        <div class="row">
                            @foreach($ImageIcon as $icon)
                            <div class="col-sm-2">
                                <img src="{{ $icon->image }}" alt="Image Description" class="clickableImage"
                                    style="width: 60px;border: 1px solid #000;padding: 2px;">
                            </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="clickbtn" name="clickbtn" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- why_educrafter modal -->
    <div class="modal fade" id="IconModal1" tabindex="-1" role="dialog" aria-labelledby="IconModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image Icon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="imageForm" name="imageForm" method="POST" action="">
                        <div class="row">
                            @foreach($ImageIcon as $icon)
                            <div class="col-sm-2">
                                <img src="{{ $icon->image }}" alt="Image Description" class="clickableImage"
                                    style="width: 60px;border: 1px solid #000;padding: 2px;">
                            </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="clickbtn" name="clickbtn" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>



</section>
<script>
$(document).ready(function() {
    // Show tab based on hash in URL on page load
    if (location.hash) {
        var tabID = $('[data-bs-target="' + location.hash + '"]');
        if (tabID.length > 0) {
            tabID.tab('show');
        } else {
            // Fallback to first tab if hash doesn't match any tab
            $('.nav-tabs a[data-bs-toggle="tab"]').first().tab('show');
        }
    }

    // Handle click on tab links to update hash in URL
    $(document.body).on("click", ".nav-tabs a[data-bs-toggle='tab']", function(event) {
        var tabTarget = $(this).attr("data-bs-target");
        if (tabTarget) {
            location.hash = tabTarget;
        }
    });

    // Handle popstate event (back/forward buttons)
    $(window).on("popstate", function() {
        var anchor = location.hash || $('.nav-tabs a[data-bs-toggle="tab"]').first().attr(
            "data-bs-target");
        if (anchor) {
            $('a[data-bs-target="' + anchor + '"]').tab('show');
        }
    });
});
</script>
<script src="{{ asset('js/summernote.js') }}"></script>


@include('services.service_page_js')

<script src="{{ asset('js/custom.min.js') }}"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>


<script>
// Initialize CKEditor for the textarea with id 'service_description'
document.addEventListener("DOMContentLoaded", function() {
    // Find all dynamically generated textareas with class 'editor'
    var dynamicTextareas = document.querySelectorAll('.editor');

    // Initialize CKEditor for each dynamically generated textarea
    dynamicTextareas.forEach(function(textarea) {
        ClassicEditor
            .create(textarea, {
                ckfinder: {
                    uploadUrl: '/upload-image',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },

                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
});
</script>

<!-- faq JS -->
<script type="text/javascript">
var i = 0;
$("#dynamic-ar").click(function() {
    ++i;
    $("#dynamicAddRemove").append(`<tr>
            <td>
                <table class="table child-table">
                    <tr>
                        <td>
                            <input type="text" name="addMoreInputFields['${i}'][question]" placeholder="Enter Question" class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="addMoreInputFields['${i}'][answer]" placeholder="Enter Answer" class="form-control editor"></textarea>
                        </td>
                    </tr>
                </table>
            </td>
            <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
        </tr>`);
    ClassicEditor
        .create($("#dynamicAddRemove").find('.editor').last()[0], {
            ckfinder: {
                uploadUrl: '/upload-image',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },

                data: {
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
        })
        .catch(error => {
            console.error(error);
        });

});

$(document).on('click', '.remove-input-field', function() {
    $(this).parents('tr').remove();
});
</script>

<!-- specifications JS -->
<script type="text/javascript">
var i = '{{$i}}';
$("#add_more_specification").click(function() {
    ++i;
    $("#specificationAddRemove").append(`<tr>
            <td>
                <input type="text" name="addMoreSpecificationFields[${i}][title]" placeholder="Enter Title" class="form-control" />
            <br>
            <div style="display: flex;" >
                    <input type="hidden" class="form-control" name="addMoreSpecificationFields[${i}][icon_url]" value="{{@$filed['icon']}}" id="WorkImageIcon_${i}" />
                    <button type="button" class="btn btn-primary text-center btnimageModal1" rel="${i}">
                        Select Icon
                    </button>
                    <div class="col-sm-1">
                        <img src="" alt="Image Description" class="WorkViewImage_${i}" style="width: 40px; border-radius: 21px;">
                    </div>
                </div> <br>
                <textarea name="addMoreSpecificationFields[${i}][description]" placeholder="Enter Description" class="form-control editor"></textarea>
            </td>
            <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
        </tr>`);
    ClassicEditor
        .create($("#specificationAddRemove").find('.editor').last()[0], {
            ckfinder: {
                uploadUrl: '/upload-image',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },

                data: {
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
        })
        .catch(error => {
            console.error(error);
        });

    $('.editor').summernote({
        toolbar: [

            ['style', ['style']],

            ['font', ['bold', 'underline', 'clear']],

            ['fontname', ['fontname']],

            ['color', ['color']],

            ['para', ['ul', 'ol', 'paragraph']],

            ['table', ['table']],

            ['insert', ['link', 'picture', 'video']],

            ['view', ['fullscreen', 'codeview', 'help']],
        ],
    });
});
$(document).on('click', '.remove-input-field', function() {
    $(this).parents('tr').remove();
});
$(document).on('click', '.btnimageModal1', function() {
    $('#clickbtn').val($(this).attr('rel'));
    $('#IconModal').modal('show');
});
$(document).ready(function() {
    $('.clickableImage').click(function() {
        var imagePath = $(this).attr('src');
        var aa = $('#clickbtn').val();
        $('#WorkImageIcon_' + aa).val(imagePath);
        $('.WorkViewImage_' + aa).attr('src', imagePath);
        // Close the modal
        $('#IconModal').modal('hide');
    });
});
</script>

<!-- ratings JS -->
<script type="text/javascript">
    //alert("{{@$r}}")
var r = "{{@$r}}";
$("#add_more_rating").click(function() {
    r++;
    $("#ratingsAddRemove").append(`<tr>
            <td>
                <input type="text" name="addMoreRatingFields[${r}][star_rating]" placeholder="Enter rating" class="form-control" require />
            </td>
            
            <td>
                <input type="text" name="addMoreRatingFields[${r}][address]" placeholder="Enter Name" class="form-control" require />
            </td>
            <td>
                <textarea name="addMoreRatingFields[${r}][description]" placeholder="Enter description" class="form-control" require></textarea>
            </td>

            <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
        </tr>`);
});
$(document).on('click', '.remove-input-field', function() {
    $(this).parents('tr').remove();
});
</script>

<!-- how works JS -->
<script type="text/javascript">
var i = '{{$i}}';
$("#add_more_how_works").click(function() {
    ++i;
    $("#howworksAddRemove").append(`<tr>
            <td>
                <input type="text" name="addMoreFields[${i}][title]" placeholder="Enter Title" class="form-control" />
            </td>
            <td>
            <div style="display: flex;">
                    <input type="hidden" class="form-control" name="addMoreFields[${i}][icon_url]" value="{{@$filed['icon']}}" id="WorkImageIcon_${i}"/>
                    <button type="button" class="btn btn-primary text-center btnimageModal2" rel="${i}">
                        Select icon
                    </button>
                    <div class="col-sm-1">
                        <img src="" alt="Image Description" class="WorkViewImage_${i}" style="width: 40px; border-radius: 21px;">
                    </div>
                </div>
            </td>
            <td>
                <textarea name="addMoreFields[${i}][description]" placeholder="Enter Description" class="form-control"></textarea>
            </td>
            <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
        </tr>`);
});
$(document).on('click', '.remove-input-field', function() {
    $(this).parents('tr').remove();
});
$(document).on('click', '.btnimageModal2', function() {
    $('#clickbtn').val($(this).attr('rel'));
    $('#IconModalWork').modal('show');
});
$(document).ready(function() {
    $('.clickableImage').click(function() {
        var imagePath = $(this).attr('src');
        var aa = $('#clickbtn').val();
        $('#WorkImageIcon_' + aa).val(imagePath);
        $('.WorkViewImage_' + aa).attr('src', imagePath);
        // Close the modal
        $('#IconModalWork').modal('hide');
    });
});
</script>

<!-- why_educrafter JS -->
<script type="text/javascript">
var i = '{{$i}}';
$("#add_more_why_educrafter").click(function() {
    ++i;
    $("#why_educrafterAddRemove").append(`<tr>
            <td>
                <input type="text" name="addMoreSpecificationFields[${i}][title]" placeholder="Enter Title" class="form-control" />
            </td>
            <td>
                <div style="display: flex;">
                    <input type="hidden" class="form-control" name="addMoreSpecificationFields[${i}][icon_url]" id="ImageIcon_${i}" />
                    <button type="button" class="btn btn-primary text-center btnimageModal3" rel="${i}">
                        Select icon
                    </button>
                    <div class="col-sm-6">
                        <img src="" alt="Image Description" class="viewImage_${i}" style="width: 40px; border-radius: 21px;">
                    </div>
                </div>
            </td>
            <td>
                <textarea name="addMoreSpecificationFields[${i}][description]" placeholder="Enter Description" class="form-control"></textarea>
            </td>
            <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
        </tr>`);
});
$(document).on('click', '.remove-input-field', function() {
    $(this).parents('tr').remove();
});
$(document).on('click', '.btnimageModal3', function() {
    $('#clickbtn').val($(this).attr('rel'));
    $('#IconModal1').modal('show');
});
$(document).ready(function() {
    $('.clickableImage').click(function() {
        var imagePath = $(this).attr('src');
        var aa = $('#clickbtn').val();
        $('#ImageIcon_' + aa).val(imagePath);
        $('.viewImage_' + aa).attr('src', imagePath);
        // Close the modal
        $('#IconModal1').modal('hide');
    });
});
</script>

<!-- assist_button JS -->
<script type="text/javascript">
var i = '{{$i}}';
$("#add_more_btns").click(function() {
    ++i;
    $("#buttonsAddRemove").append(`<tr>
            <td>
                <input type="text" name="addMoreFields[${i}][btn_text]" placeholder="Enter rating" class="form-control" require />
            </td>
            <td>
            {{ HtmlHelper::ServicePageDropdown('addMoreFields[${i}][btn_url]','',[], ['id'=>['value'=>Request::route('id'),'statement'=>'!=']]) }}
            </td>
            <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
        </tr>`);
});
$(document).on('click', '.remove-input-field', function() {
    $(this).parents('tr').remove();
});
</script>

@endsection