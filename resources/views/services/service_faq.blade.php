<style>
.child-table td {
    border: none;
}
</style>
<div class="card">
    <div class="card-body">
        <form id="basic" method="POST" action="{{route('services.store.faq')}}">
            @csrf

            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Question / Answer</th>
                    <th>Action</th>
                </tr>
                @if($service && $service->faq && count($service->faq) >0)
                @foreach($service->faq as $index=>$fileds)
                <tr>
                    <td>
                        <table class="table child-table">
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields[{{$index}}][question]"
                                        placeholder="Enter Question" class="form-control"
                                        value="{{$fileds->question}}" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="addMoreInputFields[{{$index}}][answer]" placeholder="Enter Answer"
                                        class="form-control editor">{{$fileds->answer}}</textarea>

                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                    </td>
                </tr>
                @endforeach

                @else
                <tr>
                    <td>
                        <table class="table child-table">
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields[0][question]"
                                        placeholder="Enter Question" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="addMoreInputFields[0][answer]" placeholder="Enter Answer"
                                        class="form-control editor"></textarea>
                                </td>
                            </tr>
                        </table>
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
                <button type="submit" class="btn btn-primary">Save and Next</button>
                <a href="{{route('services_index')}}" class="btn btn-primary">Back</a>
                @if(Request::route('id'))
                <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary float-right">Add
                    More</button>
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
    $("#dynamicAddRemove").append(`<tr>
                    <td>
                        <table class="table child-table">
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields['${i}'][question]" placeholder="Enter Question" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="addMoreInputFields['${i}'][answer]" placeholder="Enter Answer" class="form-control editor"></textarea>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
                </tr>`);
    $('.editor').summernote({
        toolbar: [

            ['style', ['style']],

            ['font', ['bold', 'underline', 'clear']],

            ['fontname', ['fontname']],

            ['color', ['color']],

            ['para', ['ul', 'ol', 'paragraph']],

            ['table', ['table']],

            ['insert', ['link', 'picture', 'video']],

            ['view', ['fullscreen', 'codeview', 'help']],
        ],
    });
});
$(document).on('click', '.remove-input-field', function() {
    $(this).parents('tr').remove();
});
</script>