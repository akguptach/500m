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
<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student</h3>
                                <div class="float-right">
                                    <!-- <a href="{{ route('students.student.create') }}">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add
                                </a> -->
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
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
                                            <td> <a href="{{route('orders', $student->id)}}" class="btn-sm btn-primary">View Orders <i
                                                        class="fas fa-arrow-right"></i></a></td>


                                            <td>

                                                <a href="{{route('students.student.edit',['student'=>$student->id])}}" class="edit-link">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                

                                                <form method="POST"
                                                    action="{!! route('students.student.change', $student->id) !!}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" value="PATCH" type="hidden">
                                                    <input name="status" value="active" type="hidden">
                                                    {{ csrf_field() }}
                                                    <button @if($student->status=='active') disabled="disabled" @endif type="submit" class="btn btn-link " title="Inactivate Student"
                                                            onclick="return confirm(&quot;Click Ok to activate Student.&quot;)" style="padding: 0px;padding-bottom:3px;">
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                
                                                </form>


                                                <form method="POST"
                                                    action="{!! route('students.student.change', $student->id) !!}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" value="PATCH" type="hidden">
                                                    <input name="status" value="inactive" type="hidden">
                                                    {{ csrf_field() }}
                                                    <button @if($student->status=='inactive') disabled="disabled" @endif type="submit" class="btn btn-link " title="Activate Student"
                                                            onclick="return confirm(&quot;Click Ok to Inactive Student.&quot;)" style="padding: 0px;padding-bottom:3px;">
                                                            <i class="fas fa-times-circle"></i>
                                                        </button>
                                                
                                                </form>

                                                <!--<a href="#" class="deactive-link">
                                                    <i class="fas fa-times-circle"></i>
                                                </a>-->
                                                <!--<a href="#" class="delete-link">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>-->

                                                <form method="POST"
                                                    action="{!! route('students.student.destroy', $student->id) !!}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" value="DELETE" type="hidden">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-link " title="Delete Student"
                                                            onclick="return confirm(&quot;Click Ok to delete Student.&quot;)" style="padding: 0px;padding-bottom:3px;">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                
                                                </form>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="clearfix mt-2 pagination-div">
                                <div style="width: 100%;">
                                    {!! $students->appends([])->links('pagination::bootstrap-5') !!}
                                </div>
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


@endsection