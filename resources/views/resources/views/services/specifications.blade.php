<div class="card">
    <div class="card-body">
        <form id="basic" method="POST" action="{{route('services.store.specification')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="service_id" value="{{Request::route('id') }}">
            <table class="table table-bordered" id="specificationAddRemove">
                <tr>
                    <th>Title/Description</th>
                    <th>Action</th>
                   
                </tr>
                @php $oldArray = []; @endphp
                @if(old('addMoreSpecificationFields') && count(old('addMoreSpecificationFields')) > 0)
                @php $oldArray = old('addMoreSpecificationFields') @endphp
                @elseif($service && $service->specification && count($service->specification) >0)
                @php $oldArray = $service->specification; @endphp
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
						
						<br>
						<div style="display: flex;">
                            <input type="file" name="addMoreSpecificationFields[{{$index}}][icon]" class="form-control" require />
                            <img src="@if(isset($filed['icon_url'])){{$filed['icon_url']}}@else{{@$filed['icon']}}@endif" width="30px" />
                            <input type="hidden" name="addMoreSpecificationFields[{{$index}}][icon_url]" value="@if(isset($filed['icon_url'])){{$filed['icon_url']}}@else{{@$filed['icon']}}@endif" />
                        </div>
                        @php $e = 'addMoreSpecificationFields.'.$index.'.icon'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
						<br>
						<textarea name="addMoreSpecificationFields[{{$index}}][description]" placeholder="Enter Description" class="form-control editor" require>{{@$filed['description']}}</textarea>
                        @php $e = 'addMoreSpecificationFields.'.$index.'.description'; @endphp
                        @error($e)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
						</br>
						
                    </td>
                   
                    <td>
                         <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                    </td>

                   
                </tr>
                @endforeach
                @else
                <tr>
                    <td>
                        <input type="text" name="addMoreSpecificationFields[0][title]" placeholder="Enter Title" class="form-control" require />
						<br>
						<input type="file" name="addMoreSpecificationFields[0][icon]" class="form-control" require />
						
						<br>
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
                <button type="button" name="add" id="add_more_specification" class="btn btn-outline-primary float-right">Add More</button>
                @endif
            </div>
            @endif

        </form>
    </div>
</div>
<script type="text/javascript">
    var i = '{{$i}}';
    $("#add_more_specification").click(function() {
        ++i;
        $("#specificationAddRemove").append(`<tr>
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