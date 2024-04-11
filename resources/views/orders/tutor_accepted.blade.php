<div class="col-md-9">
    <!-- Profile Image -->
    <div class="card card-primary card-outline direct-chat direct-chat-primary" style="height: 97%;">
        <div class="card-header">
            <h3 class="card-title">Teachers Chat</h3>
            </br>
            <p class="text-muted text-left">{{$orderRequestSent->tutor->tutor_first_name.' '.$orderRequestSent->tutor->tutor_last_name}}</p>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages" style="height: 400px;">
                <!-- Message. Default to the left -->
                @foreach ($teacherRequestMessage as $item)
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
            <form action="{{route('send_request_message')}}" method="post" enctype="multipart/form-data">
                @csrf
                @error('message')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="input-group">
                    <input type="file" name="attachment" id="tutorattachment" style="display: none;" />
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <input type="hidden" name="receiver_id" value="{{$orderRequestSent->tutor->id}}">
                    <input type="hidden" name="request_id" value="{{$orderRequestSent->id}}">
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