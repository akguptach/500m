@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
		<div class="row">
			
			<div class="col-lg-12">
				@if (session('success_message'))
				<div class="alert alert-success" id="success_message">
					{{ session('success_message') }}
				</div>
				@endif
				
				 @if($errors->any())
					 {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
				 @endif

				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Deals Category</h4>
						

					</div>
					<div class="card-body">
						<div class="form-validation">
							
							<form method="POST" action="{{route('deal_categories.deal_category.store')}}" class="needs-validation" action="" accept-charset="UTF-8" id="" name="">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-xl-6">
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Category Name<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" name="category_name" type="text" id="category_name" value="{{ old('category_name') }}" minlength="1" placeholder="Enter category name here..." required>
												{!! $errors->first('category_name', '<div class="invalid-feedback">:message</div>') !!}
												<div class="invalid-feedback">
													....
												</div>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Website Type<span class="text-danger">*</span></label>
											
											<div class="col-lg-6">
												 @foreach($dealCategories as $dealCategory1)
												 @endforeach
												{{ HtmlHelper::WebsiteDropdown('website_type', old('website_type', optional($dealCategory1)->website_type), false, '', 'website_type') }}
												{!! $errors->first('website_type', '<div class="invalid-feedback">:message</div>') !!}
												<div class="invalid-feedback">
													Please select a one.
												</div>
											</div>
										</div>

										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Status<span class="text-danger">*</span></label>
											<div class="col-lg-6">
												<select class="default-select wide form-control" name="status" id="status" required>
													<option value="">Status</option>
													<option value="active">Active</option>
													<option value="inactive">Inactive</option>
												</select>
												<div class="invalid-feedback">
													Please select a one.
												</div>
											</div>
										</div>
									</div>
								</div>
								<button type="submit" class="btn me-2 btn-primary">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Deal Category List</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table border-dashed table-responsive-sm">
								<thead>
									<tr>
										<th>Deal Category Name</th>
										<th>Website Type</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach($dealCategories as $dealCategory)
									<tr>
										<td class="align-middle">{{ $dealCategory->category_name }}</td>
										<td class="align-middle">{{ ucfirst($dealCategory->website_type) }}</td>
										<td class="align-middle">
										
										{{ ucfirst($dealCategory->status) }}
										
										
										</td>
										<td class="align-middle" style="display: flex;">


											<a style="padding: 0px;padding-bottom:3px;margin-right: 2px;" href="{{ route('deal_categories.deal_category.edit', $dealCategory->id ) }}" class="edit-link" title="Edit Deal Category">
												<i class="fas fa-edit"></i>
											</a>

											<form method="POST" action="{!! route('deal_categories.deal_category.destroy', $dealCategory->id) !!}">
												{{ csrf_field() }}

												@if($dealCategory->status=='active')
												<button style="padding: 0px;padding-bottom:3px;" name="action" value="inactive" type="submit" class="btn btn-link " title="Inactivate Deal Category" onclick="return new_modal(event,'Click Ok to Inactivate Deal Category.')">
													<i class="fas fa-check-circle"></i>
												</button>
												@endif

												@if($dealCategory->status=='inactive')
												<button style="padding: 0px;padding-bottom:3px;" name="action" value="active" type="submit" class="btn btn-link " title="activate Deal Category" onclick="return new_modal(event,'Click Ok to activate Deal Category.')">

													<i class="fas fa-times-circle"></i>
												</button>
												@endif


												<button style="padding: 0px;padding-bottom:3px;" name="action" value="delete" type="submit" class="btn btn-link " title="Delete Deal Category" onclick="return new_modal(event,'Click Ok to delete Deal Category.')">
													<i class="fas fa-trash-alt"></i>
												</button>

											</form>
										</td>
									</tr>
									@endforeach
								
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#limit').change(function() {
            $('#page-limit-form').submit();
        })
        $('#website_type_filter').change(function() {
            $('#page-limit-form').submit();
        })
    })
</script>

<script>
    async function new_modal(event, msg) {
        event.preventDefault(); // Prevent form submission

        if (await confirm(msg)) {
            let button = event.target.closest('button');

            // Create a hidden input to hold the button's value
            let hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = button.name;
            hiddenInput.value = button.value;

            // Append the hidden input to the form
            event.target.closest('form').appendChild(hiddenInput);
            event.target.closest('form').submit(); // Submit the form if confirmed
        }
    }

    // Function to show Bootstrap modal as confirmation
    function showBootstrapConfirm(msg, callback) {
        // Create modal markup
        var modalMarkup = `
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button type="button" class="close btn border" style="padding: 1% 2%;" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p>${msg}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Yes</button>
                </div>
                </div>
            </div>
        </div>
        `;
        var modalElement = $(modalMarkup).appendTo('body');
        $(modalElement).modal('show');
        $(modalElement).find('.btn-primary').click(function() {
            callback(true); // Call callback with true indicating confirmation
            $(modalElement).modal('hide'); // Hide modal
        });
        $(modalElement).find('.btn-secondary').click(function() {
            callback(false); // Call callback with false indicating cancellation
            $(modalElement).modal('hide'); // Hide modal
        });
        $(modalElement).on('hidden.bs.modal', function() {
            $(this).remove(); // Remove modal from DOM when closed
        });
    }

    window.confirm = function(msg) {
        return new Promise(function(resolve) {
            showBootstrapConfirm(msg, function(result) {
                resolve(result);
            });
        });
    };
</script>

@endsection