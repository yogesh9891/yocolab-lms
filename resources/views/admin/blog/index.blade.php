@extends('layouts.backend')
@section('content')
<div class="our-dashbord dashbord">
		<div class="dashboard_main_content">
			<div class="container-fluid">
				<div class="main_content_container">
					<div class="row">
					  @if (Session::has('flash_message'))
                        <div class="container">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('flash_message') }}
                            </div>
                        </div>
                    @endif
						<div class="col-lg-12">

							<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
								<h4 class="title float-left">Blog</h4>  
								<a href="{{route('blog.create')}}" class="btn btn-info float-right">Add Blog</a>
							</nav>
						
						 @if(!$data->isEmpty())
                            <table class="table table-bordered table-striped " id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#Id</th>
                                        <th>Title</th>
                                        <th class="d-none d-sm-table-cell">Category</th>
                                        <th class="d-none d-sm-table-cell">Status</th>
                             
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $blog)
                                    <tr>
                                        <td class="text-center">{{$blog->id}}</td>
                                        <td class="font-w600">{{$blog->title}}</td>
                                        <td class="d-none d-sm-table-cell">{{$blog->category->name}}
                                        </td>
                                       

                                           <td class="d-none d-sm-table-cell">

                                         <input type="checkbox" @if($blog->status == 1) checked @endif class="blogStatus check_box" data-id="{{ $blog->id }}"> 
                                        </td>
                                        <td class="text-center">
                                           <div class="btn-group">
                                            
                                                <a href="{{route('blog.edit',$blog->id)}}" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                <i class="far fa-edit"></i>

                                                </a>
                                                <form action="{{route('blog.destroy',$blog->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                <button type ="submit" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <span class="alert-info d-block mb-15 p-15" role="alert">
                                             
                                     <strong>No blog</strong>
                                               
                                </span>
                            @endif
						  
				
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	@endsection

    @section('afterScript')
    <script type="text/javascript">
        

          $(".blogStatus").on('click',function() {
               var id = $(this).attr('data-id');

               $.ajax({
                    type: "POST",
                    url: "/admin/blogStatus",
                    headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                    data: {
                        id: id
                    },
                    success: function (msg) {
                        // console.log(msg)
                    }
                });
           });


          $(".categoryTop").on('click',function() {
               var id = $(this).attr('data-id');

               $.ajax({
                    type: "POST",
                    url: "/admin/categoryTop",
                    headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                    data: {
                        id: id
                    },
                    success: function (msg) {
                        // console.log(msg)
                    }
                });
           });



</script>
  
    @endsection