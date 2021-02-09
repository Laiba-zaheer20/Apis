
 @extends('layouts.index')
 @section('title')
   Add form
 @endsection                        
        @section('content')
        <style>
img{
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
border-radius:10%;
}
.color, .btn-sm{
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

}
</style>
        <div class="row">

        <p style="color:grey;font-weight:bold;margin-left:4%">To add data of specific item, you must select form type</p>
                        <div style="margin-left:4%"class="col-md-4">
                                          <label class="control-label">Form Type</label>
                                          <select id="formtype"class="form-control">
                                          <option value="1">Category</option>
                                          <option value="2">Book</option>
                                          <option value="3">Pages</option>
                                          </select>
                                       </div>
            <div class="col-md-12">
               
                <fieldset id="1">
                    <!-- Text input-->
                    <form id="catform"action="{{route('addcat')}}"style="margin-left:3%;margin-top:2%"class="form-horizontal" method="post" enctype="multipart/form-data" >
                         @csrf
                    <p style="color:grey;font-weight:bold">Enter data to add category...</p>
                    <!-- Text input-->
                    <div class="col-md-6 form-group">
                        <label class="control-label">Name</label>
                        <input type="text" placeholder="Enter category name" id='catname'name="name" class="form-control">
                    </div>
                    <div class="col-md-12 form-group">
                        <!-- <label class="control-label">Image</label><br> -->
                        <input type="hidden" name="image" id="catimage" value="http://www.desktopimages.org/pictures/2014/0722/1/orig_8851.jpg">
                        <a href="#imgmodal" data-toggle="modal" data-target="#imgmodal"class="img btn-sm btn-primary" >Add image</a>
                    </div>
                    <div class="col-md-12 form-group user-form-group">
                        <div style="margin-top:2%"class="pull-left">
                            <button type="button" class=" btn btn-danger btn-sm"  data-dismiss="modal">Cancel</button>
                            <button type="submit" class="addcatbtn btn btn-add btn-sm">Save</button>
                        </div>
                    </div>
                </form>
                </fieldset>


                <fieldset id="2">
                <form id="bookform"action="{{route('addbook')}}"style="margin-left:3%;margin-top:2%"class="form-horizontal" method="post" enctype="multipart/form-data" >
                         @csrf
                <p style="color:grey;font-weight:bold">Enter data to add book...</p>
                    <div class="col-md-12 form-group">
                    <label class="control-label">Select category</label><br>
                        @foreach($data as $row)
                        <h4><input type="checkbox" name="catid[]"  class="bookcat{{$row->id}}" value = "{{$row->id}}" > {{$row->name}}</h4>
                         @endforeach
                    </div>
                    <!-- Text input-->
                    <div class="col-md-6 form-group">
                        <label class="control-label">Title</label>
                        <input type="text" placeholder="Enter book title" id="title" name="title" class="form-control">
                    </div>
                    <div class="col-md-12 form-group">
                        <!-- <label class="control-label">Image</label><br> -->
                        <input type="hidden" name="image" value = "http://www.desktopimages.org/pictures/2014/0722/1/orig_8851.jpg" id="bookimg">
                        <a href="#imgmodal" data-toggle="modal" data-target="#imgmodal"class="img btn-sm btn-primary" >Add image</a>
                    </div>
                    <div class="col-md-12 form-group user-form-group">
                        <div style="margin-top:2%"class="pull-left">
                            <button type="button" class="btn btn-danger btn-sm"  data-dismiss="modal">Cancel</button>
                            <button type="submit" class="savecat btn btn-add btn-sm">Save</button>
                        </div>
                    </div>
                    </form>
                </fieldset>


                <fieldset id="3">
                <form id="pageform"action=""style="margin-left:3%;margin-top:2%"class="form-horizontal" method="post" enctype="multipart/form-data" >
                         @csrf
                <p style="color:blue;font-weight:bold">Enter data to add product...</p>
                    <!-- Text input-->
                    <div class="col-md-6 form-group">
                        <label class="control-label">Subcategory</label>
                        <input type="text" list="find" placeholder="search subcategory..." name="searchsubcat" id="searchsubcat" class="form-control">
                        <datalist id="find">
                
                        </datalist>
                        
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label">Product Name</label>
                        <input type="text" name="prdname"placeholder="Enter product name" class="form-control">
                    </div>
                    <!-- Text input-->
                    
                    <div id="colorinput"class="col-md-6 form-group">
                        <label class="control-label">color</label>
                        <input id="color"type="color"name="color" placeholder="Enter color" class="form-control">
                        <div  style="margin:2% 2% 2% 2%;"id="show" class=" btn btn-sm btn-warning"><i class="fa fa-plus"></i></div>
                        <div  style="margin:2% 2% 2% 2%;"id="minus" class=" btn btn-sm btn-danger"><i class="fa fa-minus"></i></div>
                        <div id="insertcolor"></div>
                        <input type="hidden" name="colorarray" id="colorarray">
                        <small> click the added color to remove it</small>
                    </div>
                    <div id="sizeinput"class="col-md-6 form-group">
                        <label class="control-label">Size</label>
                        <input id="size" type="text" name="size" placeholder="Enter size" class="form-control">
                        <div  style="margin:2% 2% 2% 2%;"id="sizeshow" class=" btn btn-sm btn-warning"><i class="fa fa-plus"></i></div>
                        <div  style="margin:2% 2% 2% 2%;"id="sizeminus" class=" btn btn-sm btn-danger"><i class="fa fa-minus"></i></div>
                        <div id="insertsize"></div>
                        <input type="hidden" name="sizearray" id="sizearray">
                        <small> click the added size to remove it</small>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label">Price</label>
                        <input type="number" placeholder="Enter price" name="price"class="form-control">
                    </div>
                    <div class="col-md-3  form-group">
                        <label class="control-label">Yard min</label>
                    <input type="number"  placeholder="Minimum" name="min"class="form-control">
                
                    </div>
                    <div class="col-md-3  form-group">
                        <label class="control-label">Yard max</label>
                        <input type="number"  placeholder="Maximum" name="max"class="form-control ">
                
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="control-label">Description</label><br>
                        <input type="text" class="form-control" name="desc" >
                    </div>
                    <div class="col-md-12 form-group">
                        
                        <a href="#imgmodal" data-toggle="modal" data-target="#imgmodal"class="img btn-sm btn-primary" >Add image</a>
                    </div>
                    <div class="col-md-12 form-group user-form-group">
                        <div class="pull-left">
                            <button type="button" class="btn btn-danger btn-sm"  data-dismiss="modal">Cancel</button>
                            <button type="" class="btn btn-add btn-sm">Save</button>
                        </div>
                    </div>
                    </form>
                </fieldset>
                </form>
            </div>
        </div>
@endsection
@section('script')
<script>
$(document).ready(function(){
//form switch
$("#2").hide();
   $("#3").hide();
$("#formtype").on('change',function(){
var form = $("#formtype").val();
if(form == 1)
{
   $("#1").show();
   $("#2").hide();
   $("#3").hide();
}
else if(form == 2)
{
   $("#2").show();
   $("#1").hide();
   $("#3").hide();
}
else if(form == 3)
{
   $("#3").show();
   $("#2").hide();
   $("#1").hide();
} 
});    
  $('#catform').on('submit', function(event){
  event.preventDefault(); 
   $.ajax({
    url:"{{ route('addcat') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    { alert('success');
    }
   });
});

   $('#bookform').on('submit', function(event){
  event.preventDefault(); 

   $.ajax({
    url:"{{ route('addbook') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    { alert(data);
    }
   });

});
});
</script>
@endsection