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
                                      <th>S.no</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Rating</th>
                                        <th>Rating Number</th>
                                        
                                        
                                        <th>Total Orders</th>
                                        <th>Subject </th>
                                        
                                        
                                        <th>Subject Number</th>
                                        <th>Action</th>
                                        <th>Add Review</th>
                                    </tr>
                                </thead>
                            <tbody>
                            <tr>
                                      <td>1</td>
                                        <td>rashid</td>
                                        <td>rah,,,,</td>
                                        <td>9778671255</td>
                                        <td>0157DFR4321</td>
                                        
                                        
                                        <td>
                                        Susscessful
                                        </td>
                                        <td>
                                        Susscessful
                                        </td>
                                        <td>0157DFR4321</td>
                                        <td>
                                        <a href="#" class="edit-link">
                                        <i class="fas fa-edit"></i> 
                                        </a>
                                        
                                        <a href="#" class="active-link">
                                        <i class="fas fa-check-circle"></i> 
                                        </a>
                                        <a href="#" class="deactive-link">
                                        <i class="fas fa-times-circle"></i> 
                                        </a>
                                        <a href="#" class="delete-link">
                                        <i class="fas fa-trash-alt"></i> 
                                        </a>
                                        </td>
                                        <td> <a href="#" class="btn-sm btn-primary">Add Review </a></td>
                           </tr>
                            </tbody>
                        </table>
                    </div>
                            
                                   
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