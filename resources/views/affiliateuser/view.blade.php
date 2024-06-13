@extends('layouts.app')
@section('content')

<div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">View Affiliate User</h4>
            <div class="ml-auto">
       <a href="{{ route('affiliateuser.affiliate.add') }}" class="btn btn-primary" title="Show All Expert">
           <span aria-hidden="true"></span>Add Affiliate User
       </a>
   </div>
           
         </div>
        
        
       <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th> Name  </th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>About</th>
                            <th> Location </th>
                            <th>Type</th>
                            <th>Refferal Link</th>
                            
                        
                            <th>Action</th>
                            
                           

                            <th></th>
                        </tr>
                     </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle">Rajesh</td>
                                            <td class="align-middle">Alpha@gmail.com</td>
                                            <td class="align-middle">******</td>
                                            <td class="align-middle">Here Long Content...</td>
                                            <td class="align-middle">Gurugram</td>
                                            <td class="align-middle">Regional</td>
                                            <td class="align-middle">http://jhhgh.com</td>
                                           
                                            
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

@endsection
