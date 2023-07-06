    	   {{--  <h4 class="mt-0"> 
	    @hasrole('teacher')
		 <label class="switch">
            <input type="checkbox" id="toggle_switch" value="1"  checked="">
            <span class="slider"></span>
         </label> Student/Teacher
       	</h4>
        @endhasrole 


						</div>
					</div>
				</div>--}}
	 <div class="left-sidebar">
          @hasrole('teacher')
            <ul class="nav nav-pills mb-3" id="sidebar_nav" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link " id="student-tab" data-toggle="pill" href="#student" role="tab" aria-controls="student" aria-selected="true">Student  </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link " id="teacher-tab" data-toggle="pill" href="#teacher" role="tab" aria-controls="teacher" aria-selected="false">Instructor </a>
                </li>

            </ul>
      	 @endhasrole
            <div class="tab-content" id="sidebar_navContent">
                <div class="tab-pane fade show @hasrole('student') active @endif" id="student" role="tabpanel" aria-labelledby="student-tab">
                    <ul class="student-menu">
                        <li @if(url()->current() ==url('/user/dashboard')) class="active" @endif>
                            <a href="{{url('user/dashboard')}}"><span class="flaticon-puzzle-1"></span> Dashboard</a>
                        </li>
                        <li @if(url()->current() ==url('/user/my-course')) class="active" @endif>
                            <a href="{{url('user/my-course')}}"><span class="flaticon-online-learning"></span> My Upcoming Classes</a>
                        </li>
                        <li @if(url()->current() ==url('/user/my-orders')) class="active" @endif>
                            <a href="{{url('user/my-orders')}}"><span class="flaticon-shopping-bag-1"></span> Order History</a>
                        </li>
                        <li @if(url()->current() ==url('user/follow-teacher')) class="active" @endif>
                            <a href="{{url('user/follow-teacher')}}"><span class="flaticon-rating"></span> Followed Instructors</a>
                        </li>
                        <li @if(url()->current() ==url('user/my-bookmarks')) class="active" @endif>
                            <a href="{{url('user/my-bookmarks')}}"><span class="flaticon-like"></span> Wishlist</a>
                        </li>
                         @hasrole('teacher')
                         @else
						<li @if(url()->current() ==url('my-cards')) class="active" @endif>
                            <a href="{{url('/my-cards')}}"><span class="flaticon-like"></span> My Cards</a>
                        </li>
                        <li @if(url()->current() ==url('password')) class="active" @endif>
                            <a href="{{url('/password')}}"><span class="flaticon-like"></span> Setting</a>
                        </li>
                        @endhasrole
                    </ul>
                </div>
             @hasrole('teacher')
                <div class="tab-pane fade show active" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                    <ul class="teacher-menu">
                        <li @if(url()->current() ==url('teacher/dashboard')) class="active" @endif>
                            <a href="{{url('teacher/dashboard')}}"><span class="flaticon-puzzle-1"></span> Instructor Dashboard</a>
                        </li>
                        <li @if(url()->current() ==url('teacher/my-courses')) class="active" @endif>
                            <a href="{{url('teacher/my-courses')}}"><span class="flaticon-online-learning"></span> My Scheduled Classes</a>
                        </li>
                        <li @if(url()->current() ==url('teacher/all-courses')) class="active" @endif>
                            <a href="{{url('teacher/all-courses')}}"><span class="flaticon-shopping-bag-1"></span> All Classes</a>
                        </li>
                        {{--  <li>
                            <a href="{{url('teacher/canceled-courses')}}"><span class="flaticon-shopping-bag-1"></span> Canceled Course</a>
                        </li> --}}
                        <li @if(url()->current() ==url('teacher/material')) class="active" @endif>
                            <a href="{{url('teacher/material')}}"><span class="flaticon-shopping-bag-1"></span> Study Material</a>
                        </li>
                         <li @if(url()->current() ==url('teacher/my-feedback')) class="active" @endif>
                            <a href="{{url('teacher/my-feedback')}}"><span class="flaticon-shopping-bag-1"></span> Student Feedback</a>
                        </li>
                         <li @if(url()->current() ==url('/teacher/my-followers')) class="active" @endif>
                            <a href="{{url('/teacher/my-followers')}}"><span class="flaticon-shopping-bag-1"></span> My Followers</a>
                        </li>
                           <li @if(url()->current() ==url('/teacher/request-class')) class="active" @endif>
                            <a href="{{url('/teacher/request-class')}}"><span class="flaticon-shopping-bag-1"></span>Request Class</a>
                        </li>
                         <li @if(url()->current() ==url('/teacher/my_account')) class="active" @endif>
                            <a href="{{url('/teacher/my_account')}}"><span class="flaticon-shopping-bag-1"></span> My Account</a>
                        </li>
                     <li @if(url()->current() ==url('/teacher/my-earnings')) class="active" @endif>
                            <a href="{{url('/teacher/my-earnings')}}"><span class="flaticon-shopping-bag-1"></span> My Earnings </a>
                        </li>
                         <li @if(url()->current() ==url('password')) class="active" @endif>
                            <a href="{{url('/password')}}"><span class="flaticon-like"></span> Setting</a>
                        </li>
                    </ul>
                </div>
               @endhasrole
            </div>
        </div>
				{{-- <div class="dashbord_nav_list" >

						 @hasrole('teacher')
						 		<ul id="teacher_menu" >
						<li class="active"><a href="{{url('teacher/dashboard')}}"><span class="flaticon-puzzle-1"></span> Teacher Dashboard</a></li>
						<li><a href="{{url('teacher/my-courses')}}"><span class="flaticon-online-learning"></span> My Sheduled Courses</a></li>
						<li><a href="{{url('teacher/all-courses')}}"><span class="flaticon-shopping-bag-1"></span> Completed Course</a></li>
						<li><a href="{{url('teacher/material')}}"><span class="flaticon-shopping-bag-1"></span> Study Material</a></li>
					
						</ul>
					
					<ul id="student_menu" style="display: none;">
						<li class="active"><a href="{{url('user/dashboard')}}"><span class="flaticon-puzzle-1"></span> Dashboard</a></li>
						<li><a href="{{url('user/my-course')}}"><span class="flaticon-online-learning"></span> My Upcoming Courses</a></li>
						<li><a href="{{url('user/my-orders')}}"><span class="flaticon-shopping-bag-1"></span> Order History</a></li>
						 <li><a href="page-my-message.html"><span class="flaticon-speech-bubble"></span> Messages</a></li>
						<li><a href="{{url('user/follow-teacher')}}"><span class="flaticon-rating"></span> Follow Teachers</a></li>
						<li><a href="{{url('user/my-bookmarks')}}"><span class="flaticon-like"></span> Bookmarks</a></li>
			
					</ul>
				
						 @else

					<ul>
						<li class="active"><a href="{{url('user/dashboard')}}"><span class="flaticon-puzzle-1"></span> Dashboard</a></li>
						<li><a href="{{url('user/my-course')}}"><span class="flaticon-online-learning"></span> My Upcoming Courses</a></li>
						<li><a href="{{url('user/my-orders')}}"><span class="flaticon-shopping-bag-1"></span> Order History</a></li>
						<li><a href="page-my-message.html"><span class="flaticon-speech-bubble"></span> Messages</a></li>
						<li><a href="{{url('user/follow-teacher')}}"><span class="flaticon-rating"></span> Follow Teachers</a></li>
						<li><a href="{{url('user/my-bookmarks')}}"><span class="flaticon-like"></span> Bookmarks</a></li>
			
					</ul>
						 @endhasrole

						 <h4>Account</h4>
								<ul>
									<li><a href="{{url('/my-cards')}}"><span class="flaticon-settings"></span>My Cards</a></li>
									<li><a href="page-login.html"><span class="flaticon-logout"></span> Logout</a></li>
								</ul>  --}}


				