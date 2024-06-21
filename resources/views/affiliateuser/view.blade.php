@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between align-items-center p-3">
                                <h4 class="m-0">View Affiliate User</h4>
                                <div class="ml-auto">
                                    <a href="{{ route('affiliateuser.affiliate.add') }}" class="btn btn-primary"
                                        title="Show All Expert">
                                        <span aria-hidden="true"></span>Add Affiliate User
                                    </a>
                                </div>

                            </div>




                            <div class="card-body p-0">
                                <div class="table-responsive">

                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th> Name </th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>About</th>
                                                <th> Location </th>
                                                <th>Type</th>
                                                <th>Refferal Link</th>


                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($affiliateUsers as $user)
                                            <tr>
                                                <td class="align-middle">{{$user->first_name}}</td>
                                                <td class="align-middle">{{$user->email}}</td>
                                                <td class="align-middle">******</td>
                                                <td class="align-middle">{{$user->about}}</td>
                                                <td class="align-middle">{{$user->location}}</td>
                                                <td class="align-middle">{{$user->type}}</td>
                                                <td class="align-middle">{{$user->referal_link}}</td>
                                                <td class="align-middle">
                                                <a href="{{route('affiliateuser.affiliate.edit',['id'=>$user->id])}}" class="edit-link">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                

                                                <form method="POST"
                                                    action="{!! route('affilate.change', $user->id) !!}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" value="PATCH" type="hidden">
                                                    <input name="status" value="active" type="hidden">
                                                    {{ csrf_field() }}
                                                    <button @if($user->status=='active') disabled="disabled" @endif type="submit" class="btn btn-link " title="Inactivate Affilate"
                                                            onclick="return confirm(&quot;Click Ok to activate Affilate.&quot;)" style="padding: 0px;padding-bottom:3px;">
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                
                                                </form>


                                                <form method="POST"
                                                    action="{!! route('affilate.change', $user->id) !!}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" value="PATCH" type="hidden">
                                                    <input name="status" value="inactive" type="hidden">
                                                    {{ csrf_field() }}
                                                    <button @if($user->status=='inactive') disabled="disabled" @endif type="submit" class="btn btn-link " title="Activate Affilate"
                                                            onclick="return confirm(&quot;Click Ok to Inactive Affilate.&quot;)" style="padding: 0px;padding-bottom:3px;">
                                                            <i class="fas fa-times-circle"></i>
                                                        </button>
                                                
                                                </form>

                                                <!--  <a href="#" class="deactive-link">
                                                      <i class="fas fa-times-circle"></i>
                                                      </a>-->
                                                      <!--<a href="#" class="delete-link">
                                                      <i class="fas fa-trash-alt"></i>
                                                      </a>                                    -->

                                                <form method="POST"
                                                    action="{!! route('affilate.destroy', $user->id) !!}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" value="DELETE" type="hidden">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-link " title="Delete Affilate"
                                                            onclick="return confirm(&quot;Click Ok to delete Affilate.&quot;)" style="padding: 0px;padding-bottom:3px;">
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
</section>


@endsection