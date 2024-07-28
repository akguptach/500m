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

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Service Keyword</h3>
                    <a href="{{route('service_keywords.service_keyword.create')}}" class="btn btn-primary">+ Add new</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" id="success_message">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="example1" class="table table-responsive table-bordered row-border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Website Type</th>
                                    <th>Status</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($serviceKeywords as $serviceKeyword)
                                <tr>
                                    <td class="align-middle">{{ $serviceKeyword->name }}</td>
                                    <td class="align-middle">{{ $serviceKeyword->website_type }}</td>
                                    <td class="align-middle">
                                        
                                    @if($serviceKeyword->status == '1')
                                    Active
                                    @else
                                    Inactive
                                    @endif 
                                </td>
                                    <td>

                                        <a href="{{route('service_keywords.service_keyword.edit',$serviceKeyword->id)}}"
                                            class="edit-link">
                                            <i class="fas fa-edit"></i>
                                        </a>



                                        <form method="POST"
                                            action="{!! route('service_keywords.service_keyword.change', $serviceKeyword->id) !!}"
                                            accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" value="PATCH" type="hidden">
                                            <input name="status" value="1" type="hidden">
                                            {{ csrf_field() }}
                                            <button @if($serviceKeyword->status=='1') disabled="disabled" @endif
                                                type="submit"
                                                class="btn btn-link " title="Inactivate Service Keyword"
                                                onclick="return confirmAction('Click Ok to activate');"
                                                style="padding: 0px;padding-bottom:3px;">
                                                <i class="fas fa-times-circle"></i>
                                            </button>

                                        </form>


                                        <form method="POST"
                                            action="{!! route('service_keywords.service_keyword.change', $serviceKeyword->id) !!}"
                                            accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" value="PATCH" type="hidden">
                                            <input name="status" value="0" type="hidden">
                                            {{ csrf_field() }}
                                            <button @if($serviceKeyword->status=='0') disabled="disabled" @endif
                                                type="submit" class="btn btn-link " title="Activate Service Keyword"
                                                onclick="return confirmAction('Click Ok to Inactivate');"
                                                style="padding: 0px;padding-bottom:3px;">
                                                
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>

                                        <form method="POST"
                                            action="{!! route('service_keywords.service_keyword.destroy', $serviceKeyword->id) !!}"
                                            accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-link " title="Delete Keyword"
                                                onclick="return confirmAction('Click Ok to delete');"
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
                <div class="clearfix mt-2 pagination-div">
                    <div style="width: 100%;">
                        {!! $serviceKeywords->appends(request()->input())->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script>
function confirmAction(message){
    var result= confirm(message);
    return result;
}
</script>
@endsection