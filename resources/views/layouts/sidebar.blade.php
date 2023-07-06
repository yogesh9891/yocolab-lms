	<section class="dashboard_sidebar dn-1199">
		<div class="dashboard_sidebars">
			<div class="user_board">
				<div class="user_profile">
					<div class="media">
					  	<div class="media-body">
					    	<h4 class="mt-0">Menu</h4>
						</div>
					</div>
				</div>
				<div class="dashbord_nav_list">
					<ul>
						<li class="active"><a href="{{route('admin')}}"><span class="flaticon-puzzle-1"></span>Dashboard </a></li>
						<li><a href="{{route('category.index')}}"><span class="flaticon-puzzle-1"></span> Categroy</a></li>
						<li><a href="{{url('admin/users')}}"><span class="flaticon-puzzle-1"></span> Users</a></li>
						<li><a href="{{url('admin/teacher')}}"><span class="flaticon-puzzle-1"></span> Teachers</a></li>
						<li><a href="{{route('material.index')}}"><span class="flaticon-puzzle-1"></span> Study Material</a></li>
						<li><a href="{{url('admin/currency')}}"><span class="flaticon-puzzle-1"></span> Currency</a></li>
						<li><a href="{{url('admin/course_query')}}"><span class="flaticon-puzzle-1"></span>Course Query</a></li>
						<li><a href="{{url('admin/course-reports')}}"><span class="flaticon-puzzle-1"></span>Course Reports</a></li>
						<li><a href="{{url('admin/request-class')}}"><span class="flaticon-puzzle-1"></span>Request Class</a></li>
						<li><a href="{{url('admin/country')}}"><span class="flaticon-puzzle-1"></span>Country</a></li>
						<li><a href="{{url('admin/language')}}"><span class="flaticon-puzzle-1"></span>Language</a></li>
						<li><a href="{{url('admin/blog')}}"><span class="flaticon-puzzle-1"></span>Blog</a></li>
						<li><a href="{{url('admin/zoomId')}}"><span class="flaticon-puzzle-1"></span>Zoom Ids</a></li>
						<li><a href="{{route('faq.index')}}"><span class="flaticon-puzzle-1"></span>Faqs</a></li>
					</ul>
					<h4>Course</h4>
					<ul>
						<li><a href="{{url('admin/pending-course')}}"><span class="flaticon-puzzle-1"></span>Pending Course </a></li>
						<li><a href="{{url('admin/complete-course')}}"><span class="flaticon-puzzle-1"></span> Complete Course</a></li>
					</ul>
					<h4>Reports</h4>
					<ul>
						<li><a href="{{url('admin/cancel-course')}}"><span class="flaticon-puzzle-1"></span>Cancel Reports </a></li>
						<li><a href="{{url('admin/stripe-reports')}}"><span class="flaticon-puzzle-1"></span>Stripe Reports </a></li>
						<li><a href="{{url('admin/razorpay-pending-reports')}}"><span class="flaticon-puzzle-1"></span> Razorpay Pending </a></li>
						<li><a href="{{url('admin/razorpay-complete-reports')}}"><span class="flaticon-puzzle-1"></span> Razorpay complete 	</a></li>
					</ul>
					<h4>Account</h4>
					<ul>
						<li><a href="{{url('admin/password')}}"><span class="flaticon-settings"></span> Password</a></li>
						<li> <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                        @csrf
                                        		<button  class="btn btn-primary" type="submit">Log out</button>
                                    </form>


					</li>
					</ul>
				</div>
			</div>
		</div>
	</section>