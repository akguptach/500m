<div class="card">
    <div class="card-body">
        <form id="basic" method="POST" action="{{route('services.store.why_educrafter')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
            <table class="table table-bordered" id="why_educrafterAddRemove">
                <tr>
                    <th>Title</th>
                    <th>Icon</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                @php $oldArray = []; @endphp
                @if(old('addMoreSpecificationFields') && count(old('addMoreSpecificationFields')) > 0)
                @php $oldArray = old('addMoreSpecificationFields') @endphp
                @elseif($service && $service->whyEducrafter && count($service->whyEducrafter) >0)
                @php $oldArray = $service->whyEducrafter; @endphp
                @endif

                @php $i = 0; @endphp

                @if(count($oldArray)>0)
                @php $i = count($oldArray)-1; @endphp
                @foreach($oldArray as $index=>$filed)
                <tr>
                    <td>
                        <input type="text" name="addMoreSpecificationFields[{{$index}}][title]" placeholder="Enter Title" class="form-control" value="{{@$filed['title']}}" require />

                        @php $e = 'addMoreSpecificationFields.'.$index.'.title'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </td>
                    <td>
                        <div style="display: flex;">
                            
                            <input type="hidden" class="form-control" name="addMoreSpecificationFields[{{$index}}][icon_url]" id="ImageIcon_{{@$filed['id']}}" value="{{@$filed['icon']}}"/>
                            <button type="button" class="btn btn-primary text-center btnimageModal3" rel="{{@$filed['id']}}">
                                Select icon
                            </button>
                            <div class="col-sm-6" >
                                <img src="{{@$filed['icon']}}" alt="Image Description" class="viewImage_{{@$filed['id']}}" style="width: 40px; border-radius: 21px;">
                            </div>
                        </div>
                        @php $e = 'addMoreSpecificationFields.'.$index.'.icon'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </td>
                    <td>
                        <textarea name="addMoreSpecificationFields[{{$index}}][description]" placeholder="Enter Description" class="form-control" require>{{@$filed['description']}}</textarea>
                        @php $e = 'addMoreSpecificationFields.'.$index.'.description'; @endphp
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
                        <input type="text" name="addMoreSpecificationFields[0][title]" placeholder="Enter Title" class="form-control" require />
                    </td>
                    <td>
                        <input type="file" name="addMoreSpecificationFields[0][icon]" class="form-control" require />
                    </td>
                    <td>
                        <textarea name="addMoreSpecificationFields[0][description]" placeholder="Enter Description" class="form-control" require></textarea>
                    </td>
                    <td>
                    </td>
                </tr>
                @endif

            </table>
            @if(Request::route('id'))
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save and Next</button>
                <a href="{{route('services_index')}}" class="btn btn-primary">Back</a>
                @if(Request::route('id'))
                <button type="button" name="add" id="add_more_why_educrafter" class="btn btn-outline-primary float-right">Add More</button>
                @endif
            </div>
            @endif

        </form>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="IconModal1" tabindex="-1" role="dialog" aria-labelledby="IconModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Image Icon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="imageForm" name="imageForm" method="POST" action="">
                    <div class="row">
                        @foreach($ImageIcon as $icon)
                        <div class="col-sm-2">
                            <img src="{{ $icon->image }}" alt="Image Description" class="clickableImage" style="width: 60px;border: 1px solid #000;padding: 2px;">
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" id="clickbtn" name="clickbtn" value="">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var i = '{{$i}}';
    $("#add_more_why_educrafter").click(function() {
        ++i;
        $("#why_educrafterAddRemove").append(`<tr>
                    <td>
                        <input type="text" name="addMoreSpecificationFields[${i}][title]" placeholder="Enter Title" class="form-control" />
                    </td>
                    <td>
                        <input type="file" name="addMoreSpecificationFields[${i}][icon]" class="form-control" />
                    </td>
                    <td>
                        <textarea name="addMoreSpecificationFields[${i}][description]" placeholder="Enter Description" class="form-control"></textarea>
                    </td>
                    <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
                </tr>`);
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
    $(document).on('click', '.btnimageModal3', function() {
        $('#clickbtn').val($(this).attr('rel'));
        $('#IconModal1').modal('show');
    });
    $(document).ready(function() {
        $('.clickableImage').click(function() {
            var imagePath = $(this).attr('src');
            var aa = $('#clickbtn').val();
            $('#ImageIcon_' + aa).val(imagePath);
            $('.viewImage_' + aa).attr('src', imagePath);
            // Close the modal
            $('#IconModal1').modal('hide');
        });
    });
</script>