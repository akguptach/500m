
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Bank</h3>
                    </div>
                    @if(!empty($bank))
                        <div class="card-body">
                            <div class="form-group">
                                <label >Bank name</label>
                                <input type="text" class="form-control"  disabled value="{{$bank->bank_name}}">
                                
                            </div>

                            <div class="form-group">
                                <label >Account Holder Name</label>
                                <input type="text" class="form-control"  disabled value="{{$bank->account_holder_name}}">
                            </div>

                            <div class="form-group">
                                <label >IBAN Number</label>
                                <input type="text" class="form-control"  disabled value="{{$bank->ibn_number}}">
                            </div>

                            <div class="form-group">
                                <label >Sort Code</label>
                                <input type="text" class="form-control"  disabled value="{{$bank->short_code}}">
                            </div>

                            <div class="form-group">
                                <label >Account no</label>
                                <input type="text" class="form-control"  disabled value="{{$bank->account_no}}">
                            </div>

                            <div class="form-group">
                                <label >Branch</label>
                                <input type="text" class="form-control"  disabled value="{{$bank->branch}}">
                                
                            </div>

                            <div class="form-group">
                                <label >IFSC code</label>
                                <input type="text" class="form-control" disabled value="{{$bank->ifsc_code}}">
                            </div>

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
