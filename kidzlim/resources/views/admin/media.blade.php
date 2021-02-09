@extends('layouts.index')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">
   
@section('title')
          Media
@endsection

@section('content')
<style>

#cards{
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}

.img:hover{
border:3px solid 	#DC143C;
}
</style>

<script>

function go(){
   @foreach($media as $row)
   document.getElementById('non_'+{{$row->id}}).innerHTML=2;
   @endforeach  
   $('.img123').css('border','3px solid #DC143C');
}

function deletes(){
   @foreach($media as $row)
   k={{$row->id}};
   l=document.getElementById('non_'+k).innerHTML;
   if(l==2){
      $.ajax({
     type: "POST",
     data: {"_token": $('meta[name="csrf-token"]').attr('content'),
     id:k,
     },
     url: "{{route('delete')}}",
     success: function(msg){
     }
     });
   }
   @endforeach  
   
   $("#item").fadeOut();
var loadname="{{route('imageshow')}}";

setTimeout(function(){
      $('#item').load(loadname).fadeIn();
}, 500);
}

function dont(){
   @foreach($media as $row)
   document.getElementById('non_'+{{$row->id}}).innerHTML=1;
   @endforeach  
   $('.img123').css('border','none');
}


$(document).ready(function(){
   $('.return').hide();
   var query = window.location.search.substring(1);
var vars = query.split("?");
var id= vars[0];
var name= vars[1];
var type= vars[2];
   if(id)
   $('.return').show();

  $('.img123').click(function(){
   k=$(this).attr('id');
   j=document.getElementById('non_'+k).innerHTML;
   if(j==1){
   $('#'+k).css('border','3px solid #DC143C');
   document.getElementById('non_'+k).innerHTML=2;
   }
   else{
   $('#'+k).css('border','none');
   document.getElementById('non_'+k).innerHTML=1;   
   }
});
$('.return').click(function(){
   if(id=="prd")
   window.history.back();
   else
   window.location.replace("http://localhost/adminportal/category?"+id+"?"+name+"?"+type);
});
});

</script>
<div class="row">
<div class="col-sm-12">
   <div class="panel panel-bd lobidrag">
      <div class="panel-heading">
         <div class="panel-title">
            <h4>Media files</h4>
            </div>
         </div>
         <div class="panel-body">
         <button class="return btn-primary">Return</button>
            <div style="margin-left:2%;margin-bottom:2%;" class="row">
            <button style="margin-left:670px;" onclick="dont()" class="btn-sm btn-primary">UnSelect all</button> 
               <button  class="btn-sm btn-success" onclick="go()">Select All</button>
               <button onclick="deletes()" class="btn-sm btn-danger">Delete</button>
               <button data-toggle="modal" data-target="#add"class="btn-sm btn-warning">Add new</button>
               
               <br><br >
               <div id='item'>
                  @foreach($media as $row)
                  <div style="float:left;">
                  <div id="cards"  style="border:1px solid #A9A9A9;border-radius:6px;margin-left:30px;width:170px;height:160px;display:flex;align-items:center;justify-content:center;">
                  <div class="hah123" id="non_{{$row->id}}" style="display:none">1</div>
                  <a>
                  <img class="img123 img" name="1" id='{{$row->id}}' src="{{$row->thumbnail}}" alt="..." />
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
         </div>   
      </div>
   </div>
</div>
</div>
@endsection


<!-- Modal -->


<style>
#drop_zone{
   background-color:#EEE;
   border: #999 2px dashed;
   width:550px;
   height:200px;
   padding:8px;
   font-size:10px;
}

</style>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" style="margin-top:100px" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="margin-top:5px;" >
        <h5 class="modal-title" id="exampleModalLongTitle" style="font-weight:bold;">Add Media Files</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      
      <div class="modal-body" style="margin-bottom:10px">
      
      
      <label for="cars">Type of Image : </label>

         <select name="cars"  onchange="dow(this)" id="cars">
            <option value="icon">Icon</option>
            <option value="category">Category</option>
            <option value="SubCategory">SubCategory</option>
         </select>
     
      <p style="margin-bottom:5px;">Click or Drop Images in the Box for Upload.</p>
     <div id="1" style="display:block">
     <form action="{{route('addmedia1')}}" name="file" class="dropzone" id="my-awesome-dropzone"> @csrf 
     </form>
      </div>

      <div id="2" style="display:none">
     <form action="{{route('addmedia2')}}" name="file" class="dropzone" id="my-awesome-dropzone"> @csrf 
     </form>
      </div>
      
      <div id="3" style="display:none">
   
   <form action="{{route('addmedia3')}}" name="file" class="dropzone" id="my-awesome-dropzone"> @csrf 
     </form>
      </div>

      </div>
      <div class="modal-footer">
      
        <button type="button" onclick="closeit()" class="btn btn-secondary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>
<script>
function dow(faf){
var ana=faf.value;

if(ana=='icon'){
$('#1').css('display','block');
$('#2').css('display','none');
$('#3').css('display','none');
}
if(ana == 'category'){
   $('#1').css('display','none');
   $('#3').css('display','none');

   $('#2').css('display','block');
}
if(ana== 'SubCategory'){
   $('#1').css('display','none');
   $('#2').css('display','none');
   $('#3').css('display','block');
}
}
function closeit(){
  
$("#item").fadeOut();
var loadname="{{route('imageshow')}}";

setTimeout(function(){
      $('#item').load(loadname).fadeIn();
}, 500);

}

</script>

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.js"></script>

@endsection