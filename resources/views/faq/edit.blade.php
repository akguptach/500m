@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit <small>FAQ</small></h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{$formAction}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                  
                                    <label >Website</label>
                                    <select name="website_id" class="form-control">
                                        <option value="">Select website</option>
                                        @if(!empty($websites))
                                          @foreach($websites as $website1)
                                            <option value="{{$website1->id}}"  @if($data->website_id == $website1->id) selected @endif>{{$website1->website_type }}</option>
                                          @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Question</label>
                                    <input type="text" name="question" class="form-control" placeholder="Enter Question" value="{{$data->question}}">
                                </div>
                                <div class="form-group">
                                    <label>Answer</label>
                                    <input type="text" name="answer" class="form-control" placeholder="Enter Answer" value="{{$data->answer}}">
                                </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('faq.index')}}" class="btn btn-primary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    $(function () {
  $('#quickForm').validate({
    rules: {
      website_id: {
        required: true,
      },
      question: {
        required: true,
        minlength:2
      },
      answer: {
        required: true,
        minlength:2
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection