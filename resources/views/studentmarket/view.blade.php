@extends('layouts.app')
@section('content')

<div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">View Deals</h4>
            <div class="ml-auto">
       <a href="{{ route('studentmarket.student.add_deals') }}" class="btn btn-primary" title="Show All Expert">
           <span aria-hidden="true"></span>Add Deal
       </a>
   </div>
           
         </div>
        
        
       <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th> Title  </th>
                            <th>Image</th>
                            <th>short description</th>
                            <th>Long Description</th>
                            <th> URL  </th>
                            <th>Price</th>
                            <th>Offer Price</th>
                            
                        
                            <th>Action</th>
                            
                           

                            <th></th>
                        </tr>
                     </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle">Rapido</td>
                                            <td class="align-middle">Alto.jpg</td>
                                            <td class="align-middle">Here Short content</td>
                                            <td class="align-middle">Here Long Content...</td>
                                            <td class="align-middle">Http://AjjjThgvhgj12kkk./ajio.com</td>
                                            <td class="align-middle">500/- INR</td>
                                            <td class="align-middle">200/- INR</td>
                                           
                                            
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