@extends('layouts.app')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Deal Category</h4>
           
         </div>
        

        <div class="card-body">
        

                            <form method="get" class="needs-validation" novalidate action="" accept-charset="UTF-8" id="" name="" >
                            {{ csrf_field() }}
                            @include ('studentmarket.form', [
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
            <h4 class="m-0">Deal Category list</h4>
           
         </div>
        
        
       <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th> Deal Category Name </th>
                            <th> Status</th>
                           
                            
                        
                            <th>Action</th>
                            
                           

                            <th></th>
                        </tr>
                     </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle">Deal 1</td>
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


