@extends('layouts.app')
@section('content')
<style>
p.small {
    font-size: 16px;
    margin-left: 24px;
    color: black !important;
}

div:has(> ul.pagination) {
    float: right;
    margin-right: 20px;
}
</style>
<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form</h3>
                                <div class="float-right">
                                    <!-- <a href="{{ route('students.student.create') }}">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add
                                </a> -->
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="form-validation">
                                    <form class="form-valide" action="#" method="post" id="myform" >
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Name <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="name" placeholder="Enter a username..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >please enter your image <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                               <input type="file" class="form-control" name="uploadimage" id="uploadimage"  accept="image/*" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Rating <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="rating" placeholder=" Enter Rating">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Rating Number <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control"  name="Ratingnumber">
                                                    <option value="">Please select rating</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >offline <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control"  name="Ratingnumber">
                                                    <option value="">Please select </option>
                                                    <option value="male">offline</option>
                                                    <option value="female">offline</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Qualification<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                            
                                                <input type="text" class="form-control" name="qualification" placeholder="enter your qualification">
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        
                                       
                                       
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Total orders<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="orders" placeholder="enter your orders">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Success Rate <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="srate" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Description<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                            <textarea class="form-control" id="description"  placeholder="Enter description here"></textarea>
                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Language <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control"  name="language">
                                                    <option value="">Please select language</option>
                                                    <option value="male">Hindi</option>
                                                    <option value="female">English</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Competences <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="competences" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Subject <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control"  name="Subject">
                                                    <option value="">Please select subject</option>
                                                    <option value="male">1</option>
                                                    <option value="female">2</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Subject number <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="subjectnumber" placeholder="">
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Type of paper <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control"  name="typepaper" placeholder="type of paper">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" >Paper Number <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control"  name="paper" placeholder="enter paper">
                                            </div>
                                        </div>
                                       
                                        
                                       
                                        
                                        <br>
                                        <br>

                                        
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <input type="submit" name="save" class="btn btn-primary" value="submit">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</section>
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


@endsection