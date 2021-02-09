
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
                           <h3>View Inventory</h3>
                          </div>
                            </div>

                <div class="panel-body">
                
                                


<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
}
th, td {
  padding: 5px;
}
th {
  text-align: center;
}
</style>
</head>
<body>

<h2>Inventory Details</h2>

<table style="width:100%">
  <tr>
  <th>SKUcode</th>

    <th>Product</th>
    <th>Stock</th> 
    <th>Price</th>
    <th>Total Purchase Price</th>
    <th>Min Level</th>
    <th>Max Level</th>
    
    <th>Status</th>
  </tr>

  @foreach($array as $row)
 
  <tr>
  <td>{{$row->SKUcode}}</td>

  <td>{{$row->product['ProductName']}}</td>
  <td>{{$row->Stock}}</td>
 
  <td>${{$row->Purchaseprice}}</td>
  <td>{{$row->Minlvl}}</td>
  <td>{{$row->Maxlvl}}</td>
  

  <td><?php if(($row->Stock)>($row->Maxlvl)){
            echo "Overstock";
            }
            elseif(($row->Stock)<($row->Minlvl)){
              echo "Understock";
            }
            else{
              echo ((($row->Stock)/($row->Maxlvl))*100);
              echo "%";
              
            }
         
            ?></td>

</tr>
  @endforeach


 
</table>

</body>




@endsection