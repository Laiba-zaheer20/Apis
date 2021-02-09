
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

        <p style="color:grey;font-weight:bold;margin-left:3%">To add data of specific item, you must select form type</p>
                        <div style="margin-left:3%"class="col-md-3">
                                          <label class="control-label">Form Type</label>
                                          <select placeholder="Item type" id="formtype"class="form-control">
                                          <option value="1">Category</option>
                                          <option value="2">Cover</option>
                                          <option value="3">Pages</option>
                                          </select>
                                       </div>
            <div class="col-md-12">
                <form id="itemform"action="{{route('updatecat')}}"style="margin-left:3%;margin-top:2%"class="form-horizontal" method="post" enctype="multipart/form-data" >
                @csrf
                <fieldset id="addcat">
                    <!-- Text input-->
                    
                    <p style="color:grey;font-weight:bold">Enter data to add category...</p>
                    <!-- Text input-->
                    <div class="col-md-6 form-group">
                        <label class="control-label">Name</label>
                        <input type="text" placeholder="Enter category name" id='catname'name="catname" class="form-control">
                    </div>
                    <div class="col-md-12 form-group">
                        <!-- <label class="control-label">Image</label><br> -->
                        <input type="hidden" name="img" id="img">
                        <a href="#imgmodal" data-toggle="modal" data-target="#imgmodal"class="img btn-sm btn-primary" >Add image</a>
                    </div>
                    <div class="col-md-12 form-group user-form-group">
                        <div class="pull-right">
                            <button type="button" class=" btn btn-danger btn-sm"  data-dismiss="modal">Cancel</button>
                            <button type="submit" class="addcatbtn btn btn-add btn-sm">Save</button>
                        </div>
                    </div>
                </fieldset>


                <fieldset id="addsubcat">
                <p style="color:blue;font-weight:bold">Enter data to add subcategory...</p>
                    <div class="col-md-6 form-group">
                    <label class="control-label">Select category</label>
                        <input type="text" list="findcat" placeholder="search category..." name="searchcat" id="searchcat" class="form-control">
                        <datalist id="findcat">
                
                        </datalist>
                    </div>
                    <!-- Text input-->
                    <div class="col-md-6 form-group">
                        <label class="control-label">Type</label>
                        <input type="text" placeholder="Enter Subcategory type" id="subcattype" name="subcattype" class="form-control">
                    </div>
                    <div class="col-md-12 form-group user-form-group">
                        <div class="pull-right">
                            <button type="button" class="btn btn-danger btn-sm"  data-dismiss="modal">Cancel</button>
                            <button type="submit" class="savecat btn btn-add btn-sm">Save</button>
                        </div>
                    </div>
                </fieldset>


                <fieldset id="addprd">
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
                        <div class="pull-right">
                            <button type="button" class="btn btn-danger btn-sm"  data-dismiss="modal">Cancel</button>
                            <button type="" class="btn btn-add btn-sm">Save</button>
                        </div>
                    </div>
                </fieldset>
                </form>
            </div>
        </div>
@endsection
@section('script')
<script>
$(document).ready(function(){
//form switch
$("#addsubcat").hide();
   $("#addprd").hide();
$("#formtype").on('change',function(){
var form = $("#formtype").val();
if(form == 1)
{
   $("#addcat").show();
   $("#addsubcat").hide();
   $("#addprd").hide();
}
else if(form == 2)
{
   $("#addsubcat").show();
   $("#addcat").hide();
   $("#addprd").hide();
}
else if(form == 3)
{
   $("#addprd").show();
   $("#addsubcat").hide();
   $("#addcat").hide();
} 
});    
  $('#itemform').on('submit', function(event){
  event.preventDefault(); 
   $.ajax({
    url:"{{ route('updateitem') }}",
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
});
</script>
@endsection