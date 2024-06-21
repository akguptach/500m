@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                                <div class="card-header d-flex justify-content-between align-items-center p-3">
                                    <h4 class="m-0">Create New Expert</h4>
                                    <div class="ml-auto">
                                        <a href="{{ route('experts.expert.index') }}" class="btn btn-primary" title="Show All Expert">
                                            <span aria-hidden="true"></span>View Expert
                                        </a>
                                    </div>
                                </div>



                                <div class="card-body">

       

                                        <form method="POST" class="needs-validation" novalidate action="{{ route('experts.expert.store') }}"
                                            accept-charset="UTF-8" id="create_expert_form" name="create_expert_form" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            @include ('experts.form', [
                                            'expert' => null,
                                            ])
                                            <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                                                <input class="btn btn-primary" type="submit" value="Add">
                                            </div>

                                        </form>

                                </div>




                        </div>    

                    </div>
                </div>
            </div>
       </div>
   </div>
</section>              
@endsection          