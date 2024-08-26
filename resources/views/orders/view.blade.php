@extends('layouts.app')
@section('content')
<style> 

.paginate_button  {
    padding : 8px!important;
}
#loadingoverlay {
    position: absolute;
    top: 0;
    z-index: 100;
    width: 100%;
    height: 100%;
    display: none;
    background: rgba(0, 0, 0, 0.6);
}

.cv-spinner {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 4px #ddd solid;
    border-top: 4px #2e93e6 solid;
    border-radius: 50%;
    animation: sp-anime 0.8s infinite linear;
}

@keyframes sp-anime {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(359deg);
    }
}
</style>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Orders</h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>



<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!--<div class="card-header">
                                <h3 class="card-title">Orders</h3>
                            </div>-->
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" id="success_message">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="table-responsive table-bordered">
                            <table id="example1" class="table table-responsive table-bordered table-bordered  row-border">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Task Code</th>
                                        <th>Student Name</th>
                                        <th>Website</th>
                                        <th>Subject</th>
                                        <!--<th>Task type</th>
										<th>Lebel of study</th>
										<th>Grade</th>
										<th>Referencing Style</th>-->
                                        <th>Words</th>
                                        <th>Amount</th>
                                     
                                        <th>Delivery Date</th>

                                        <th width="15%">Actions</th>
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
    </div>
</section>

<div class="modal fade" id="modal-assign-teacher">
    <div class="modal-dialog">
        <div class="modal-content" id="teachers-modal-body">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<style>
    .toolbar {
        float: right;
        margin-left: 10px;
    }
</style>

<script>
    $(document).on("click", '.assign-teacher', function(event) {
        var dataModelBody = $('#' + $(this).attr('data-model-body'));
        $('#' + $(this).attr('data-modal-id')).modal('show');
        dataModelBody.html('<div class="loader"></div>');
        $.ajax({
            type: "GET",
            url: $(this).attr('data-ajax-url'),
            success: function(data) {
                dataModelBody.html(data);
                datepicker_assign();
            },
            error: function() {
                dataModelBody.html('');
            }
        });
    });

    $(document).on("submit", '#assign-qc-form', function(e) {

        $('.text-danger').html('');
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var actionUrl = form.attr('action');
        var formData = form.serialize();
        $('#loadingoverlay').show();
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: formData, // serializes the form's elements.
            success: function(data) {
                $('#loadingoverlay').hide();
                $('#modal-assign-teacher').modal('hide');
                alert(data);
                location.reload();
                //$('#teachers-modal-body').html('<div class="alert alert-success" role="alert">' + data + '</div>');
                //
            },
            error: function(e) {
                $('#loadingoverlay').hide();
                const eResponse = e.responseJSON
                $('#delivery_date_error').html((eResponse.errors && eResponse.errors.delivery_date) ?
                    eResponse.errors.delivery_date[0] : '');
                $('#teacher_id_error').html((eResponse.errors && eResponse.errors.teacher_id) ?
                    eResponse.errors.teacher_id[0] : '');
                console.log(e.responseJSON)
            }
        });
    });



    $(function() {
        $('#example1').DataTable({
            dom: '<"toolbar">frtip',
            initComplete: function() {
                this.api().columns([2]).every(function() {
                    var column = this;
                    var website_type = $('#website_type')
                        .on('change', function() {
                            var val = $(this).val();
                            column.search(val).draw();
                        });

                });
            },
            "columns": [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, 
                
                {
                    data: 'order_number',
                    render: function(data, type, row, meta) {
                        return '<a style="color:blue" href="/orders/'+row.id+'/view">'+row.order_number+'</a>';
                    }
                },

                {
                    data: "first_name"
                },
                {
                    data: "website_type"
                },
                {
                    data: "subject_name"
                },

                {
                    data: "no_of_words"
                },
                {
                    data: "price",
                    render: function(data, type, row, meta) {
                        return row.currency_code+row.price;
                    }
                },
                
                {
                    data: "delivery_date"
                },
                {
                    data: "action"
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax": "{{url()->full()}}"
            });
        document.querySelector('div.toolbar').innerHTML =
            '<?php HtmlHelper::WebsiteDropdown('website_type', '', false, 'height: 31px;padding: -16.625rem .75rem;padding: .200rem .75rem;', 'website_type') ?>';
    });
</script>

<script src="{{ asset('vendor\bootstrap-datepicker-master\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>


<script>
    function datepicker_assign() {
        $(".datepicker").datepicker({
            autoclose: true,
            dateFormat: 'yy-mm-dd', // Set the date format to yyyy-mm-dd
        }).on('change', function() {

        });
    }
</script>
<style>
    #myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}


</style>
<script>
function filterTable() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {

    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

@endsection