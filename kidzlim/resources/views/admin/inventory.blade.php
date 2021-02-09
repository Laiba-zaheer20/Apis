@extends('layouts.index')
@section('title')
          Inventory
@endsection

@section('content')
<div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                           <h3>Add Inventory</h3>
                          </div>
                            </div>

                <div class="panel-body">
                <h4>Add Stock</h4>
                                
                  <div style="margin-left:50%;margin-bottom:2%;"" class="row">

                  <div><label>Min Level</label> <input id='min' type='text'></div>
                  <br>  
                  <div><label>Max Level</label> <input id='max' type='text'></div>        
                  
                  </div>
               
                <div style="margin-left:2%;margin-bottom:2%" class="row">
                <div class="col-md-4 form-group">
                   <label class="control-label">Products</label>
                <input type="text" list="find" placeholder="search Product..." name="searchsubcat" id="searchsubcat" class="form-control">
                        <datalist id="find">
                          </datalist>
                                         
                                     </div>
                        <!-- <label for='prod'>Products</label>
                        <select id='prod' >
                            <option value="0">Choose Product</option>
                            @foreach($data as $prod)
                          
                      
                            <option value="{{$prod->ProductID}}">{{$prod->ProductName}}</option>
                            @endforeach
                        </select> -->
                        <div><input id="hidden" type="hidden"></div>
                        <br>
                  <br>
                  <br>
                  <br>
                    <label >Current Stock</label>
                 
                    <div id='cstock'></div> 
                   
                  <br>
                  <br>
                  <label >Price</label>
                      <div id='price'></div>
                      <br>
                        <label >Total Purchase Price</label>
                      <div id='tprice'></div>
                  <br>
                  <br>
                  <div><label>Enter Stock</label> <input id='newstock' type='text'></div>
                  <br>
                  <div><label>Purchase Price</label> <input id='newprice' type='text'></div>
                 
                  <div class="text-center" >
                  <input  id='btn' class="btn btn-primary mx-auto d-block" type='button' value='Add Stock'></input>
                  <br><br>
                  <div id="result" style="font-size:20px;color:green" ></div>
                  </div>
                 </div>
                
                 </div>



 </div></div></div>

@endsection

  
 
    <script

src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>

$(document).ready(function(){
  $('#searchsubcat').keyup(function(){
  
  var name = $('#searchsubcat').val();
$.post('searchsubcat',{name : name,  "_token": "{{ csrf_token() }}",},function(data){
$('#find').html(data);
});

});

$('#searchsubcat').focus(function(){
 
 var name = $('#searchsubcat').val();
$.post('searchsubcat',{name : name,  "_token": "{{ csrf_token() }}",},function(data){
$('#find').html(data);
});

});
//  $.ajaxSetup({
//   headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   }
// });
 
$('#btn').click(function(){
  var newstock= $('#newstock').val();
   var newprice= $('#newprice').val();
  var max= $('#max').val();
   var min= $('#min').val();
  
  
 var proid=$('#hidden').val();
  if(proid){
    $.get('add',{id:proid,newstock:newstock,newprice:newprice,max:max,min:min},function(data){
        
      $('#result').html("Stocks added");
        $('#cstock').html(data[0]);
        $('#tprice').html(data[1]);
          $('#min').val(data[2]);
        $('#max').val(data[3]);
        $('#price').html(data[4]);
        $('#newstock').val('');
        $('#newprice').val('');


 
      });
   }
 });
 
    $('#searchsubcat').on('change', function(){
    
      var proid=$(this).val();
     
      if(proid){
        $.get('find',{id:proid},function(data){
              
          $('#cstock').html(data[0]);
          $('#tprice').html(data[1]);
          $('#min').val(data[2]);
        $('#max').val(data[3]);
        $('#price').html(data[4]);
        $('#hidden').val(data[5]);
        
        });
  }
  
});
});
</script>