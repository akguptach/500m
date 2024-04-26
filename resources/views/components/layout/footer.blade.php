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


@php( $messages = \App\Models\StudentOrderMessage::where('read',0)->get() )
@foreach($messages as $message)
<script>
$.Notification.notify('info', 'top right',
    "<a href='{{route('orders.view',['orders'=>$message->order_id])}}'>New Message</a>",
    "<p>{{$message->message}}</p><p>{{$message->attachment}}</p>")
</script>
@endforeach

</body>

</html>