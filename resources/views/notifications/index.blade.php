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
                                <h3 class="card-title">Notifications</h3>
                                <div class="float-right" style="display: flex;">
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
                                            <th>Order id</th>
                                            <th>Sender</th>
                                            <th>Message</th>
                                            <th>Receiver</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($data as $item)
                                        <tr>
                                            <td>MAS{{$item->order_id}}</td>
                                            <td>
                                            @if ($item['sendertable_type']== 'App\Models\Tutor')
                                            {{$item['sendertable']['tutor_first_name']}} ({{$item->message_type}})
                                            @elseif ($item['sendertable_type']== 'App\Models\Student')
                                            {{@$item['sendertable']['first_name']}} ({{@$item->message_type}})
                                            @elseif ($item['sendertable_type']== 'App\Models\User')
                                            {{$item['sendertable']['name']}}
                                            @endif
                                            
                                            </td>
                                            <td width="250px"><span
                                                    style="overflow-wrap: anywhere;">{{$item->message}}</span>
                                                    <span style="overflow-wrap: anywhere;"><a href="{{$item['attachment']}}" target="_blank" >{{$item['attachment']}}</a></span>
                                            </td>
                                            <td>
                                            @if ($item['receivertable_type']== 'App\Models\Tutor')
                                            {{$item['receivertable']['tutor_first_name']}} ({{$item->message_type}})
                                            @elseif ($item['receivertable_type']== 'App\Models\Student')
                                            {{$item['receivertable']['first_name']}} ({{$item->message_type}})
                                            @elseif ($item['receivertable_type']== 'App\Models\User')
                                            {{$item['receivertable']['name']}}
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{route('orders.view',$item->order_id)}}">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                            <div class="clearfix mt-2 pagination-div">
                                <div style="width: 100%;">
                                    {!! $data->appends(request()->input())->links('pagination::bootstrap-5') !!}
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