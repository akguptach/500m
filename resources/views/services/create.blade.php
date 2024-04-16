@extends('layouts.app')
@section('content')
<style>
  .nav-item {
    padding-right: 2px;
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
                <h3 class="card-title">Services</h3>

              </div>
              <div class="card-body">



                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="basic-tab" data-toggle="tab" data-target="#basic" type="button" role="tab" aria-controls="basic" aria-selected="true">Service</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="seo-tab" data-toggle="tab" data-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="false">Seo</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="faq-tab" data-toggle="tab" data-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false">FAQ</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="specifications-tab" data-toggle="tab" data-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="false">Specifications</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ratings-tab" data-toggle="tab" data-target="#ratings" type="button" role="tab" aria-controls="ratings" aria-selected="false">Ratings</button>
                  </li>
                </ul>



                <div class="tab-content" id="myTabContent">

                  <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                    @include('services.service_basic')
                  </div>

                  <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                    @include('services.service_seo')
                  </div>

                  <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                    @include('services.service_faq')
                  </div>

                  <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                    @include('services.specifications')
                  </div>

                  <div class="tab-pane fade" id="ratings" role="tabpanel" aria-labelledby="ratings-tab">
                    @include('services.services_ratings')
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