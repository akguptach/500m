@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (session('status'))
                        <div class="alert alert-success mb-3 mt-3" id="success_message">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center p-3">
                                <h4 class="m-0">Staff Users</h4>
                                <div class="ml-auto">
                                    <a href="{{ route('staffuser.add') }}" class="btn btn-primary"
                                        title="Show All Expert">
                                        <span aria-hidden="true"></span>Add Staff User
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-bordered">
                                    <table class="table table-responsive table-bordered row-border">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($staffusers as $user)
                                            <tr>
                                                <td class="align-middle">{{$user->name}}</td>
                                                <td class="align-middle">{{$user->email}}</td>
                                                <td class="align-middle">{{$user?->role?->role_name}}</td>
                                                <td class="align-middle">{{$user->status}}</td>
                                                <td class="align-middle">
                                                    <a href="#" class="btn btn-xs sharp  btn-permission"
                                                        data-id="{{$user->id}}">
                                                        <div><i class="fa fa-key"
                                                                style="color: #6a73fa;font-size: 14px;"></i></div>
                                                    </a>

                                                    <a href="{{route('staffuser.edit',['id'=>$user->id])}}"
                                                        class="edit-link">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form method="POST"
                                                        action="{!! route('staffuser.change', $user->id) !!}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        <input name="_method" value="PATCH" type="hidden">
                                                        <input name="status" value="active" type="hidden">
                                                        {{ csrf_field() }}
                                                        <button @if($user->status=='active') disabled="disabled" @endif
                                                            class="btn btn-link " title="Inactivate User"
                                                            onclick="return new_modal(event,&quot;Click Ok to activate
                                                            User.&quot;)" style="padding: 0px;padding-bottom:3px;">
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                    </form>

                                                    <form method="POST"
                                                        action="{!! route('staffuser.change', $user->id) !!}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        <input name="_method" value="PATCH" type="hidden">
                                                        <input name="status" value="inactive" type="hidden">
                                                        {{ csrf_field() }}
                                                        <button @if($user->status=='inactive') disabled="disabled"
                                                            @endif class="btn btn-link " title="Activate User"
                                                            onclick="return new_modal(event,&quot;Click Ok to Inactive
                                                            Affilate.&quot;)" style="padding: 0px;padding-bottom:3px;">
                                                            <i class="fas fa-times-circle"></i>
                                                        </button>
                                                    </form>

                                                    <form method="POST"
                                                        action="{!! route('staffuser.destroy', $user->id) !!}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        <input name="_method" value="DELETE" type="hidden">
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-link " title="Delete User"
                                                            onclick="return new_modal(event,&quot;Click Ok to delete User.&quot;)"
                                                            style="padding: 0px;padding-bottom:3px;">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <div class="modal fade" id="manage-permissions">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Manage permissions</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body" id="permission-page">

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
    $('.close').click(function() {
        $("#manage-permissions").modal('hide');
    })

    $(".btn-permission").click(function() {
        let user_id = $(this).attr("data-id");
        $.ajax({
            url: "{{route('permission.userPermission')}}/" + user_id,
            type: 'get',
            success: function(data) {
                $("#ajax-loading").hide();
                $('#permission-page').html(data);
            },
            error: function(data) {}
        });
        $("#manage-permissions").modal('show');
    });
});

async function new_modal(event, msg) {
    event.preventDefault(); // Prevent form submission

    if (await confirm(msg)) {
        event.target.closest('form').submit(); // Submit the form if confirmed
    }
}

// Function to show Bootstrap modal as confirmation
function showBootstrapConfirm(msg, callback) {
    // Create modal markup
    var modalMarkup = `
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button type="button" class="close btn border" style="padding: 1% 2%;" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p>${msg}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Yes</button>
                </div>
                </div>
            </div>
        </div>
        `;
    var modalElement = $(modalMarkup).appendTo('body');
    $(modalElement).modal('show');
    $(modalElement).find('.btn-primary').click(function() {
        callback(true); // Call callback with true indicating confirmation
        $(modalElement).modal('hide'); // Hide modal
    });
    $(modalElement).find('.btn-secondary').click(function() {
        callback(false); // Call callback with false indicating cancellation
        $(modalElement).modal('hide'); // Hide modal
    });
    $(modalElement).on('hidden.bs.modal', function() {
        $(this).remove(); // Remove modal from DOM when closed
    });
}

window.confirm = function(msg) {
    return new Promise(function(resolve) {
        showBootstrapConfirm(msg, function(result) {
            resolve(result);
        });
    });
};
</script>

@endsection