@extends('layouts.index')
@section('title')
          Order
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
                                 <h4>Order details</h4>
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
                           <div style ="margin-top:2%"class="table-responsive">
                              <table   id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr  class="info">
                                    <th>#Reciept</th>
                                    <th>Image</th>
                                       <th>Product</th>
                                       <th>Category</th> 
                                       <th>Color</th>
                                       <th>Yard</th>
                                       <th>Size</th>
                                       <th>Date</th>
                                       <th>Quantity</th>
                                       <th>Price</th>
                                       <th>Total</th>
                                       <th>Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($data as $row)
                                    <tr class='order{{$row->OrderDetailID}}'>
                                    <td>{{$row->id}}</td>
                                   <td> <img height="90px" width="100px" src="{{$row->image}}" alt=""></td>
                                   <td>{{$row->name}}</td>
                                   <td>{{$row->category}}</td>
                                    <td><h1 class="color"style="float:left;margin:2% 2% 2% 2%;background-color:{{$row->color}};height:20px;width:20px;border-radius:50px"></h1></td>
                                    <td>{{$row->yard}}</td>
                                    <td>{{$row->size}}</td>
                                    <td>{{$row->date}}</td> 
                                    <td>{{$row->quantity}}</td>
                                    <td>{{$row->price}}</td>
                                    <td>{{$row->totalamount}}</td>
                                    @if($row->status == 1)
                                    <td><a href="#" class="label-success label label-default" >Delivered</a>
                                    @else
                                    <td><a class="label-warning label label-default" >Pending</a>
                                    @endif
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
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


@endsection