<div class="card">
    <div class="card-body">
        <form id="basic" method="POST" action="{{route('services.store.assist_btn')}}">
            @csrf
            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
            <table class="table table-bordered" id="buttonsAddRemove">
                <tr>
                    <th>Button Text</th>
                    <th>Button URL</th>
                    <th>Action</th>
                </tr>
                @php $oldArray = []; @endphp
                @if(old('addMoreFields') && count(old('addMoreFields')) > 0)
                @php $oldArray = old('addMoreFields') @endphp
                @elseif($service && $service->assistBtns && count($service->assistBtns) >0)
                @php $oldArray = $service->assistBtns; @endphp
                @endif

                @php $i = 0; @endphp

                @if(count($oldArray)>0)
                @php $i = count($oldArray)-1; @endphp
                @foreach($oldArray as $index=>$filed)
                <tr>
                    <td>
                        <input type="text" name="addMoreFields[{{$index}}][btn_text]" placeholder="Enter Title"
                            class="form-control" value="{{@$filed['btn_text']}}" require />
                        @php $e = 'addMoreFields.'.$index.'.btn_text'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </td>
                    <td>
                    {{ HtmlHelper::ServicePageDropdown("addMoreFields[$index][btn_url]",@$filed["btn_url"],[],['id'=>['value'=>Request::route('id'),'statement'=>'!='] ,'type'=>['statement'=>'=','value'=>'SERVICE']]) }}
                        @php $e = 'addMoreFields.'.$index.'.btn_url'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </td>
                    <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td>
                        <input type="text" name="addMoreFields[0][btn_text]" placeholder="Enter Button Text"
                            class="form-control" require />
                    </td>
                    <td>
                        {{ HtmlHelper::ServicePageDropdown('addMoreFields[0][btn_url]','',[],['id'=>['value'=>Request::route('id'),'statement'=>'!='],'type'=>['statement'=>'=','value'=>'PAGE']]) }}
                    </td>
                    <td>
                    </td>
                </tr>
                @endif
            </table>
            @if(Request::route('id'))
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('services_index')}}" class="btn btn-primary">Back</a>
                @if(Request::route('id'))
                <button type="button" name="add" id="add_more_btns" class="btn btn-outline-primary float-right">Add
                    More</button>
                @endif
            </div>
            @endif

        </form>
    </div>
</div>
<script type="text/javascript">
var i = '{{$i}}';
$("#add_more_btns").click(function() {
    ++i;
    $("#buttonsAddRemove").append(`<tr>
                    <td>
                        <input type="text" name="addMoreFields[${i}][btn_text]" placeholder="Enter rating" class="form-control" require />
                    </td>
                    <td>
                    {{ HtmlHelper::ServicePageDropdown('addMoreFields[${i}][btn_url]','',[], ['id'=>['value'=>Request::route('id'),'statement'=>'!=']]) }}
                    </td>
                    <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
                </tr>`);
});
$(document).on('click', '.remove-input-field', function() {
    $(this).parents('tr').remove();
});
</script>