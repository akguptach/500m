@extends('layouts.app')
@section('content')
<style>
  myModal.in {
    z-index: 999999;
  }
</style>
<section class="content-header">
  <div class="container-fluid">
    <section class="content">
      <!-- <div class="container-fluid"> -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tutor</h3>
              <div class="float-right">
                <a href="{{ route('tutor.create') }}" class="btn btn-primary">
                  <i class="fa fa-plus" aria-hidden="true"></i> Add
                </a>
              </div>
            </div>
            <div class="card-body">
              @if (session('status'))
              <div class="alert alert-success" id="success_message">
                {{ session('status') }}
              </div>
              @endif
              <table id="example1" class="table table-responsive table-bordered table-striped row-border">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Status</th>
                    <th>Views</th>
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
      <!-- </div> -->
    </section>
  </div>

  <div class="modal  modal-full-width" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="form-control" data-bs-dismiss="modal" style="width: min-content;">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body" id="modalContent">
          <!-- Content loaded dynamically -->
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>


<script>
  $(document).ready(function() {
    $("#MyModal").modal();
  });
  $(function() {
    $('#example1').DataTable({
      "columns": [{
          data: 'id',
          render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        },
        {
          data: "tutor_first_name"
        },
        {
          data: "tutor_last_name"
        },
        {
          data: "tutor_email"
        },
        {
          data: "tutor_contact_no"
        },
        {
          data: "status"
        },
        {
          data: "views"
        },
        {
          data: "action"
        }
      ],
      "processing": true,
      "serverSide": true,
      "ajax": "<?php echo URL::to('tutor');; ?>?status=<?= @$status; ?>"
    });
  });

  async function delete_tutor(msg, id) {
    if (await confirm(msg)) {
      var form = $('#tutor_form_' + id);
      var token = $('#csrf_' + id).val();
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

  function addressData(url1, tutor_id) {
    $.ajax({
      type: 'GET',
      url: '../' + url1 + '/' + tutor_id, // Replace with your server-side script URL
      dataType: 'html',
      success: function(response) {
        // Update modal content with the fetched data
        $('#modalContent').html(response);
      },
      error: function(error) {
        console.log(error);
        // Handle errors
      }
    });
  }
</script>
<script>
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