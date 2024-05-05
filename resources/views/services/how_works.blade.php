<div class="card">
    <div class="card-body">
        <form id="basic" method="POST" action="{{route('services.store.how_works')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
            <table class="table table-bordered" id="howworksAddRemove">
                <tr>
                    <th>Title</th>
                    <th>Icon</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                @php $oldArray = []; @endphp
                @if(old('addMoreFields') && count(old('addMoreFields')) > 0)
                @php $oldArray = old('addMoreFields') @endphp
                @elseif($service && $service->howWorks && count($service->howWorks) >0)
                @php $oldArray = $service->howWorks; @endphp
                @endif

                @php $i = 0; @endphp

                @if(count($oldArray)>0)
                @php $i = count($oldArray)-1; @endphp
                @foreach($oldArray as $index=>$filed)
                <tr>
                    <td>
                        <input type="text" name="addMoreFields[{{$index}}][title]" placeholder="Enter Title" class="form-control" value="{{@$filed['title']}}" require />

                        @php $e = 'addMoreFields.'.$index.'.title'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </td>
                    <td>
                        <div style="display: flex;">
                            <input type="hidden" class="form-control" name="addMoreFields[{{$index}}][icon_url]" id="WorkImageIcon_{{@$filed['id']}}" value="{{@$filed['icon']}}"/>
                            <button type="button" class="btn btn-primary text-center btnimageModal2" rel="{{@$filed['id']}}">
                                Select icon
                            </button>
                            <div class="col-sm-1">
                                <img src="{{@$filed['icon']}}" alt="Image Description" class="WorkViewImage_{{@$filed['id']}}" style="width: 40px; border-radius: 21px;">
                            </div>
                        </div>
                        @php $e = 'addMoreFields.'.$index.'.icon'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </td>
                    <td>
                        <textarea name="addMoreFields[{{$index}}][description]" placeholder="Enter Description" class="form-control" require>{{@$filed['description']}}</textarea>
                        @php $e = 'addMoreFields.'.$index.'.description'; @endphp
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
                        <input type="text" name="addMoreFields[0][title]" placeholder="Enter Title" class="form-control" require />
                    </td>
                    <td>
                        <input type="file" name="addMoreFields[0][icon]" class="form-control" require />
                    </td>
                    <td>
                        <textarea name="addMoreFields[0][description]" placeholder="Enter Description" class="form-control" require></textarea>
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
                <button type="button" name="add" id="add_more_how_works" class="btn btn-outline-primary float-right">Add
                    More</button>
                @endif
            </div>
            @endif

        </form>
    </div>
</div>
<div class="modal fade" id="IconModalWork" tabindex="-1" role="dialog" aria-labelledby="IconModalLabel" aria-hidden="true">
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
    $("#add_more_how_works").click(function() {
        ++i;
        $("#howworksAddRemove").append(`<tr>
                    <td>
                        <input type="text" name="addMoreFields[${i}][title]" placeholder="Enter Title" class="form-control" />
                    </td>
                    <td>
                        <input type="file" name="addMoreFields[${i}][icon]" class="form-control" />
                    </td>
                    <td>
                        <textarea name="addMoreFields[${i}][description]" placeholder="Enter Description" class="form-control"></textarea>
                    </td>
                    <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
                </tr>`);
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
    $(document).on('click', '.btnimageModal2', function() {
        $('#clickbtn').val($(this).attr('rel'));
        $('#IconModalWork').modal('show');
    });
    $(document).ready(function() {
        $('.clickableImage').click(function() {
            var imagePath = $(this).attr('src');
            var aa = $('#clickbtn').val();
            $('#WorkImageIcon_' + aa).val(imagePath);
            $('.WorkViewImage_' + aa).attr('src', imagePath);
            // Close the modal
            $('#IconModalWork').modal('hide');
        });
    });
</script>