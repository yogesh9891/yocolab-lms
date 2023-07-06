<div class="custom-dashboard-wrapper">

                         <div class="left-sidebar">
          @hasrole('teacher')
            <ul class="nav nav-pills mb-3" id="sidebar_nav" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active " id="student-tab" data-toggle="pill" href="#student" role="tab" aria-controls="student" aria-selected="false">Student </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{url('/teacher/dashboard')}}" class="nav-link " >Instructor  </a>
                </li>

            </ul>
         @endhasrole
            <div class="tab-content" id="sidebar_navContent">
             
                  <div class="tab-pane fade show @hasrole('student') active @endif" id="student" role="tabpanel" aria-labelledby="student-tab">
                    <ul class="student-menu">
                        <li @if(url()->current() ==url('/user/dashboard')) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="student_dashboard"><span class="flaticon-puzzle-1"></span> Dashboard</a>
                        </li>
                        <li @if(url()->current() ==url('/user/my-course')) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="student_my_course"><span class="flaticon-online-learning"></span> My Upcoming Classes</a>
                        </li>
                        <li @if(url()->current() ==url('/user/my-orders')) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="student_order"><span class="flaticon-shopping-bag-1"></span> Order History</a>
                        </li>
                        <li @if(url()->current() ==url('user/follow-teacher')) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="student_followed_instructor"><span class="flaticon-rating"></span> Followed Instructors</a>
                        </li>
                        <li @if(url()->current() ==url('user/my-bookmarks')) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="student_wishlist"><span class="flaticon-like"></span> Wishlist</a>
                        </li>
                         @hasrole('teacher')
                         @else
                       {{--  <li @if(url()->current() ==url('my-cards')) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="my_cards"><span class="flaticon-like"></span> My Cards</a>
                        </li> --}}
                        <li @if(url()->current() ==url('password')) class="active" @endif>
                            <a href="{{url('password')}}"><span class="flaticon-like"></span> Setting</a>
                        </li>
                        @endhasrole
                    </ul>
                </div>

            </div>
        </div>
                    

     <div class="content-wrapper">
            <div class="content">
             
             @switch($view)
                    @case(1)

                             @include('livewire.student.dashboard')
                             @break

                    @case(2)
                             @include('livewire.student.my_course')
                             @break
                    @case(3)
                             @include('livewire.student.order')
                             @break
                    @case(4)
                             @include('livewire.student.teacher')
                             @break
                    @case(5)
                             @include('livewire.student.bookmark')
                             @break
                    @case(6)
                             @include('livewire.student.card')
                             @break
                    @default
                        @include('livewire.student.dashboard')
                @endswitch
            </div>
        </div>
    </div>
