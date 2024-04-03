@extends('layouts.app')

@section('content')





<div class="content-header">
  <div class="container-fluid">

    @if (Session::has('success'))
    <div class="alert alert-success">
      {{ Session::get('success') }}
    </div>
    @endif

    @if (Session::has('error'))
    <div class="alert alert-danger">
      {{ Session::get('error') }}
    </div>
    @endif

    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Orders Details</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Orders</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <h3 class="profile-username text-center">Order Details</h3>
            <p class="text-muted text-center">{{ $data['student']['first_name'] . ' ' . $data['student']['last_name'] }}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Website</b> <a class="float-right">{{$data['website']['website_name']}}</a>
              </li>
              <li class="list-group-item">
                <b>Subject</b> <a class="float-right">{{$data['subject']['subject_name']}}</a>
              </li>
              <li class="list-group-item">
                <b>No Of Words</b> <a class="float-right">{{$data['no_of_words']}}</a>
              </li>
              <li class="list-group-item">
                <b>Amount</b> <a class="float-right">{{$data['price']}}</a>
              </li>
              <li class="list-group-item">
                <b>Currency</b> <a class="float-right">{{$data['currency_code']}}</a>
              </li>
              <li class="list-group-item">
                <b>Delivery Date</b> <a class="float-right">{{date('m-d-Y', strtotime($data['delivery_date']))}}</a>
              </li>
              <li class="list-group-item">
                <b>Attachment</b> <a class="float-right">{{$data['fileupload']}}</a>
              </li>
            </ul>

            <a href="#" class="btn btn-block btn-success btn-lg"><b>Approved</b></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      @if($orderAssign > 0)
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline direct-chat direct-chat-primary">
          <div class="card-header">
            <h3 class="card-title">Student Chat</h3></br>
            <p class="text-muted text-left">{{ $data['student']['first_name'] . ' ' . $data['student']['last_name'] }}</p>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">

              @foreach ($studentMessages as $item)

              @if ($item['sendertable_type']== 'App\Models\Student')

              <!-- Message to the right -->
              <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-right">{{$item['sendertable']['first_name']}}</span>
                  <span class="direct-chat-timestamp float-left">{{date('m-d-Y h:i A', strtotime($item['created_at']))}}</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="{{ asset('images/avatar5.png') }}" alt="Message User Image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {{$item['message']}}
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->
              @else
              <!-- Message. Default to the left -->
              <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-left">{{$item['sendertable']['name']}}</span>
                  <span class="direct-chat-timestamp float-right">{{date('m-d-Y h:i A', strtotime($item['created_at']))}}</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img style="border: 1px solid;" class="direct-chat-img" src="{{ asset('images/AdminLTELogo.png') }}" alt="Message User Image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {{$item['message']}}
                  <a href="/{{$item['attachment']}}" target="_blank">{{$item['attachment']}}</a>
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->

              @endif
              @endforeach
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <form action="{{route('send_message')}}" method="post" enctype="multipart/form-data">
              @csrf




              <div class="input-group">
                <input type="file" name="attachment" id="attachment" style="display: none;" />
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                <input type="hidden" name="receiver_id" value="{{$data->student->id}}">
                <input type="hidden" name="order_id" value="{{$data->id}}">
                <input type="hidden" name="type" value="STUDENT">
                <span class="input-group-append">
                  <a class="btn btn-info btn-sm" href="javascript::void(0);" onclick="document.getElementById('attachment').click()">
                    <i class="fas fa-paperclip"></i>
                  </a>
                  <button type="submit" class="btn btn-primary">Send</button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline direct-chat direct-chat-primary">
          <div class="card-header">
            <h3 class="card-title">Teachers Chat</h3>
            </br>
            <p class="text-muted text-left">{{@$data->teacherAssigned->teacher->tutor_first_name.' '.@$data->teacherAssigned->teacher->tutor_last_name}}</p>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
              <!-- Message. Default to the left -->
              @foreach ($teacherOrderMessage as $item)
              @if ($item['sendertable_type']== 'App\Models\Tutor')
              <!-- Message to the right -->
              <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-right">{{$item['sendertable']['tutor_first_name']}}</span>
                  <span class="direct-chat-timestamp float-left">{{date('m-d-Y h:i A', strtotime($item['created_at']))}}</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="{{ asset('images/avatar.png') }}" alt="Message User Image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {{$item['message']}}
                  <a href="/{{$item['attachment']}}" target="_blank">{{$item['attachment']}}</a>
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->
              @else
              <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-left">{{$item['sendertable']['name']}}</span>
                  <span class="direct-chat-timestamp float-right">{{date('m-d-Y h:i A', strtotime($item['created_at']))}}</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img style="border: 1px solid;" class="direct-chat-img" src="{{ asset('images/AdminLTELogo.png') }}" alt="Message User Image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {{$item['message']}}
                  <a href="/{{$item['attachment']}}" target="_blank">{{$item['attachment']}}</a>
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->
              @endif
              @endforeach
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <form action="{{route('send_message')}}" method="post" enctype="multipart/form-data">
              @csrf
              @error('message')
              <small class="text-danger">{{ $message }}</small>
              @enderror
              <div class="input-group">
                <input type="file" name="attachment" id="tutorattachment" style="display: none;" />
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                <input type="hidden" name="receiver_id" value="{{$data->teacherAssigned->teacher->id}}">
                <input type="hidden" name="order_id" value="{{$data->id}}">
                <input type="hidden" name="type" value="TUTOR">
                <span class="input-group-append">
                  <a class="btn btn-info btn-sm" href="javascript::void(0);" onclick="document.getElementById('tutorattachment').click()" value="Select a File">
                    <i class="fas fa-paperclip"></i>
                  </a>
                  <button type="submit" class="btn btn-primary">Send</button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
      @endif





      @if($qcAssign > 0)
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline direct-chat direct-chat-primary">
          <div class="card-header">
            <h3 class="card-title">QC Chat</h3>
            </br>
            <p class="text-muted text-left">{{@$data->qcAssigned->qc->tutor_first_name.' '.@$data->qcAssigned->qc->tutor_last_name}}</p>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
              @foreach ($qcOrderMessage as $item)
              @if ($item['sendertable_type']== 'App\Models\Tutor')
              <!-- Message to the right -->
              <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-right">{{$item['sendertable']['tutor_first_name']}}</span>
                  <span class="direct-chat-timestamp float-left">{{date('m-d-Y h:i A', strtotime($item['created_at']))}}</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="{{ asset('images/avatar.png') }}" alt="Message User Image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {{$item['message']}}
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->
              @else
              <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-left">{{$item['sendertable']['name']}}</span>
                  <span class="direct-chat-timestamp float-right">{{date('m-d-Y h:i A', strtotime($item['created_at']))}}</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img style="border: 1px solid;" class="direct-chat-img" src="{{ asset('images/AdminLTELogo.png') }}" alt="Message User Image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {{$item['message']}}
                  <a href="/{{$item['attachment']}}" target="_blank">{{$item['attachment']}}</a>
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->
              @endif
              @endforeach
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <form action="{{route('send_message')}}" method="post" enctype="multipart/form-data">
              @csrf
              @error('message')
              <small class="text-danger">{{ $message }}</small>
              @enderror
              <div class="input-group">
                <input type="file" name="attachment" id="qcattachment" style="display: none;" />
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">

                <input type="hidden" name="receiver_id" value="{{$data->qcAssigned->qc->id}}">
                <input type="hidden" name="order_id" value="{{$data->id}}">
                <input type="hidden" name="type" value="QC">
                <span class="input-group-append">
                  <a class="btn btn-info btn-sm" href="javascript::void(0);" onclick="document.getElementById('qcattachment').click()" value="Select a File">
                    <i class="fas fa-paperclip"></i>
                  </a>


                  <button type="submit" class="btn btn-primary">Send</button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
      @endif
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>



@endsection