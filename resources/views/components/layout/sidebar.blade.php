<div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a class="ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
						<i class="nav-icon fas fa-copy"></i>
						<span class="nav-text"> Dashboard </span>
					  </a>
				    </li>
					
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
						<i class="nav-icon fas fa-indian-rupee-sign"></i>
							<span class="nav-text">Pricing Calculator</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('subject.index') }}">Subject</a></li>
                            <li><a href="{{ route('tasktype.index') }}">Task Type</a></li>
                            <li><a href="{{ route('level_study.index') }}">Level of Study</a></li>
                            <li><a href="{{ route('grade.index') }}">Grades</a></li>
							<li><a href="{{ route('referencing.index') }}">Refrencing Style</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
						<i class="nav-icon fas fa-money-check"></i>
							<span class="nav-text">Content Management</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('media.save')}}">Media</a></li>
                            <li><a href="{{ route('pages') }}">Pages</a></li>
							<li><a href="{{ route('service_keywords.service_keyword.index') }}">Services Keyword</a></li>
                            <li><a href="{{ route('services_index') }}">Services</a></li>
                            <li><a href="{{ route('faq.index') }}">FAQ</a></li>
                        </ul>
                    </li>
					<li><a class="ai-icon" href="{{ route('role.index') }}" aria-expanded="false">
						<i class="nav-icon fas fas fa-cogs"></i>
						<span class="nav-text"> Role</span>
					  </a>
				    </li>
					<li><a class="ai-icon" href="{{ route('website.index') }}" aria-expanded="false">
						<i class="nav-icon fas fas fa-coins">
						<span class="nav-text"></i> Website Manager</span>
					  </a>
				    </li>
					<li><a class="ai-icon" href="{{ route('contact.form.store') }}" aria-expanded="false">
						<i class="nav-icon fas fa-book">
						<span class="nav-text"> </i>Enquery Form List</span>
					  </a>
				    </li>
					<li><a class="ai-icon" href="{{route('subscription')}}" aria-expanded="false">
						<i class=" nav-icon fa-solid fa-bell">
						<span class="nav-text"></i>Subscription</span>
					  </a>
				    </li>
				    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
						<i class="nav-icon fas fa-user">
						<span class="nav-text"> </i>Tutor</span>
					</a>
					<ul aria-expanded="false">
						<li><a href="{{ route('tutor_view.profile_status',['profile_status'=>'approved']) }}"> Approved</a></li>
						<li><a href="{{ route('tutor_view.profile_status',['profile_status'=>'pending']) }}">Pending</a></li>
						<li><a href="{{ route('tutor_view.profile_status',['profile_status'=>'baned']) }}"> Banned</a></li>
						<li><a href="{{ route('tutor_view.profile_status',['profile_status'=>'incompelte']) }}">Incomplete</a></li>
						
					</ul>
				    </li>
					<li><a class="ai-icon" href="{{ route('orders') }}" aria-expanded="false">
						<i class="nav-icon fas fa-question"></i>
						<span class="nav-text">Order</span>
					  </a>
				    </li>
					<li><a class="ai-icon" href="{{ route('blog.index') }}" aria-expanded="false">
						<i class="nav-icon fas fa-blog">
						<span class="nav-text">  </i>Blog</span>
					  </a>
				    </li>
					<li><a class="ai-icon" href="{{ route('students.student.index') }}" aria-expanded="false">
						<i class=" nav-icon fa-solid fa-user-check">
						<span class="nav-text"></i>Student</span>
					  </a>
				    </li>
					<li><a class="ai-icon" href="{{ route('payments') }}" aria-expanded="false">
						<i class=" nav-icon fa-solid fa-credit-card">
						<span class="nav-text"></i>Payment History</span>
					  </a>
				    </li>
					<li><a class="ai-icon" href="{{route('notifications')}}" aria-expanded="false">
						<i class=" nav-icon fa-solid fa-bell">
						<span class="nav-text"> </i>Notification</span>
					  </a>
				    </li>
					<li><a class="ai-icon" href="{{ route('coupons.coupon.index') }}" aria-expanded="false">
						<i class=" nav-icon fa-solid  fa-gift">
						<span class="nav-text"></i>Coupon Code</span>
					  </a>
				    </li>

					<li><a class="ai-icon" href="{{route('experts.expert.index')}}" aria-expanded="false">
						<i class=" nav-icon fa-solid  fa-gift">
						<span class="nav-text"></i>Experts</span>
					  </a>
				    </li>
					
					
					<?php /*<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="fas fa-user-check	"></i>
							<span class="nav-text">Expert Profile</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('experts.expert.create')}}">Add Expert</a></li>
                            <li><a href="{{route('experts.expert.index')}}">View Expert</a></li>
                            
                        </ul>
                    </li>*/ ?>

					<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
						<i class=" nav-icon fa-solid fas fa-map-marked"></i>
						<span class="nav-text"> </i>Student Market Place</span>
					  </a>
					 <ul aria-expanded="false">
						<li><a href="{{route('studentmarket.student.deals_category')}}">Deals Category</a></li>
						<li><a href="{{route('studentmarket.student.view_deals')}}">Deals</a></li>
						
					 </ul>
				    </li>


					<li><a class="ai-icon" href="{{route('affiliateuser.affiliate.view')}}" aria-expanded="false">
						<i class=" nav-icon fa-solid  fa-gift">
						<span class="nav-text"></i>View Affiliate User</span>
					  </a>
				    </li>

					<?php /*<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="la la-users"></i>
							<span class="nav-text">Affiliate User</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('affiliateuser.affiliate.add')}}">Add Affiliate User</a></li>
                            <li><a href="{{route('affiliateuser.affiliate.view')}}">View Affiliate User</a></li>
                            
                        </ul>
                    </li>*/ ?>
					
					
                    
                   
                    
                    
                    
                    
                    
                    
                    
                   
                    
                    
				


				
            </div>
        </div>