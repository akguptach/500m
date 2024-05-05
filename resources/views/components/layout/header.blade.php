<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Essay Help</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ asset('js/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('js/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('js/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('js/plugins/jqvmap/jqvmap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/adminlte.min2167.css?v=3.2.0') }}">

    <link rel="stylesheet" href="{{ asset('js/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <link rel="stylesheet" href="{{ asset('js/plugins/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.min.css') }}">


    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('notifications/notification.css') }}">
    <script src="{{ asset('js/jquery.min3.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <style>
    .notifications {
        width: 300px;
        max-height: 400px;

    }

    .notifications h2 {
        font-size: 14px;
        padding: 10px;
        border-bottom: 1px solid #eee;
        color: #999
    }

    .notifications h2 span {
        color: #f00
    }

    .notifications-item {
        display: flex;
        border-bottom: 1px solid #eee;
        padding: 6px 9px;
        margin-bottom: 0px;
        cursor: pointer
    }

    .notifications-item:hover {
        background-color: #eee
    }

    .notifications-item img {
        display: block;
        width: 50px;
        height: 50px;
        margin-right: 9px;
        border-radius: 50%;
        margin-top: 2px
    }

    .notifications-item .text h4 {
        color: #777;
        font-size: 16px;
        margin-top: 3px
    }

    .notifications-item .text p {
        color: #aaa;
        font-size: 12px
    }

    .button__badge {
        background-color: #fa3e3e;
        border-radius: 2px;
        color: white;
        padding: 0px 4px;
        font-size: 10px;
        position: absolute;
        top: -7%;
        right: 8%;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <div class="animation__shake">Loading</div>
            <?php /*<img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">*/ ?>
        </div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                @php( $qcOrderMessages = \App\Models\QcOrderMessage::with(['sendertable'])->where('read',0)
                ->where('receivertable_id',auth()->user()->id)
                ->where('receivertable_type','App\Models\User')
                ->get()->toArray())

                @php( $studentOrderMessages =
                \App\Models\StudentOrderMessage::with(['sendertable'])->where('read',0)
                ->where('receivertable_id',auth()->user()->id)
                ->where('receivertable_type','App\Models\User')
                ->get()->toArray())

                @php( $teacherOrderMessages =
                \App\Models\TeacherOrderMessage::with(['sendertable'])->where('read',0)
                ->where('receivertable_id',auth()->user()->id)
                ->where('receivertable_type','App\Models\User')
                ->get()->toArray())


                @php( $teacherOrderReqMessages =
                \App\Models\OrderRequestMessage::with(['sendertable'])->where('read',0)
                ->where('receivertable_id',auth()->user()->id)
                ->where('receivertable_type','App\Models\User')
                ->get())
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>
                        <span
                            class="button__badge">{{count($studentOrderMessages)+count($qcOrderMessages)+count($teacherOrderMessages)+count($teacherOrderReqMessages)}}</span>
                    </a>





                    <div class="notifications dropdown-menu" id="box">
                        <h2>Notifications -
                            <span>{{count($studentOrderMessages)+count($qcOrderMessages)+count($teacherOrderMessages)+count($teacherOrderReqMessages)}}</span>
                        </h2>
                        @foreach($studentOrderMessages as $message)
                        <div class="notifications-item">
                            <div class="text" style="width: 88%;word-wrap: break-word;">
                                <h4>{{$message['sendertable']['first_name']}} {{$message['sendertable']['last_name']}}
                                </h4>
                                <p>{{$message['message']}}</p>
                                <p><a href="{{$message['attachment']}}" target="_blank">{{$message['attachment']}}</a>
                                </p>
                            </div>
                            <div>
                                <a href="{{route('orders.view',['orders'=>$message['order_id']])}}">View</a>
                            </div>

                        </div>
                        @endforeach

                        @foreach($teacherOrderMessages as $message)
                        <div class="notifications-item">
                            <div class="text" style="width: 88%;word-wrap: break-word;">
                                <h4>{{$message['sendertable']['tutor_first_name']}}
                                </h4>
                                <p>{{$message['message']}}</p>
                                <p><a href="{{$message['attachment']}}" target="_blank">{{$message['attachment']}}</a>
                                </p>
                            </div>
                            <div>
                                <a href="{{route('orders.view',['orders'=>$message['order_id']])}}">View</a>
                            </div>
                        </div>
                        @endforeach

                        @foreach($teacherOrderReqMessages as $message)
                        @if($message->request->type == 'TUTOR')
                        @php($url = route('tutor_request_sent',['id'=>$message->request->order_id]))
                        @else
                        @php($url = route('qc_request_sent',['id'=>$message->request->order_id]))
                        @endif
                        <div class="notifications-item">
                            <div class="text" style="width: 88%;word-wrap: break-word;">
                                <h4>{{$message['sendertable']['tutor_first_name']}}
                                </h4>
                                <p>{{$message['message']}}</p>
                                <p><a href="{{$message['attachment']}}" target="_blank">{{$message['attachment']}}</a>
                                </p>
                            </div>
                            <div>
                                <a href="{{$url}}">View</a>
                            </div>
                        </div>
                        @endforeach



                        @foreach($qcOrderMessages as $message)
                        <div class="notifications-item">
                            <div class="text" style="width: 88%;word-wrap: break-word;">
                                <h4>{{$message['sendertable']['tutor_first_name']}}
                                </h4>
                                <p>{{$message['message']}}</p>
                                <p><a href="{{$message['attachment']}}" target="_blank">{{$message['attachment']}}</a>
                                </p>
                            </div>
                            <div>
                                <a href="{{route('orders.view',['orders'=>$message['order_id']])}}">View</a>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </li>



                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item">
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>