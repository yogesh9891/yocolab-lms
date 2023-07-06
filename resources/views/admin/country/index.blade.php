@extends('layouts.backend')
@section('content')
<style type="text/css">
    .hidden {
        display: none;
    }
</style>
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
								<h4 class="title float-left">Country</h4>  
								
							</nav>
						
						 @if(!$data->isEmpty())
                            <table class="table table-bordered table-striped " id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#Id</th>
                                        <th>Country</th>
                                        <th class="d-none d-sm-table-cell">Status</th>
                                        <th class="d-none d-sm-table-cell">Action</th>
                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td class="text-center">{{$item->id}}</td>
                                        <td class="font-w600">{{$item->name}}</td>
                                        
                                       

                                           <td class="d-none d-sm-table-cell">

                                         <input type="checkbox" @if($item->status == 1) checked @endif class="countryStatus check_box" data-id="{{ $item->id }}"> 
                                        </td>
                                        <td class="text-center">
                                           <div class="btn-group">
                                           
                                             {{--    <a href="{{route('zoomId.edit',$item->id)}}" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                <i class="far fa-edit"></i>

                                                </a> --}}
                                                <form action="{{route('country.destroy',$item->id)}}" method="post">
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

                            {!! $data->links() !!}
                            @else
                                <span class="alert-info d-block mb-15 p-15" role="alert">
                                             
                                     <strong>No zoomId</strong>
                                               
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
        

          $(".zoomIdStatus").on('click',function() {
               var id = $(this).attr('data-id');

               $.ajax({
                    type: "POST",
                    url: "/admin/zoomIdStatus",
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