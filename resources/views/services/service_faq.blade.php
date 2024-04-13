<div class="card">
    <div class="card-body">
        <form id="basic" method="POST" action="{{route('services.store.faq')}}">
            @csrf

            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Action</th>
                </tr>
                @if($service && $service->faq && count($service->faq) >0)
                @foreach($service->faq as $index=>$fileds)
                <tr>
                    <td>
                        <input type="text" name="addMoreInputFields[{{$index}}][question]" placeholder="Enter Question" class="form-control" value="{{$fileds->question}}" />
                    </td>
                    <td>
                        <input type="text" name="addMoreInputFields[{{$index}}][answer]" placeholder="Enter Answer" class="form-control" value="{{$fileds->answer}}" />
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                    </td>
                </tr>
                @endforeach

                @else
                <tr>
                    <td>
                        <input type="text" name="addMoreInputFields[0][question]" placeholder="Enter Question" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="addMoreInputFields[0][answer]" placeholder="Enter Answer" class="form-control" />
                    </td>
                    <td>

                    </td>
                </tr>
                @endif
            </table>
            @error('question')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            @if(Request::route('id'))
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('pages')}}" class="btn btn-primary">Back</a>
                @if(Request::route('id'))
                <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary float-right">Add More</button>
                @endif
            </div>
            @endif

        </form>
    </div>
</div>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function() {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][question]" placeholder="Enter question" class="form-control" /></td><td><input type="text" name="addMoreInputFields[' + i +
            '][answer]" placeholder="Enter answer" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>