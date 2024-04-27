<footer class="main-footer">
    <strong>Copyright.</strong>
    All rights reserved.
</footer>
<aside class="control-sidebar control-sidebar-dark"></aside>

</div>

<script src="{{ asset('notifyjs/dist/notify.js') }}"></script>
<script src="{{ asset('notifications/notify-metro.js') }}"></script>
<script src="{{ asset('notifications/notifications.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('js/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('js/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('js/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('js/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('js/adminlte2167.js?v=3.2.0') }}"></script>
<script src="{{ asset('js/demo.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>


@php( $studentOrderMessages = \App\Models\StudentOrderMessage::where('read',0)
->where('receivertable_id',auth()->user()->id)
->where('receivertable_type','App\Models\User')
->get()->toArray())

@php( $qcOrderMessages = \App\Models\QcOrderMessage::where('read',0)
->where('receivertable_id',auth()->user()->id)
->where('receivertable_type','App\Models\User')
->get()->toArray())


@php( $teacherOrderMessages = \App\Models\TeacherOrderMessage::where('read',0)
->where('receivertable_id',auth()->user()->id)
->where('receivertable_type','App\Models\User')
->get()->toArray())


@php( $teacherOrderReqMessages = \App\Models\OrderRequestMessage::where('read',0)
->where('receivertable_id',auth()->user()->id)
->where('receivertable_type','App\Models\User')
->get())



@foreach($teacherOrderReqMessages as $message)

@if($message->request->type == 'TUTOR')
@php($url = route('tutor_request_sent',['id'=>$message->request->order_id]))
@else
@php($url = route('qc_request_sent',['id'=>$message->request->order_id]))
@endif
<script>
$.Notification.notify('info', 'top right',
    "<a href='{{$url}}'>New Message on Order Request</a>",
    "<p style='font-size:14px'>{{$message->message}}</p><p style='font-size:14px'>{{$message->attachment}}</p>")
</script>
@endforeach


@foreach($teacherOrderMessages as $message)
<script>
$.Notification.notify('info', 'top right',
    "<a href='{{route('orders.view',['orders'=>$message['order_id']])}}'>Teacher message on order</a>",
    "<p style='font-size:14px'>{{$message['message']}}</p><p style='font-size:14px'>{{$message['attachment']}}</p>")
</script>
@endforeach

@foreach($studentOrderMessages as $message)
<script>
$.Notification.notify('info', 'top right',
    "<a href='{{route('orders.view',['orders'=>$message['order_id']])}}'>Student message on order</a>",
    "<p style='font-size:14px'>{{$message['message']}}</p><p style='font-size:14px'>{{$message['attachment']}}</p>")
</script>
@endforeach


@foreach($qcOrderMessages as $message)
<script>
$.Notification.notify('info', 'top right',
    "<a href='{{route('orders.view',['orders'=>$message['order_id']])}}'>Qc message on order</a>",
    "<p style='font-size:14px'>{{$message['message']}}</p><p style='font-size:14px'>{{$message['attachment']}}</p>")
</script>
@endforeach

</body>

</html>