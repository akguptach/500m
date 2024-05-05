<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Address</h3>
                    </div>
                    @if(!empty($address))
                        <div class="card-body">
                            <div class="form-group">
                                <label >Country</label>
                                <input type="text" class="form-control"  disabled value="{{$address->country}}">
                                
                            </div>
                            <div class="form-group">
                                <label >State</label>
                                <input type="text" class="form-control"  disabled value="{{$address->state}}">
                                
                            </div>
                            <div class="form-group">
                                <label >City</label>
                                <input type="text" class="form-control" disabled value="{{$address->city}}">
                                
                            </div>
                            <div class="form-group">
                                <label >Zipcode</label>
                                <input type="text" class="form-control" disabled  value="{{$address->zip_code}}">
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="alert alert-error">
                                No record found
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</section>