<div  style ="margin-top:2%"class="table-responsive">
                              <table   id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr  class="info">
                                       <th>Image</th>
                                       <th>Name</th>
                                       <th>Subcategory</th>
                                       <th>Color</th>
                                       <th>size</th>
                                       <th>yard</th>
                                       <th>Description</th>
                                       <th>Price</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($data as $row)
                                    <tr class='prd{{$row->ProductID}}'>
                                       <td class='img{{$row->ProductID}}'><img  height="100" width="100" src="{{$row->Image}}" alt="..."></td>
                                       <td class="name{{$row->ProductID}}" >{{$row->ProductName}}</td>
                                       <td class="subcat{{$row->ProductID}}" >
                                       {{$row->subcategory['SubCatType']}} <br>
                                       </td>
                                       <td class="color{{$row->ProductID}}" >
                                       @foreach($row->color as $i)
                                      <h1 class="color"style="float:left;margin:2% 2% 2% 2%;background-color:{{$i->Color}};height:20px;width:20px;border-radius:50px"></h1>
                                       @endforeach
                                       </td>
                                       <td class="size{{$row->ProductID}}"  >
                                       @foreach($row->size as $i)
                                       - {{$i->Size}} <br>
                                       @endforeach
                                       </td>
                                       <td class="yard{{$row->ProductID}}"  >
                                       @if(!$row->yard == null)
                                      {{ 'Min: '.$row->yard['Min']}} <br>
                                      {{ 'Max: '.$row->yard['Max']}}
                                       @endif
                                       </td>
                                       <td class="desc{{$row->ProductID}}" >{{$row->desc}}</td>
                                       <td class="price{{$row->ProductID}}" >{{$row->ProductPrice}}</td>
                                       <td>
                                      <a href="#updateprd" id='{{$row->ProductID}}' data-toggle="modal" data-target="#updateprd"class="updateprd btn-sm btn-warning" ><i class="fa fa-edit"></i></a>
                                       <a href="#delprd" id='{{$row->ProductID}}' data-toggle="modal" data-target="#delprd"class="prddel btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        
                           {!!  $data->render()!!}


  <script>
$(document).ready(function(){



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
                          
                          