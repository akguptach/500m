<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
       
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
               
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ ( request()->is('dashboard') ) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
				
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
						Pricing Calculator
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
						<li class="nav-item">
							
							<a href="{{ route('subject.index') }}"
                        class="nav-link {{ (request()->is('subject') || request()->is('subject/create') || request()->is('subject/*/edit') )? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Subject
                        </p>
                    </a>
               
						</li>
						<li class="nav-item">
							<a href="{{ route('tasktype.index') }}"
								class="nav-link {{ ( request()->is('tasktype') || request()->is('tasktype/create') || request()->is('tasktype/*/edit')  ) ? 'active' : '' }}">
								<i class="nav-icon fas fa-columns"></i>
								<p>
									Task Type
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('level_study.index') }}"
							class="nav-link {{ (request()->is('level_study') || request()->is('level_study/create') || request()->is('level_study/*/edit') ) ? 'active' : '' }}">
							<i class="nav-icon fas fa-circle"></i>
							<p>Level of Study {{ request()->is('/level_study') ? 'active' : '' }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('grade.index') }}"
							class="nav-link {{ (request()->is('grade') || request()->is('grade/create') || request()->is('grade/*/edit') ) ? 'active' : '' }}">
							<i class="nav-icon fas fa-file"></i>
							<p>
								Grades {{ request()->is('/grade') ? 'active' : '' }}
							</p>
							</a>
						</li>
						<li class="nav-item">
						      <a href="{{ route('referencing.index') }}"
							class="nav-link {{ (request()->is('referencing') || request()->is('referencing/create') || request()->is('referencing/*/edit') ) ? 'active' : '' }}">
							<i class="nav-icon fas fa-bolt"></i>
							<p>Referencing Style {{ request()->is('/referencing') ? 'active' : '' }}</p>
							</a>
						</li>
                    </a>
					</ul>
				</li>
				
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
						Content Management
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
					     <li class="nav-item">
							<a href="{{route('media.save')}}"
								class="nav-link ">
								<i class="nav-icon fa-solid fa-image"></i>
								<p>
									Media
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('pages') }}"
								class="nav-link {{ (request()->is('pages')  || request()->is('pages/*/edit') ) ? 'active' : '' }}">
								<i class="nav-icon fas fa-book"></i>
								<p>
									Pages {{ request()->is('/grade') ? 'active' : '' }}
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('services_index') }}"
								class="nav-link {{ (request()->is('services_index')  || request()->is('services_index/*/edit') ) ? 'active' : '' }}">
								<i class="nav-icon fas fa-pen-nib"></i>
								<p>
									Services {{ request()->is('/services_index') ? 'active' : '' }}
								</p>
							</a>
						</li>
						<li class="nav-item">
								<a href="{{ route('faq.index') }}"
									class="nav-link {{ (request()->is('faq') || request()->is('faq/create') || request()->is('faq/*/edit') ) ? 'active' : '' }}">
									<i class="nav-icon fas fa-question"></i>
									<p>
										FAQ {{ request()->is('/faq') ? 'active' : '' }}
									</p>
								</a>
						</li>
					</ul>
				</li>

                <li class="nav-item">
                    <a href="{{ route('role.index') }}"
                        class="nav-link {{ ( request()->is('role')  || request()->is('role/create') || request()->is('role/*/edit') ) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Role
                        </p>
                    </a>
                </li>
                
                <!--<li class="nav-item">
                <a href="{{ route('studylabel.index') }}" class="nav-link {{ (request()->is('studylabel') || request()->is('studylabel/create') || request()->is('studylabel/*/edit')  ) ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
                    <p>
                        Study Label
                    </p>
                </a>
            </li>-->
                <li class="nav-item">
                    <a href="{{ route('website.index') }}"
                        class="nav-link {{ (request()->is('website') || request()->is('website/create') || request()->is('website/*/edit') ) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Website Manager
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact.form.store') }}"
                        class="nav-link {{ (request()->is('referencing') || request()->is('referencing/create') || request()->is('referencing/*/edit') ) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                        Enquery Form List {{ request()->is('/referencing') ? 'active' : '' }}
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{route('subscription')}}"
                        class="nav-link ">
                        <i class=" nav-icon fa-solid fa-bell"></i>
                        <p>
                        Subscription
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item   {{ (request()->is('tutor') || request()->is('tutor_view/*') ) ? 'menu-is-opening menu-open':''}}">
                    <a href="{{ route('tutor.index') }}"
                        class="nav-link {{ (request()->is('tutor') || request()->is('tutor/*') ) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Tutor {{ request()->is('/tutor') ? 'active' : '' }}
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tutor_view.profile_status',['profile_status'=>'approved']) }}"
                                class="nav-link {{request()->is('tutor_view/approved') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Approved</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tutor_view.profile_status',['profile_status'=>'pending']) }}"
                                class="nav-link {{request()->is('tutor_view/pending') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tutor_view.profile_status',['profile_status'=>'baned']) }}"
                                class="nav-link {{request()->is('tutor_view/baned') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Baned</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tutor_view.profile_status',['profile_status'=>'incompelte']) }}"
                                class="nav-link {{request()->is('tutor_view/incompelte') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Incompelte</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('orders') }}"
                        class="nav-link {{ (request()->is('orders') || request()->is('orders/create') || request()->is('orders/*/edit') ) ? 'active' : '' }}"><i
                            class="nav-icon fas fa-question"></i>
                        <p>Orders {{ request()->is('/orders') ? 'active' : '' }}</p>
                    </a>
                </li>
               
                <li class="nav-item">
                    <a href="{{ route('blog.index') }}"
                        class="nav-link {{ (request()->is('blog') || request()->is('blog/create') || request()->is('blog/*/edit') ) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                            Blog {{ request()->is('/blog') ? 'active' : '' }}
                        </p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="{{ route('students.student.index') }}"
                        class="nav-link ">
                        <i class=" nav-icon fa-solid fa-bell"></i>
                        <p>Students</p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="{{ route('payments') }}"
                        class="nav-link ">
                        <i class=" nav-icon fa-solid fa-bell"></i>
                        <p>Payment History</p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="{{route('notifications')}}"
                        class="nav-link ">
                        <i class=" nav-icon fa-solid fa-bell"></i>
                        <p>Notification</p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="{{ route('coupons.coupon.index') }}"
                        class="nav-link ">
                        <i class=" nav-icon fa-solid fa-bell"></i>
                        <p>Coupon code</p>
                    </a>
                </li>
				
				
                
                <li class="nav-item">
					<a href="#" class="nav-link">
                    <i class=" nav-icon fa-solid fa-bell"></i>
						<p>
						Expert Profile
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
					     <li class="nav-item">
							<a href="{{route('experts.expert.create')}}"
								class="nav-link ">
								<i class="nav-icon fa-solid fa-image"></i>
								<p>
									Add Expert
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('experts.expert.index')}}"
								class="nav-link">
								<i class="nav-icon fa-solid fa-image"></i>
								<p>
									View Expert
								</p>
							</a>
						</li>
						
						
					</ul>
				</li>



				<li class="nav-item">
					<a href="#" class="nav-link">
                    <i class=" nav-icon fa-solid fa-bell"></i>
						<p>
						Student Market Place 
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
                    <ul class="nav nav-treeview" style="display: none;">
					     <li class="nav-item">
							<a href="{{route('studentmarket.student.deals_category')}}"
								class="nav-link ">
								<i class="nav-icon fa-solid fa-image"></i>
								<p>
									Deals Category
								</p>
							</a>
						 </li>
						 <li class="nav-item">
							<a href="{{route('studentmarket.student.add_deals')}}"
								class="nav-link">
								<i class="nav-icon fa-solid fa-image"></i>
								<p>
									Add Deals
								</p>
							</a>
						  </li>
                        <li class="nav-item">
							<a href="{{route('studentmarket.student.view_deals')}}"
								class="nav-link">
								<i class="nav-icon fa-solid fa-image"></i>
								<p>
									View Deals
								</p>
							</a>
						</li>
						
						
					</ul>
				</li>
				<li class="nav-item">
                    <a href="#"
                        class="nav-link ">
                        <i class=" nav-icon fa-solid fa-bell"></i>
                        <p>Affiliate Users</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
					
                
				<ul class="nav nav-treeview" style="display: none;">
					     <li class="nav-item">
							<a href="{{route('affiliateuser.affiliate.add')}}"
								class="nav-link ">
								<i class="nav-icon fa-solid fa-image"></i>
								<p>
									Add Affiliate User
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('affiliateuser.affiliate.view')}}"
								class="nav-link">
								<i class="nav-icon fa-solid fa-image"></i>
								<p>
									View Affiliate User
								</p>
							</a>
						</li>
				</ul>
				</li>
				
                
            </ul>
        </nav>

    </div>
</aside>

<script>
$.widget.bridge('uibutton', $.ui.button)
</script>