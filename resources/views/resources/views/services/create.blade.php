@extends('layouts.app')
@section('content')
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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $type=='PAGE'?'Pages':'Services' }}</h3>

                            </div>
                            <div class="card-body">



                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="basic-tab" data-toggle="tab"
                                            data-target="#basic" type="button" role="tab" aria-controls="basic"
                                            aria-selected="true">Service</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="seo-tab" data-toggle="tab" data-target="#seo"
                                            type="button" role="tab" aria-controls="seo"
                                            aria-selected="false">Seo</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="faq-tab" data-toggle="tab" data-target="#faq"
                                            type="button" role="tab" aria-controls="faq"
                                            aria-selected="false">FAQ</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="specifications-tab" data-toggle="tab"
                                            data-target="#specifications" type="button" role="tab"
                                            aria-controls="specifications" aria-selected="false">Website content</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ratings-tab" data-toggle="tab"
                                            data-target="#ratings" type="button" role="tab" aria-controls="ratings"
                                            aria-selected="false">Ratings</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="how_works-tab" data-toggle="tab"
                                            data-target="#how_works" type="button" role="tab" aria-controls="how_works"
                                            aria-selected="false">How it Works</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="why_educrafter-tab" data-toggle="tab"
                                            data-target="#why_educrafter" type="button" role="tab"
                                            aria-controls="why_educrafter" aria-selected="false">Why EduCrafter</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="assist_buttons-tab" data-toggle="tab"
                                            data-target="#assist_buttons" type="button" role="tab"
                                            aria-controls="assist_buttons" aria-selected="false">Assist You
                                            Buttons</button>
                                    </li>
                                </ul>



                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active" id="basic" role="tabpanel"
                                        aria-labelledby="basic-tab">
                                        @include('services.service_basic')
                                    </div>

                                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                        @include('services.service_seo')
                                    </div>

                                    <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                                        @include('services.service_faq')
                                    </div>

                                    <div class="tab-pane fade" id="specifications" role="tabpanel"
                                        aria-labelledby="specifications-tab">
                                        @include('services.specifications')
                                    </div>

                                    <div class="tab-pane fade" id="ratings" role="tabpanel"
                                        aria-labelledby="ratings-tab">
                                        @include('services.services_ratings')
                                    </div>

                                    <div class="tab-pane fade" id="how_works" role="tabpanel"
                                        aria-labelledby="how_works-tab">
                                        @include('services.how_works')
                                    </div>
                                    <div class="tab-pane fade" id="assist_buttons" role="tabpanel"
                                        aria-labelledby="assist_buttons-tab">
                                        @include('services.services_assist_btns')
                                    </div>

                                    <div class="tab-pane fade" id="why_educrafter" role="tabpanel"
                                        aria-labelledby="why_educrafter-tab">
                                        @include('services.why_educrafter')
                                    </div>


                                </div>





                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@include('services.service_page_js')
<script>
$(document).ready(function() {
    if (location.hash) {
        console.log('location.hash', location.hash)
        var tabID = location.hash;
        $('.nav-tabs button[data-target="' + tabID + '"]').tab('show');
    }
    $(document.body).on("click", "button[data-toggle='tab']", function(event) {
        location.hash = this.getAttribute("data-target");
    });
});
$(window).on("popstate", function() {
    var anchor = location.hash || $("button[data-toggle='tab']").first().attr("data-target");
    $("button[data-target='" + anchor + "']").tab("show");
});
</script>
@endsection