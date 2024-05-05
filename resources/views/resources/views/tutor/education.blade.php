<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Education</h3>
                    </div>
                    @if(!empty($education))
                        <div class="card-body">
                            <div class="form-group">
                                <label >Highest education</label>
                                <input type="text" class="form-control"  disabled value="{{$education->highest_education}}">
                                
                            </div>
                            <div class="form-group">
                                <label >University</label>
                                <input type="text" class="form-control"  disabled value="{{$education->university}}">
                                
                            </div>
                            <div class="form-group">
                                <label >Year</label>
                                <input type="text" class="form-control" disabled value="{{$education->year}}">
                                
                            </div>
                            <div class="form-group">
                                <label style="width:50%;float:left;">Proof</label>
                                @if(!empty($education->proof))
                                    <a href="<?= env('TUTOT_URL').$education->proof;?>" target="_blank" class="form-control" style="    border: 0px !important;width: 50% !important;float: left;">View</a>
                                @endif
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