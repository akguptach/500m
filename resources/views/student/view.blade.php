@extends('layouts.app')
@section('content')
<style>
    p.small {
        font-size: 16px;
        margin-left: 24px;
        color: black !important;
    }

    div:has(> ul.pagination) {
        float: right;
        margin-right: 20px;
    }
</style>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student</h3>
                    <div class="float-right">
                        <?php HtmlHelper::WebsiteTypeDropdown('website_type', $website, false, 'width:150px;', 'website_type') ?>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" id="success_message">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="example1" class="table table-responsive table-bordered row-border">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Website</th>
                                    <th>view</th>


                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{$student->id}}</td>
                                    <td>{{$student->first_name}}</td>
                                    <td>{{$student->last_name}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>{{$student->phone_number}}</td>
                                    <td>{{@$student->website->website_type}}</td>
                                    <td> <a href="{{route('orders', $student->id)}}" class="btn-sm btn btn-primary">View Orders
                                            <i class="fas fa-arrow-right"></i></a></td>


                                    <td>

                                        <a href="{{route('students.student.edit',['student'=>$student->id])}}" class="edit-link">
                                            <i class="fas fa-edit"></i>
                                        </a>



                                        <form method="POST" action="{!! route('students.student.change', $student->id) !!}" accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" value="PATCH" type="hidden">
                                            <input name="status" value="active" type="hidden">
                                            {{ csrf_field() }}
                                            <button @if($student->status=='active') disabled="disabled" @endif type="submit"
                                                class="btn btn-link " title="Inactivate Student"
                                                onclick="return new_modal(event,&quot;Click Ok to activate Student.&quot;)"
                                                style="padding: 0px;padding-bottom:3px;">
                                                <i class="fas fa-check-circle"></i>
                                            </button>

                                        </form>


                                        <form method="POST" action="{!! route('students.student.change', $student->id) !!}" accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" value="PATCH" type="hidden">
                                            <input name="status" value="inactive" type="hidden">
                                            {{ csrf_field() }}
                                            <button @if($student->status=='inactive') disabled="disabled" @endif
                                                type="submit" class="btn btn-link " title="Activate Student"
                                                onclick="return new_modal(event,&quot;Click Ok to Inactive Student.&quot;)"
                                                style="padding: 0px;padding-bottom:3px;">
                                                <i class="fas fa-times-circle"></i>
                                            </button>

                                        </form>

                                        <form method="POST" action="{!! route('students.student.destroy', $student->id) !!}" accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-link " title="Delete Student" onclick="return new_modal(event,&quot;Click Ok to delete Student.&quot;)" style="padding: 0px;padding-bottom:3px;">
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
                <div class="clearfix mt-2 pagination-div">
                    <div style="width: 100%;">
                        {!! $students->appends(request()->input())->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
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

<script>
    function generateParamsurl(params) {
        let paramString = '';
        Object.keys(params).forEach(function(key, index) {
            if (params[key] !== undefined && params[key] !== 'undefined') {
                paramString += (index > 0) ? '&' + key + '=' + params[key] : '?' + key + '=' + params[key]
            }
        })
        return paramString;
    }

    $(document).ready(function() {
        const searchParams = new URLSearchParams(window.location.search);
        var paramsList = {};
        for (const param of searchParams) {
            paramsList[param[0]] = param[1];
        }
        $('#website_type').change(function() {
            if (paramsList['page'])
                paramsList['page'] = 1;
            paramsList['website'] = $(this).val();
            window.location.href = "{{route('students.student.index')}}/" + generateParamsurl(paramsList);
        })
    })
</script>



<script>
    async function new_modal(event, msg) {
        event.preventDefault(); // Prevent form submission

        if (await confirm(msg)) {
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