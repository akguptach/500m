<div id="loadingoverlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>
<form id="assign-qc-form" action="{{$actionUrl}}">
    @csrf
    <div class="modal-header">
        <h4 class="modal-title">{{$title}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="table-responsive mailbox-messages" style="overflow: scroll;height: 400px;">
            <table class="table table-hover table-striped">
                <tbody>
                    @foreach($teachers as $qc)
                    <tr>
                        <td>
                            <div class="icheck-primary">
                                <input type="radio" value="{{$qc->id}}" id="qc{{$qc->id}}" name="teacher_id">
                                <label for="qc{{$qc->id}}"></label>
                            </div>
                        </td>
                        <td class="mailbox-name"><b>{{$qc->tutor_first_name.' '.$qc->tutor_last_name}}</b></td>
                        <td class="mailbox-mobile">{{$qc->tutor_contact_no}}</td>
                        <td class="mailbox-email">{{$qc->email}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <small class="text-danger" id="teacher_id_error"></small>
            <!-- /.table -->
        </div>
        <div class="form-group">
            <input type="hidden" name="order_id" value="{{$order_id}}">
            <input type="hidden" name="student_id" value="{{$student_id}}">
            <label for="inputProjectLeader">Delivery Date</label>
            <input type="date" id="inputProjectLeader" class="form-control" name="delivery_date">
            <small class="text-danger" id="delivery_date_error"></small>
        </div>

    </div>

    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Assign</button>
    </div>
</form>