@extends('layouts.app')
@section('content')




<div class="card text-bg-theme">

<div class="card-header d-flex justify-content-between align-items-center p-3">
   <h4 class="m-0">Add Deals</h4>
   <div class="ml-auto">
       <a href="{{ route('studentmarket.student.view_deals') }}" class="btn btn-primary" title="Show All Expert">
           <span aria-hidden="true"></span>View Deal
       </a>
   </div>
</div>


<div class="card-body">


                   <form method="get" class="needs-validation" novalidate action="" accept-charset="UTF-8" id="" name="" >
                   {{ csrf_field() }}
                   @include ('studentmarket.form1', [
                                               'expert' => null,
                                           ])

                       <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                           <input class="btn btn-primary" type="submit" value="Add">
                       </div>

                   </form>

</div>
</div>



@endsection