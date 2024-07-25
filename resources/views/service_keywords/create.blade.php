@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create <small>Service Keyword</small></h3>
                    </div>
                    <form method="POST" class="needs-validation" novalidate action="{{ route('service_keywords.service_keyword.store') }}" accept-charset="UTF-8" id="create_service_keyword_form" name="create_service_keyword_form" >
                        @csrf
                        
                        @include ('service_keywords.form', [
                        'serviceKeyword' => null,
                        ])

                        <div class="mb-3 row">
                            <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3"></label>
                            <div class="col-lg-10 col-xl-9">
                                <input style="margin-left: 12px;" class="btn btn-primary" type="submit" value="Add">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection