@extends('layouts.app')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Create New Expert</h4>
            <div class="ml-auto">
                <a href="{{ route('experts.expert.index') }}" class="btn btn-primary" title="Show All Expert">
                    <span aria-hidden="true"></span>Back to View Expert
                </a>
            </div>
         </div>
        

        <div class="card-body">
        

                            <form method="get" class="needs-validation" novalidate action="{{ route('experts.expert.addreview') }}" accept-charset="UTF-8" id="" name="" >
                            {{ csrf_field() }}
                            @include ('experts.form1', [
                                                        'expert' => null,
                                                    ])

                                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                                    <input class="btn btn-primary" type="submit" value="Add">
                                </div>

                            </form>

        </div>
    </div>

    <br><br>

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Preview list</h4>
           
         </div>
        
        
       <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Review Title </th>
                            <th>Review Description</th>
                            <th>Customer ID</th>
                            <th>Date</th>
                            <th>Review Code</th>
                            <th>Status</th>
                        
                            <th>Action</th>
                            
                           

                            <th></th>
                        </tr>
                     </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle">Essay Assignmet</td>
                                            <td class="align-middle">Hereby to inform the </td>
                                            <td class="align-middle">0157CS181128</td>
                                            <td class="align-middle">03-04-2023</td>
                                            <td class="align-middle">Xtr112e</td>
                                            <td class="align-middle">Active</td>
                                            
                                            <td class="align-middle">
                            
                                                    <a href="#" class="edit-link">
                                                    <i class="fas fa-edit"></i>
                                                      </a>
                                                      <a>
                                                      <i class="fas fa-times-circle"></i>
                                                      </a>
                                                      
                                                     <a href="#" class="deactive-link">
                                                      <i class="fas fa-check-circle"></i>
                                                      </a>
                                                      <a href="#" class="delete-link">
                                                      <i class="fas fa-trash-alt"></i>
                                                      </a> 
                                                     
                                                     
                            </td>
                                        
                                        </tr> 
                                    </tbody>
                </table>

            </div>
         
        </div>
            
       
    
    </div>
    <br><br>

@endsection


