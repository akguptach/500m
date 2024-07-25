<div class="card">
    <div class="card-body">
        <form id="basic" method="POST" action="{{route('pages.store.ratings')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="page_id" value="{{Request::route('pages') }}">
            <table class="table table-bordered table-responsive table-bordered " id="ratingsAddRemove">
                <tr>
                    <th>Stars</th>
                    <th>Image</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                @php $oldArray = []; @endphp
                @if(old('addMoreRatingFields') && count(old('addMoreRatingFields')) > 0)
                @php $oldArray = old('addMoreRatingFields') @endphp
                @elseif($data && $data->ratings && count($data->ratings) >0)
                @php $oldArray = $data->ratings; @endphp
                @endif

                @php $i = 0; @endphp

                @if(count($oldArray)>0)
                @php $i = count($oldArray)-1; @endphp
                @foreach($oldArray as $index=>$filed)
                <tr>
                    <td>
                        <input type="text" name="addMoreRatingFields[{{$index}}][star_rating]" placeholder="Enter Title" class="form-control" value="{{@$filed['star_rating']}}" require />
                        @php $e = 'addMoreRatingFields.'.$index.'.star_rating'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </td>
                    <td>
                        <div style="display: flex;">
                            <input type="file" name="addMoreRatingFields[{{$index}}][user_image]" class="form-control" require />
                            <img src="@if(isset($filed['user_image_url'])){{$filed['user_image_url']}}@else{{@$filed['user_image']}}@endif" width="30px" />
                            <input type="hidden" name="addMoreRatingFields[{{$index}}][user_image_url]" value="@if(isset($filed['user_image_url'])){{$filed['user_image_url']}}@else{{@$filed['user_image']}}@endif" />
                        </div>
                        @php $e = 'addMoreRatingFields.'.$index.'.user_image'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="addMoreRatingFields[{{$index}}][address]" placeholder="Enter address" class="form-control" value="{{@$filed['address']}}" require />
                        @php $e = 'addMoreRatingFields.'.$index.'.address'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </td>
                    <td>
                        <textarea name="addMoreRatingFields[{{$index}}][description]" placeholder="Enter Description" class="form-control" require>{{@$filed['description']}}</textarea>
                        @php $e = 'addMoreRatingFields.'.$index.'.description'; @endphp
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
                        <input type="text" name="addMoreRatingFields[0][star_rating]" placeholder="Enter rating" class="form-control" require />
                    </td>
                    <td>
                        <input type="file" name="addMoreRatingFields[0][user_image]" class="form-control" require />
                    </td>
                    <td>
                        <input type="text" name="addMoreRatingFields[0][address]" class="form-control" require />
                    </td>
                    <td>
                        <textarea name="addMoreRatingFields[0][description]" placeholder="Enter address" class="form-control" require></textarea>
                    </td>

                    <td>
                    </td>
                </tr>
                @endif

            </table>


            @if(Request::route('pages'))
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('services_index')}}" class="btn btn-primary">Back</a>
                @if(Request::route('pages'))
                <button type="button" name="add" id="add_more_rating" class="btn btn-outline-primary float-right">Add More</button>
                @endif
            </div>
            @endif

        </form>
    </div>
</div>
<script type="text/javascript">
    var i = '{{$i}}';
	
    $("#add_more_rating").click(function() {
        ++i;
        $("#ratingsAddRemove").append(`<tr>
                    <td>
                        <input type="text" name="addMoreRatingFields[${i}][star_rating]" placeholder="Enter rating" class="form-control" require />
                    </td>
                    <td>
                        <input type="file" name="addMoreRatingFields[${i}][user_image]" class="form-control" require />
                    </td>
                    <td>
                        <input type="text" name="addMoreRatingFields[${i}][address]" class="form-control" require />
                    </td>
                    <td>
                        <textarea name="addMoreRatingFields[${i}][description]" placeholder="Enter description" class="form-control" require></textarea>
                    </td>

                    <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
                </tr>`);
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>