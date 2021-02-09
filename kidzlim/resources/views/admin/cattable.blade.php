<div style ="margin-top:2%"class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr  class="info">
                                       <th>Image</th>
                                       <th>Name</th>
                                       <th>Type</th>
                                       <th>Subcategory</th>
                                       <th>Added</th>
                                       <th>last update</th>
                                       <th>status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @if(!$data==null)
                                 @foreach($data as $row)
                                    <tr class='item{{$row->CategoryID}}'>
                                       <td class="img{{$row->CategoryID}}" ><img  height="80" width="100" src="{{$row->image}}" alt="..."></td>
                                       <td class="name{{$row->CategoryID}}">{{$row->CatName}}</td>
                                       <td class="type{{$row->CategoryID}}">{{$row->CategoryType}}</td>
                                       <td>  @foreach($row->subcategory as $subcat)
                                       - {{$subcat->SubCatType}} <br>
                                       @endforeach</td>
                                       <td>{{$row->created_at}}</td>
                                       <td>{{$row->updated_at}}</td>
                                       <td><span class="label-success label label-default" >Active</span>
                                       </td>
                                       <td><a href="#updatecat" id='{{$row->CategoryID}}' data-toggle="modal" data-target="#updatecat"class="updatecat btn-sm btn-warning" ><i class="fa fa-edit"></i></a>
                                       <!-- <a href="#delitem" id='{{$row->CategoryID}}'data-toggle="modal" data-target="#delitem"class="del btn-sm btn-danger" ><i class="fa fa-trash"></i></a> -->
                                       </td>
                                    </tr>
                                   
                                    @endforeach

                                 </tbody>
                              </table> 
                             
                               {{$data[$max-1]->subcategory->links()}}
                               @endif
                              @if($data==null)
                              No data available
                              @endif

                



               <div class="modal fade" id="updatecat" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-edit"></i> Upadate category</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                              <div class="col-md-6 form-group">
                              <form id='updatecatform' action="{{route('updatecat')}}" method="post" enctype="multipart/form-data">
                                @csrf  
                                          <label class="control-label">Name</label>
                                          <input type="hidden" id="updatecatid" name="updatecatid" >
                                          <input type="text" id="editcatname" value=""name="CatName" class="form-control">
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Type</label>
                                          <input type="text" value="" id="editcattype"name="CategoryType" class="form-control">
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Image</label><br>
                                          <input type="hidden" name="editcatimgid" id="editcatimgid">
                                          <a href="#imgmodal" data-toggle="modal" data-target="#imgmodal"class="img btn-sm btn-primary" >Add image</a>
                                          <img style="margin:2% 2% 2% 2%;"id="displaycatimg" src="" height="90px" width="100px" alt="">
                                       </div>
                                       <button type="submit" class="updatecatbtn btn btn-danger pull-left" >Save changes</button>
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



 <div class="modal fade col-md-12" id="imgmodal" tabindex="-1" role="dialog" aria-labelledby="imgmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imgmodal"><strong> Select image </strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="imgbody modal-body">
   
      <div id='item'>
                  @foreach($media as $row)
                  <div style="float:left;">
                  <div id="cards"  style="border:1px solid #A9A9A9;border-radius:6px;margin-left:30px;width:170px;height:160px;display:flex;align-items:center;justify-content:center;">
                  <div class="hah123" id="non_{{$row->id}}" style="display:none">1</div>
                  <a>
                  <img class="img123 img" name="1" id='{{$row->id}}' value="{{$row->thumbnail}}" src="{{$row->thumbnail}}" alt="..." />
                  </a>

                  </div>
                  <div class="btn-primary" onclick= "window.location='{{route('detail')}}?id={{$row->id}}'" style="margin-left:30px;width:170px;height:25px;margin-bottom:20px;border-radius:6px;">
                  <center>
                  <a style="margin-top:5px;color:black;">Details</a>
                  </center>
               </div>
               </div>
            @endforeach
               </div>
      </div>
      <div class="modal-footer">
      <button id="addnewimg" style="float:left" class="btn btn-primary">Add new</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

  $('.img123').click(function(){
   $('#catimgid').val(null);
   $('#editcatimgid').val(null);
   $('.img123').css('border','none');
   var catimgid = $(this).attr('id');
   $('#catimgid').val(catimgid); //alert($('#catimgid').val());
   $('#displaycatimg').attr('src',$(this).attr('src'));
   $('#editcatimgid').val(catimgid);
  console.log(catimgid);
   $('#'+catimgid).css('border','3px solid #DC143C');
});

});
//update category
$('.updatecat').click(function(){
$('#updatecatid').val(null);
$('#editcattype').val(null);
$('#editcatname').val(null);
$('#displaycatimg').attr('src',null);
   var catid = $(this).attr('id');
   $.get("{{route('fetchcat')}}", {id:catid}, function(data){
var img = data.image;
$('#updatecatid').val(catid);
$('#editcattype').attr('placeholder',data.CategoryType);
$('#editcatname').attr('placeholder',data.CatName);
$('#displaycatimg').attr('src',img);

var query = window.location.search.substring(1);
var vars = query.split("?");
var id= vars[0];
if(id>0){
var name= vars[1];
var type= vars[2];
$('#updatecatid').val(catid);
$('#editcattype').val(type);
$('#editcatname').val(name);
window.history.pushState({}, document.title, "/" + "adminportal/category" );
}
 });

 $('#addnewimg').click(function(){

var name = $('#editcatname').val();
var type = $('#editcattype').val();
window.location.replace("http://localhost/adminportal/media?"+catid+"?"+name+"?"+type);
});
   
});

$('.updatecatbtn').click(function(){

   $('#updatecatform').on('submit', function(event){
  event.preventDefault();
  $.ajax({
    url:"{{ route('updatecat') }}",
    method:"POST",
    data: $('form').serialize(),
    dataType:"json",
    success:function(data)
    { 
    $('.name'+data.CategoryID).html(data.CatName);
    $('.type'+data.CategoryID).html(data.CategoryType);
    $('.img'+data.CategoryID).html(
      '<img  height="80" width="100" src="'+data.image+'" alt="...">'
      );
   
    }
   });});
});


});
</script>
