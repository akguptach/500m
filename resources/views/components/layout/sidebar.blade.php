<?php


use App\Models\User;
use Illuminate\Support\Facades\Auth;



$user = Auth::user();
$role = $user->role_id;


$permissions = User::with(['userPermissions.permission' => function ($query) {
    $query->select('id', 'route_name');
}])->where('id', Auth::User()->id)->first();

$rolePermissions = User::with(['role.rolePermissions.permission' => function ($query) {
    $query->select('id', 'route_name');
}])->where('id', Auth::User()->id)->first();


$routes = [];
foreach ($rolePermissions->role->rolePermissions as $rolePermissions) {
    if(isset($rolePermissions['permission']['route_name']))
    $routes[] = $rolePermissions['permission']['route_name'];
}


foreach ($permissions['userPermissions'] as $userPermissions) {
    if(isset($userPermissions?->permission['route_name']))
    $routes[] = $userPermissions->permission['route_name'];
}

?>


<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">


            
            <li><a class="ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="nav-icon fas fa-copy"></i>
                    <span class="nav-text"> Dashboard </span>
                </a>
            </li>
            


            @if(in_array('orders', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{ route('orders.new') }}" aria-expanded="false">
                    <i class="nav-icon fas fa-question"></i>
                    <span class="nav-text">Order</span>
                </a>
            </li>
            @endif


            @if(in_array('tutor_view.profile_status', $routes) || $role == '1')
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="nav-icon fas fa-user">
                        <span class="nav-text"> </i>Tutor</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('tutor_view.profile_status',['profile_status'=>'approved']) }}"> Approved</a>
                    </li>
                    <li><a href="{{ route('tutor_view.profile_status',['profile_status'=>'pending']) }}">Pending</a>
                    </li>
                    <li><a href="{{ route('tutor_view.profile_status',['profile_status'=>'baned']) }}"> Banned</a></li>
                    <?php /*<li><a href="{{ route('tutor_view.profile_status',['profile_status'=>'incompelte']) }}">Incomplete</a></li>*/ ?>

                </ul>
            </li>
            @endif

            @if(in_array('students.student.index', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{ route('students.student.index') }}" aria-expanded="false">
                    <i class=" nav-icon fa-solid fa-user-check">
                        <span class="nav-text"></i>Student</span>
                </a>
            </li>
            @endif


            @if(in_array('withdraw_request_view', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{ route('withdraw_request_view') }}" aria-expanded="false">
                    <i class="nav-icon fas fa-indian-rupee-sign"></i>
                    <span class="nav-text">Withdraw Requests</span>
                </a>
            </li>
            @endif

            @if(in_array('payments', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{ route('payments') }}" aria-expanded="false">
                    <i class=" nav-icon fa-solid fa-credit-card">
                        <span class="nav-text"></i>Payment History</span>
                </a>
            </li>
            @endif


            @if(in_array('notifications', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{route('notifications','customer')}}" aria-expanded="false">
                    <i class=" nav-icon fa-solid fa-bell">
                        <span class="nav-text"> </i>Notification</span>
                </a>
            </li>
            @endif


            @if(in_array('contact.form.store', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{ route('contact.form.store','pending') }}" aria-expanded="false">
                    <i class="nav-icon fas fa-book">
                        <span class="nav-text"> </i>Customer Enquiry</span>
                </a>
            </li>
            @endif

            @if(in_array('media.save', $routes)
            || in_array('pages', $routes)
            || in_array('service_keywords.service_keyword.index', $routes)
            || in_array('services_index', $routes)
            || in_array('faq.index', $routes)

            || $role == '1')
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="nav-icon fas fa-money-check"></i>
                    <span class="nav-text">Content Management</span>
                </a>
                <ul aria-expanded="false">

                    @if(in_array('media.save', $routes) || $role == '1')
                    <li><a href="{{route('media.save')}}">Media</a></li>
                    @endif

                    @if(in_array('pages', $routes) || $role == '1')
                    <li><a href="{{ route('pages') }}">Pages</a></li>
                    @endif

                    @if(in_array('service_keywords.service_keyword.index', $routes) || $role == '1')
                    <li><a href="{{ route('service_keywords.service_keyword.index') }}">Services Keyword</a></li>
                    @endif

                    @if(in_array('services_index', $routes) || $role == '1')
                    <li><a href="{{ route('services_index') }}">Services</a></li>
                    @endif

                    @if(in_array('faq.index', $routes) || $role == '1')
                    <li><a href="{{ route('faq.index') }}">FAQ</a></li>
                    @endif
                </ul>
            </li>
            @endif


            @if(in_array('blog_categories.blog_category.index', $routes)
            || in_array('blog.index', $routes)
            || $role == '1')
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class=" nav-icon fa-solid fas fa-map-marked"></i>
                    <span class="nav-text"> </i>Blog</span>
                </a>
                <ul aria-expanded="false">
                    @if(in_array('blog_categories.blog_category.index', $routes) || $role == '1')
                    <li><a href="{{route('blog_categories.blog_category.index')}}">Blog Category</a></li>
                    @endif

                    @if(in_array('blog.index', $routes) || $role == '1')
                    <li><a href="{{route('blog.index')}}">Blogs</a></li>
                    @endif
                </ul>
            </li>
            @endif


            @if(in_array('coupons.coupon.index', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{ route('coupons.coupon.index') }}" aria-expanded="false">
                    <i class=" nav-icon fa-solid  fa-gift">
                        <span class="nav-text"></i>Coupon Code</span>
                </a>
            </li>
            @endif

            @if(in_array('subject.index', $routes)
            || in_array('tasktype.index', $routes)
            || in_array('level_study.index', $routes)
            || in_array('grade.index', $routes)
            || in_array('referencing.index', $routes)
            || $role == '1')
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="nav-icon fas fa-indian-rupee-sign"></i>
                    <span class="nav-text">Pricing Calculator</span>
                </a>
                <ul aria-expanded="false">
                    @if(in_array('subject.index', $routes) || $role == '1')
                    <li><a href="{{ route('subject.index') }}">Subject</a></li>
                    @endif
                    @if(in_array('tasktype.index', $routes) || $role == '1')
                    <li><a href="{{ route('tasktype.index') }}">Task Type</a></li>
                    @endif
                    @if(in_array('level_study.index', $routes) || $role == '1')
                    <li><a href="{{ route('level_study.index') }}">Level of Study</a></li>
                    @endif
                    @if(in_array('grade.index', $routes) || $role == '1')
                    <li><a href="{{ route('grade.index') }}">Grades</a></li>
                    @endif
                    @if(in_array('referencing.index', $routes) || $role == '1')
                    <li><a href="{{ route('referencing.index') }}">Refrencing Style</a></li>
                    @endif
                </ul>
            </li>
            @endif

            @if(in_array('website.index', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{ route('website.index') }}" aria-expanded="false">
                    <i class="nav-icon fas fas fa-coins">
                        <span class="nav-text"></i> Website Manager</span>
                </a>
            </li>
            @endif


            @if(in_array('experts.expert.index', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{route('experts.expert.index')}}" aria-expanded="false">
                    <i class=" nav-icon fa-solid  fa-gift">
                        <span class="nav-text"></i>Experts</span>
                </a>
            </li>
            @endif

            @if(in_array('studentmarket.student.deals_category', $routes)
            || in_array('studentmarket.student.view_deals', $routes)
            || $role == '1')
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class=" nav-icon fa-solid fas fa-map-marked"></i>
                    <span class="nav-text"> </i>Student Market Place</span>
                </a>
                <ul aria-expanded="false">
                    @if(in_array('studentmarket.student.deals_category', $routes) || $role == '1')
                    <li><a href="{{route('studentmarket.student.deals_category')}}">Deals Category</a></li>
                    @endif

                    @if(in_array('studentmarket.student.view_deals', $routes) || $role == '1')
                    <li><a href="{{route('studentmarket.student.view_deals')}}">Deals</a></li>
                    @endif

                </ul>
            </li>
            @endif

            @if(in_array('affiliateuser.affiliate.view', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{route('affiliateuser.affiliate.view')}}" aria-expanded="false">
                    <i class=" nav-icon fa-solid  fa-gift">
                        <span class="nav-text"></i>View Affiliate User</span>
                </a>
            </li>
            @endif




            @if(in_array('staffuser.list', $routes)
            || in_array('role.index', $routes)
            || $role == '1')
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class=" nav-icon fa-solid fas fa-map-marked"></i>
                    <span class="nav-text"> </i>Staff</span>
                </a>
                <ul aria-expanded="false">
                    @if(in_array('staffuser.list', $routes) || $role == '1')
                    <li><a href="{{route('staffuser.list')}}">Users</a></li>
                    @endif

                    @if(in_array('role.index', $routes) || $role == '1')
                    <li><a href="{{route('role.index')}}">Role</a></li>
                    @endif
                </ul>
            </li>
            @endif


            <?php /*<li><a class="ai-icon" href="{{ route('role.index') }}" aria-expanded="false">
						<i class="nav-icon fas fas fa-cogs"></i>
						<span class="nav-text"> Role</span>
					  </a>
				    </li>*/ ?>



            @if(in_array('subscription', $routes) || $role == '1')
            <li><a class="ai-icon" href="{{route('subscription')}}" aria-expanded="false">
                    <i class=" nav-icon fa-solid fa-bell">
                        <span class="nav-text"></i>Subscription</span>
                </a>
            </li>
            @endif



            <?php /*<li><a class="ai-icon" href="{{ route('blog.index') }}" aria-expanded="false">
						<i class="nav-icon fas fa-blog">
						<span class="nav-text">  </i>Blog</span>
					  </a>
				    </li>*/ ?>











            <?php /*<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="fas fa-user-check	"></i>
							<span class="nav-text">Expert Profile</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('experts.expert.create')}}">Add Expert</a></li>
                            <li><a href="{{route('experts.expert.index')}}">View Expert</a></li>
                            
                        </ul>
                    </li>*/ ?>






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