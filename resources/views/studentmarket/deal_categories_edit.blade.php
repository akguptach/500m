@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
		
				@if (session('success_message'))
				<div class="alert alert-success" id="success_message">
					{{ session('success_message') }}
				</div>
				@endif
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Edit Deal Category</h3>
						<div class="float-right">
						</div>
					</div>
					<div class="card-body">
						<form method="POST" action="{{route('deal_categories.deal_category.update',$dealCategory->id)}}">
						    <div class="row">
							    <div class="col-sm-6">
								{{ csrf_field() }}
								@include ('studentmarket.form', [
								'dealCategory' => $dealCategory,
								])
								<div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
									<input class="btn btn-primary" type="submit" value="Update">
								</div>
							</div>
						</form>

					</div>
		       </div>
    </div>
</section>

@endsection