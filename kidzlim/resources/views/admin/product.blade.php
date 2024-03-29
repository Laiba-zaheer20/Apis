@extends('layouts.index')
@section('title')
          Product
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
.color, .btn-sm{
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
                                 <h4>Product details</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <form class="row"action="{{route('filterprd')}}">
                        <div class=" col-md-4 form-group">
                           <input type="text"  placeholder="search..." name="searchprd" id="searchprd" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        <a href="product"class="btn btn-info"><i class="fa fa-refresh" ></i></a>
                        </form>
                        <div id="table_data">
                        @include('admin.prdtable')
                        </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- items Modal1 -->
               <div class="modal fade" id="delprd" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-trash"></i> Delete Product</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                         Are you sure you want to delete this item?
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="delprdbtn btn btn-danger pull-left" >yes</button>
                           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                     <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->
              <!-- Modal -->
             
              <div class="modal fade" id="updateprd" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-edit"></i> Update product</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                              
                              <form id='updateprdform' action="{{route('updateprd')}}" method="post" enctype="multipart/form-data">
                                @csrf  
                               <input type="hidden" id="prdid"name="ProductID">
                                <div class="col-md-6 form-group">
                                          <label class="control-label">Subcategory</label>
                                          <input type="text" list="find" placeholder="search subcategory..." name="subcat" id="subcat" class="form-control">
                                          <datalist id="find">
                                          </datalist>
                                         
                                     </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Product Name</label>
                                          <input type="text"id ="prdname" name="ProductName"placeholder="Enter product name" class="form-control">
                                       </div>
                                       <!-- Text input-->
                                      
                                       <div id="colorinput"class="col-md-6 form-group">
                                          <label class="control-label">color</label>
                                          <input id="color"type="color"name="color" placeholder="Enter color" class="form-control">
                                          <div  style="margin:2% 2% 2% 2%;"id="show" class=" btn btn-sm btn-warning"><i class="fa fa-plus"></i></div>
                                          <div  style="margin:2% 2% 2% 2%;"id="minus" class=" btn btn-sm btn-danger"><i class="fa fa-minus"></i></div>
                                          <div id="insertcolor"></div>
                                          <input type="hidden" name="colorarray" id="colorarray"><br>
                                          <small> click the added color to remove it</small>
                                       </div>
                                       <div id="sizeinput"class="col-md-6 form-group">
                                          <label class="control-label">Size</label> 
                                          <input id="size" type="text" name="size" placeholder="Enter size" class="form-control">
                                          <div  style="margin:2% 2% 2% 2%;"id="sizeshow" class=" btn btn-sm btn-warning"><i class="fa fa-plus"></i></div>
                                          <div  style="margin:2% 2% 2% 2%;"id="sizeminus" class=" btn btn-sm btn-danger"><i class="fa fa-minus"></i></div>
                                         <div id="insertsize"></div>
                                          <input type="hidden" name="sizearray" id="sizearray"><br>
                                          <small> click the added size to remove it</small>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Price</label>
                                          <input type="number" placeholder="Enter price" id="price"name="ProductPrice"class="form-control">
                                       </div>
                                       <div class="col-md-3  form-group">
                                          <label class="control-label">Yard min</label>
                                        <input type="number"  id="min" name="Min"class="form-control">
                                   
                                       </div>
                                       <div class="col-md-3  form-group">
                                          <label class="control-label">Yard max</label>
                                          <input type="number"  id="max" name="Max"class="form-control ">
                                   
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Description</label><br>
                                          <input type="text" class="form-control" id="desc" name="Description" >
                                       </div>
                                       <div class="col-md-12 form-group">
                                       <input type="hidden" name="imgid" id="imgid">
                                          <img style="margin:2% 2% 2% 2%;"id="displayprdimg" src="" height="90px" width="100px" alt="">
                                          <a href="#imgmodal" data-toggle="modal" data-target="#imgmodal"class="img btn-sm btn-primary" >Add image</a>

                                       </div>
                                       <button type="submit" class="updateprdbtn btn btn-danger pull-left" >Save changes</button>
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
      <a href="media?prd" id="addnewimg" style="float:left" class="btn btn-primary">Add new</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
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
   url:"/adminportal/product/fetch_data?page="+page,
   success:function(data)
   {
    $('#table_data').html(data);
    
   }
  });
 }



 $('.img123').click(function(){
   $('#imgid').val(null);
   $('.img123').css('border','none');
   var imgid = $(this).attr('id');
   $('#imgid').val(imgid); //alert($('#catimgid').val());
   $('#displayprdimg').attr('src',$(this).attr('src'));
  console.log(imgid);
   $('#'+imgid).css('border','3px solid #DC143C');
});

   function removeElement(array, elem) {
    var index = array.indexOf(elem);
    if (index > -1) {
        array.splice(index, 1);
    }
}
   var color = [];
   //addcolor
 $('#show').click(function(){
 var newcolor = $('#color').val();
 color.push(newcolor);
 $('#colorarray').val(color);
 $('#insertcolor').append(
 '<div class="color btn-sm" value="'+newcolor+'" id="display" style="float:left;margin:2% 2% 2% 2%;background-color:'+newcolor+';height:20px;width:20px;border-radius:50px"></div>'
 );
 $('.color').click(function(){
   removeElement(color,$(this).attr('value'));
   console.log(color);
   $(this).remove();
 });
console.log($('#colorarray').val());

 });

//add size
var size = [];
 $('#sizeshow').click(function(){
 var newsize = $('#size').val(); 
 size.push(newsize);
 $('#sizearray').val(size);
 $('#insertsize').append(
 '<div class="size btn" id="'+size+'" style="font-weight:bold;float:left;height:20px;width:100px;border-radius:20px">'+newsize+'</div>'
 );

 $('.size').click(function(){
   removeElement(size,$(this).html());
   console.log(size);
   $(this).remove();
 });
console.log($('#sizearray').val());

 });

//remove color
 $('#minus').click(function(){
 color = [];
 $('#colorarray').val(color);
 $('#insertcolor').empty();
console.log($('#colorarray').val());

 });
//remove size
 $('#sizeminus').click(function(){
 size = [];
 $('#sizearray').val(size);
 $('#insertsize').empty();
console.log($('#sizearray').val());

 });

   $('.prddel').click(function(){
 var delid = $(this).attr('id');     // alert(delid);
 $('.delprdbtn').click(function(){
   $(".prd" + delid).remove();
   $.get("{{route('delprd')}}", {id:delid}, function(data){
  //   alert(data);
  });
 });
   
});

$('#searchsubcat').keyup(function(){
  
  var name = $('#searchsubcat').val();
$.post('searchsubcat',{name : name,  "_token": "{{ csrf_token() }}",},function(data){
$('#find').html(data);
});

});
//search subcategory

 var name = $('#searchsubcat').val();
$.post('searchsubcat',{name : name,  "_token": "{{ csrf_token() }}",},function(data){
$('#find').html(data);
});

$('.updateprd').click(function(){  
   $('#insertcolor').empty();
   $('#insertsize').empty();
   $('#min').empty();   
   $('#min').empty();
 var prdid = $(this).attr('id');
   $.get("{{route('fetchprd')}}", {id:prdid}, function(data){
    
var img = data.Image;
$('#prdid').val(prdid);
$('#prdname').attr('placeholder',data.ProductName);
$('#price').attr('placeholder',data.ProductPrice);
$('#desc').attr('placeholder',data['description'].Description);
$('#subcat').attr('placeholder',data['subcategory'].SubCatType);
$('#displayprdimg').attr('src',img);
var color = [];
if(data['color'].length){
   for(var i =0; i<data['color'].length; i++){
      color.push(data['color'][i].Color);
      $('#colorarray').val(color);
      $('#insertcolor').append(
         '<div class="color btn-sm" value="'+data['color'][i].Color+'" id="display" style="float:left;margin:2% 2% 2% 2%;background-color:'+data['color'][i].Color+';height:20px;width:20px;border-radius:50px"></div>'
 );}console.log(color);
}
var size = [];
if(data['size'].length){console.log(data['Size']);
   for(var i =0; i<data['size'].length; i++){ 
      size.push(data['size'][i].Size);
      $('#sizearray').val(size);
      $('#insertsize').append(
         '<div class="size btn" id="'+data['size'][i].Size+'" style="font-weight:bold;float:left;height:20px;width:100px;border-radius:20px">'+data['size'][i].Size+'</div>'
 );}console.log(size);
}

if(data['yard'])
$('#min').attr('placeholder',data['yard'].Min);
if(data['yard'])
$('#max').attr('placeholder',data['yard'].Max);
 });
   
});
$('.updateprdbtn').click(function(){
  
   $('#updateprdform').on('submit', function(event){
  event.preventDefault();
  $.ajax({
    url:"{{ route('updateprd') }}",
    method:"POST",
    data: $('form').serialize(),
    dataType:"json",
    success:function(data)
    { 
    alert(data.name);
    $('.name'+data.ProductID).html(data.name);
    $('.price'+data.ProductID).html(data.price);
    $('.desc'+data.ProductID).html(data.desc);
    $('.subcat'+data.ProductID).html(data.subcat);
    $('.img'+data.ProductID).html(
      '<img  height="100" width="100" src="'+data.img+'" alt="...">'
    );
    if(data.min)
     $('.yard'+data.ProductID).html('Min: '+data.min+', Max: '+data.max);
     if(data['sizearr'].length){
       $('.size'+data.ProductID).empty();
       for(var i=0; i<data['sizearr'].length; i++){
    $('.color'+data.ProductID).append(
      '<div class="color btn-sm" value="'+data['sizearr'][i]+'" id="display" style="float:left;margin:2% 2% 2% 2%;background-color:'+data['sizearr'][i]+';height:20px;width:20px;border-radius:50px"></div>');
    }
    }
    if(data['colorarr'].length>0){
       $('.color'+data.ProductID).empty();
       for(var i=0; i<data['colorarr'].length; i++){
    $('.color'+data.ProductID).append(
      '<div class="color btn-sm" value="'+data['colorarr'][i]+'" id="display" style="float:left;margin:2% 2% 2% 2%;background-color:'+data['colorarr'][i]+';height:20px;width:20px;border-radius:50px"></div>');
    }
    }
    }
   });});
});

});
</script>
@endsection