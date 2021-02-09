@extends('layouts.index')
@section('title')
          Category
@endsection

@section('content')
<style>
th{
   text-align: center;
}
td {
    vertical-align: middle;
    text-align: center;
}
img{
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
   border-radius:10%;
}
#display, span, .btn-sm, #show, #minus{
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.imgbody {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
</style>
<div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Category details</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <a href="addcat" class="btn btn-primary" ><i class="fa fa-plus"></i> Add Items</a>

                      
                          <div id="table_data">
                          <div style ="margin-top:2%"class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr  class="info">
                                       <th>Image</th>
                                       <th>Name</th>
                                       <th>Added</th>
                                       <th>last update</th>
                                       
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @if(!$data==null)
                                 @foreach($data as $row)
                                 <tr class="cat{{$row->id}}">
                                 <td class="img{{$row->id}}" ><img  height="80" width="100" src="{{$row->image}}" alt="..."></td>

                                   <td>{{$row->name}}</td>
                                   <td>{{$row->created_at}}</td>
                                    <td>{{$row->updated_at}}</td>
                              <td><a href="#updatecat" id='{{$row->id}}' data-toggle="modal" data-target="#updatecat"class="updatecat btn-sm btn-warning" ><i class="fa fa-edit"></i></a>
                              <a href="#delmodel" id='{{$row->id}}'data-toggle="modal" data-target="#delmodel"class="del btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
                              </td>
                           </tr>
                                   
                                    @endforeach
                                    @endif
                                 </tbody>
                              </table> 
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal fade" id="delmodel" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-trash"></i> Delete Category</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                         Are you sure you want to delete this Category?
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="delcatbtn btn btn-danger pull-left" >yes</button>
                           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                     <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->
              <!-- Modal -->
      @endsection


@section('script')
<script>
$(document).ready(function(){



   $('.del').click(function(){
 var delid = $(this).attr('id');      //alert(delid);
 $('.delcatbtn').click(function(){
   $(".cat" + delid).remove();
   $.get("{{route('delcat')}}", {id:delid}, function(data){
     alert(data);
  });
 });
   
});


});
</script>
@endsection