@extends('layouts.app')
@section('content')
<section class="content-header">
<div class="container-fluid">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Of Subjects(Only For Assignment)</h3>
                            <div class="float-right">
                                <a href="{{ route('coupon.create') }}">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success"  id="success_message">
                                {{ session('status') }}
                            </div>
                        @endif
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Subject Name</th>
										<th>Minimum Words Rate</th>
										<th>Additional Per Workd Rate</th>
										<th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
</section>
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function () {
    $('#example1').DataTable( {
				 "columns": [
                { data: "srno" },
                { data: "subject_name" },
				{ data: "price" },
				{ data: "additional_word_rate" },
				{ data: "status" },
                { data: "action" }
            ],
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo URL::to('coupon');
;?>"
    } );
  });
  function delete_subject(msg,id){
    if(confirm(msg)){
        var form = $('#subject_form_'+id);
        var token = $('#csrf_'+id).val();
        // Create a hidden input field to send the CSRF token
        var csrfInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', '_token')
            .val(token);
        // Create a hidden input field to send the DELETE method
        var methodInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', '_method')
            .val('DELETE');
        // Append the hidden input fields to the form
        form.append(csrfInput, methodInput);
        // Submit the form
        form.submit();
    }
  }
</script>
@endsection