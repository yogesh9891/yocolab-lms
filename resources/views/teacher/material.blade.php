@extends('layouts.app')
@section('title','Yocolab')
@section('content')
<div class="custom-dashboard-wrapper">
    @include('student.nav')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="my_course_content_container">
                        <div class="my_course_content mb30 pt-0">
                            <div class="my_course_content_header py-2">
                                <div class="col-xl-4">
                                    <div class="instructor_search_result style2">
                                        <h4 class="mt10">Study Material</h4>
                                    </div>
                                </div>
                                <div class="col-xl-8 pt-1">
                                     @if(Session::has('success'))
                                                        <div class="alert alert-success">
                                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                                            <div class="icon hidden-xs">
                                                              <i class="fa fa-check"></i>
                                                            </div>
                                                            <strong>Congratulations!</strong>
                                                            <Br /> {{Session::get('success')}}
                                                          </div>
                                            @endif
                                    <div class="candidate_revew_select style2 text-right">
                                        <h4 class="m0"> <a href="" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" data-toggle="modal" data-target="#AddMaterial">Add Material</a></h4>
                                    </div>
                                </div>
                             
                            </div>
                            <div class="my_course_content_list">
                                <div class="my_setting_content_details">
                                @if(count($datas) > 0)
                                    <div class="cart_page_form style2 in-st">
                                        <form action="#">
                                            <div class="table-responsive custom-table-responsive text-left" style="">
                                                <table class="table custom-table" id="Mytable">
                                                <thead>
                                                <tr>
                                                
                                                    
                                                    <th scope="col"  style="width: 75%;">Title</th>
                                               
                                                                                                    
                                                    <th scope="col">
                                                        <div class="d-flex custom-tb">
                                                            <div>File</div>
                                                            <div>Edit</div>
                                                            <div>Delete</div>
                                                        </div>

                                                        

                                                    </th>
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                 @foreach($datas as $t)
                                                    <tr>
                                                    
                                                    <td id="title-{{$t->id}}" style="width: 75%;">{{$t->title}}</td>
                                                    
                                                    <td>
                                                    <div class="action-link-wrapper">
                                                                <input type="hidden" id="file-{{$t->id}}">
                                                                <a href="{{asset('storage/material/'.$t->file)}}" download class="icon-button dwn-icon btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border"><i class="fa fa-download"></i></a>
                                                                <a href="javascript::void(0)" class="icon-button edit-icon btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border EditMaterial" data-toggle="tooltip" title="" data-original-title="Edit" id="{{$t->id}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                    <a href ="#!" class="icon-button del-icon btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border"  data-toggle="modal" data-target="#cancle_calss-{{$t->id}}"  data-toggle="tooltip" title="" data-original-title="Delete" >
                                                                        <i class="fa fa-times"></i>
                                                                    </a>

                                                                        <div class="modal cancel-class-modal" id="cancle_calss-{{$t->id}}" tabindex="-1" role="dialog" aria-hidden="true" course={{$t->id}}>
                                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                              ">
                                                                    
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure you want to delete this Study material?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                           {{--  <div class="modal-body">
                                                                <p>Do you want to proceed for delete this study material ?</p>
                                                            </div>
                                                                     --}}    <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                                                            <a href="{{url('teacher/delete-material/'.$t->id)}}" class="btn btn-danger btn-ok btn-primary-custom-round">Yes</a>
                                                                        </div>
                                                                    </div>
                                                             
                                                            </div>
                                                        </div>
                                                             
                                                                  
                                                                     
                                                            </div>
                                                    
                                                    </td>

                                                    </tr>


                                                    
                                                <tr class="spacer"><td colspan="100"></td></tr> 
                                                @endforeach
                                                
                                                
                                                
                                                
                                                </tbody>
                                                </table>
                                                </div>
                                            
                                        </form>
                                    </div>
                                 @else
                                <h2 class="no-classes " >No Study Material Available</h2>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AddMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('material')}}" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('post')
                    <label for="formGroupExampleInput1">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" required="" >
                    <div class=" form-group">
                        <label for="formGroupExampleInput3">File</label>
                        <input type="file" class="form-control" name="file" required="" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class=" my_setting_savechange_btn btn btn-thm">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="EditMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="post" enctype="multipart/form-data" id="editForm">
        @csrf
        @method('put')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="formGroupExampleInput1">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" id="material-title" required="">
                <div class=" form-group">
                    <label for="formGroupExampleInput3">File</label>
                    <input type="file" class="form-control" name="file" required="" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="my_setting_savechange_btn btn btn-thm">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('afterScript')
<script type="text/javascript">
    // $('').modal('show')



    $('.EditMaterial').click(function () {
        let id = $(this).attr('id');
        let title = $('#title-'+id).text();
        $('#editForm').attr('action','/teacher/material/'+id+'/edit');
        console.log(title);
        $('#material-title').val(title);
        $('#EditMaterial').modal('show');
    })
</script>
@endsection