<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">KYC</h3>
                    </div>
                        @if(!empty($kyc))
                            <div class="card-body">
                                <div class="form-group">
                                    <label style="width:50%;float:left;">ID Proof</label>
                                    @if(!empty($kyc->id_proof))
                                        <a href="<?= env('TUTOT_URL').$kyc->id_proof;?>" target="_blank" class="form-control" style="    border: 0px !important;width: 50% !important;float: left;">View</a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label style="width:50%;float:left;">Address Proof</label>
                                    @if(!empty($kyc->address_proof))
                                        <a href="<?= env('TUTOT_URL').$kyc->address_proof;?>" target="_blank" class="form-control" style="    border: 0px !important;width: 50% !important;float: left;">View</a>
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
    </div>
</section>