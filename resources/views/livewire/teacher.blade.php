<div>
    <div class="custom-dashboard-wrapper">

                
                 <div class="left-sidebar">
          @hasrole('teacher')
            <ul class="nav nav-pills mb-3" id="sidebar_nav" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{url('/user/dashboard')}}" class="nav-link " >Student  </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active " id="teacher-tab" data-toggle="pill" href="#teacher" role="tab" aria-controls="teacher" aria-selected="false">Instructor </a>
                </li>

            </ul>
         @endhasrole
            <div class="tab-content" id="sidebar_navContent">
             
             @hasrole('teacher')
                <div class="tab-pane fade show active" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                    <ul class="teacher-menu">
                        <li @if($view ==1) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="teacher_dashboard"><span class="flaticon-puzzle-1" ></span> Instructor Dashboard</a>
                        </li>
                        <li @if($view ==2) class="active" @endif>

                            <a href="javascript:void(0); " wire:click="teacher_my_courses"><span class="flaticon-online-learning" ></span> My Scheduled Classes</a>
                        </li>
                        <li @if($view ==3) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="teacher_courses"><span class="flaticon-shopping-bag-1"></span> All Classes</a>
                        </li>
                         <li @if($view ==9) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="requested_class"><span class="flaticon-shopping-bag-1"></span> Requested Class</a>
                        </li>
                        <li @if($view ==4) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="teacher_study_material"><span class="flaticon-shopping-bag-1"></span> Study Material</a>
                        </li>
                         <li @if($view ==5) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="teacher_my_feedback"><span class="flaticon-shopping-bag-1"></span> Student Feedback</a>
                        </li>
                         <li @if($view ==6) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="teacher_followers"><span class="flaticon-shopping-bag-1"></span> My Followers</a>
                        </li>
                         <li @if($view ==7) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="teacher_my_account"><span class="flaticon-shopping-bag-1"></span> My Account</a>
                        </li>
                     <li @if($view ==8) class="active" @endif>
                            <a href="javascript:void(0);" wire:click="teacher_my_earning"><span class="flaticon-shopping-bag-1"></span> My Earnings </a>
                        </li>
                         <li @if(url()->current() ==url('password')) class="active" @endif>
                            <a href="{{url('/password')}}"{{--  wire:click="teacher_dashboard" --}}><span class="flaticon-like"></span> Setting</a>
                        </li>
                    </ul>
                </div>
               @endhasrole
            </div>
        </div>
                

     <div class="content-wrapper">
            <div class="content">
   
             @switch($view)
                    @case(1)

                             @include('livewire.teacher.dashboard')
                             @break

                    @case(2)
                             @include('livewire.teacher.my_course')
                             @break
                    @case(3)
                             @include('livewire.teacher.all_courses')
                             @break
                    @case(4)
                             @include('livewire.teacher.material')
                             @break
                    @case(5)
                             @include('livewire.teacher.feedback')
                             @break
                    @case(6)
                             @include('livewire.teacher.follower')
                             @break
                    @case(7)
                             @include('livewire.teacher.my_account')
                             @break
                    @case(8)
                             @include('livewire.teacher.my_earning')
                             @break
                     @case(9)
                             @include('livewire.teacher.requested_class')
                             @break
                    @default
                        @include('livewire.teacher.dashboard')
                @endswitch
            </div>
        </div>
    </div>
</div>
