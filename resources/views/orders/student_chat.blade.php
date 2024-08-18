<div class="col-md-4">
    <!-- Profile Image -->
    <div class="card card-primary card-outline direct-chat direct-chat-primary">
        <div class="card-header" style="display: block;">
            <h3 class="card-title" >Student Chat</h3></br>
            <p class="text-muted text-left">{{ isset($data['student']['first_name']) ? $data['student']['first_name'] : '' }} {{ isset($data['student']['last_name']) ? ' ' . $data['student']['last_name'] : '' }}
            </p>
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
                        <span class="direct-chat-name float-right">{{isset($item['sendertable']['first_name']) ? $item['sendertable']['first_name'] : '' }}</span>
                        <span
                            class="direct-chat-timestamp float-left">{{date('m-d-Y h:i A', strtotime($item['created_at']))}}</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="{{ asset('images/avatar5.png') }}" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        {{$item['message']}}
                        <a style="color:#fff;" href="{{$item['attachment']}}"
                            target="_blank">{{$item['attachment']}}</a>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
                @else
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">{{$item['sendertable']['name']}}</span>
                        <span
                            class="direct-chat-timestamp float-right">{{date('m-d-Y h:i A', strtotime($item['created_at']))}}</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img style="border: 1px solid;" class="direct-chat-img" src="{{ asset('images/AdminLTELogo.png') }}"
                        alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        {{$item['message']}}
                        <a style="color:#fff;" href="{{$item['attachment']}}"
                            target="_blank">{{$item['attachment']}}</a>
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
                    <input type="hidden" name="receiver_id" value="{{isset($data->student->id)?$data->student->id:''}}">
                    <input type="hidden" name="order_id" value="{{isset($data->id)?$data->id:''}}">
                    <input type="hidden" name="type" value="STUDENT">
                    <span class="input-group-append">
                        <a class="btn btn-info btn-sm" href="javascript::void(0);"
                            onclick="document.getElementById('attachment').click()">
                            <i class="fas fa-paperclip"></i>
                        </a>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
<style>.direct-chat-messages{
    height: 300px!important;
}
</style>
<script>
    $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    </script>