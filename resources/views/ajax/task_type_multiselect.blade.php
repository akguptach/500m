@php($competencesArray = [])

<select class="form-control" name="competences[]" id="competences" multiple="multiple">
    @foreach($dataList as $list)

    @if(str_contains($competences, $list->id))
    @php($competencesArray[] =  $list->type_name)
    @endif

    @php($competencesString = implode(',', $competencesArray))
    <option value="{{$list->id}}" @if(str_contains($competences, $list->id)) selected="selected" @endif>{{$list->type_name}}</option>
    @endforeach
</select>
<script>
$('#competences').multiSelect();
$('.competences .multi-select-button').html("{{@$competencesString}}")
</script>
<link href="{{ asset('css/multi-select.css') }}" rel="stylesheet" />
<script src="{{asset('js/jquery.multi-select.min.js')}}"></script>