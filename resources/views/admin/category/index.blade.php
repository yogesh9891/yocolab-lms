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
								<h4 class="title float-left">Category</h4>  
								<a href="{{route('category.create')}}" class="btn btn-info float-right">Add Category</a>
							</nav>
						
						 @if(!$categories->isEmpty())
                            <table class="table table-bordered table-striped " id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#Id</th>
                                        <th>Name</th>
                                        <th class="d-none d-sm-table-cell">Parent</th>
                                        <th class="d-none d-sm-table-cell">Status</th>
                                        <th class="d-none d-sm-table-cell">Top</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td class="text-center">{{$category->id}}</td>
                                        <td class="font-w600"><a href="{{route('category.show',$category->id)}}" class="text-info">{{$category->name}}</a></td>
                                        <td class="d-none d-sm-table-cell">

                                            @if($category->parent_id ==  0 )
                                            None
                                            @else
                                            {{$category->parentCategory->name}}

                                            @endif


                                        </td>
                                        <td class="d-none d-sm-table-cell">

                                         <input type="checkbox" @if($category->top == 1) checked @endif class="categoryTop check_box" data-id="{{ $category->id }}"> 
                                        </td>

                                           <td class="d-none d-sm-table-cell">

                                         <input type="checkbox" @if($category->status == 1) checked @endif class="categoryStatus check_box" data-id="{{ $category->id }}"> 
                                        </td>
                                        <td class="text-center">
                                           <div class="btn-group">
                                            <a href="{{route('category.show',$category->id)}}" class="btn btn-sm btn-info js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Show Subcategory">
                                                <i class="far fa-eye"></i>

                                                </a>
                                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                <i class="far fa-edit"></i>

                                                </a>
                                                <form action="{{route('category.destroy',$category->id)}}" method="post">
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
                                             
                                     <strong>No Category</strong>
                                               
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
        

          $(".categoryStatus").on('click',function() {
               var id = $(this).attr('data-id');

               $.ajax({
                    type: "POST",
                    url: "/admin/categoryStatus",
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