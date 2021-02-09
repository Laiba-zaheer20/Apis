@extends('layouts.index')
@section('title')
          Subcategory
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
#color, .btn-sm{
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Subcategory details</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <form class="row"action="">
                        <div class=" col-md-4 form-group">
                           <input type="text"  placeholder="search..." name="searchsubcat" id="searchsubcat" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        <a href=""class="btn btn-info"><i class="fa fa-refresh" ></i></a>
                        </form>
                          <div id="table_data">
                             @include('admin.subcattable')
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- items Modal1 -->
               <div class="modal fade" id="delsubcat" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-trash"></i> Delete Subcategory</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                         Are you sure you want to delete this subcategory?
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="delsubcatbtn btn btn-danger pull-left" >yes</button>
                           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                     <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->
              <!-- Modal -->
             
              <div class="modal fade" id="updatesubcat" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-edit"></i> Update subcategory</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                              
                              <form id='updatesubcatform' action="{{route('updatesubcat')}}" method="post" enctype="multipart/form-data">
                                @csrf  
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Type</label>
                                          <input type="hidden" id="updatesubcatid" name="updatesubcatid" >
                                          <input type="text" id="editsubcattype"name="SubCatType" class="form-control">
                                       </div>
                                       <div class="col-md-6 form-group">
                                       <label class="control-label">Select category</label>
                                          <input type="text" list="findcat" placeholder="search category..." name="searchcat" id="searchcat" class="form-control">
                                          <datalist id="findcat">
                                   
                                          </datalist>
                                       </div>
                                       <button type="submit" class="updatesubcatbtn btn btn-danger pull-left" >Save changes</button>
                        </form>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                       
                           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                     <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
               </div>    
      @endsection


@section('script')
<script>
$(document).ready(function(){

   $(document).on('click', '.pagination a', function(event){
  event.preventDefault(); 
  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page);
 });

 function fetch_data(page)
 {
   $.ajax({
   url:"/adminportal/subcategory/fetch_data?page="+page,
   success:function(data)
   {
    $('#table_data').html(data);
    
   }
  });
 }

   //search category
$('#searchcat').keyup(function(){
  
  var name = $('#searchcat').val();
$.post('searchcat',{name : name,  "_token": "{{ csrf_token() }}",},function(data){
$('#findcat').html(data);
});

});


 
 var name = $('#searchcat').val();
$.post('searchcat',{name : name,  "_token": "{{ csrf_token() }}",},function(data){
$('#findcat').html(data);
});



   $('.subcatdel').click(function(){
 var delid = $(this).attr('id');    //  alert(delid);
 $('.delsubcatbtn').click(function(){
   $(".subcat" + delid).remove();
   $.get("{{route('delsubcat')}}", {id:delid}, function(data){
     alert(data);
 });
 });
   
});




//update subcategory
$('.updatesubcat').click(function(){
 var subcatid = $(this).attr('id');
 $('#updatesubcatid').val(subcatid);
 $.get("{{route('fetchsubcat')}}", {id:subcatid}, function(data){

$('#editsubcattype').attr('placeholder',data);
 });
   
});
$('.updatesubcatbtn').click(function(){
   $('#updatesubcatform').on('submit', function(event){
  event.preventDefault();
  $.ajax({
    url:"{{ route('updatesubcat') }}",
    method:"POST",
    data: $('form').serialize(),
    dataType:"json",
    success:function(data)
    { alert(data.cat);
     $('.type'+data.id).html(data.type);
     $('.cat'+data.id).html(data.cat);
    }
   });});
});



});
</script>
@endsection