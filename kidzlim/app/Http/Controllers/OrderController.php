<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\subcategory;
use App\category;
use App\product;
use App\orderdetail;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $order = order::pluck('OrderID'); $data = array();
       foreach($order as $id){
          $orderdata = order::where('OrderID',$id)->first();
          $orderdata->customer;
          $data[] = $orderdata;
       }
       $data = $this->paginate($data);
       return view('admin.order',compact('data'));
    }
    public function paginate($items, $perPage = 3, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function report()
    {   $customer= order::count('CustomerID'); 
        $order= orderdetail::count('OrderDetailID'); 
        $delivered= orderdetail::where('StatusID',1)->count('OrderDetailID'); 
        $revenue= orderdetail::sum('amount'); 
         
    
//dd($order);
        return view('admin.orderreport',[
            'customer'=>$customer,
            'delivered'=>$delivered,
            'order'=>$order,
            "revenue"=>$revenue,
          ]);
    }

    public function getorder()
    {   $orderid = orderdetail::orderBy('amount','DESC')->groupBy('OrderID')->get();
        $order = array();
       $detailid = orderdetail::OrderBy('amount','DESC')->pluck('OrderDetailID');

        foreach($orderid as $Key=>$i){
             $orderdata = orderdetail::where('OrderDetailID',$i["OrderDetailID"])->first();
           //  $amount = orderdetail::where('OrderID',$orderdata['OrderID'])->max('amount');
            $cust = order::where('OrderID',$orderdata['OrderID'])->first();
           $customer =  $cust->customer->CustomerFirstName;
             $orderdata->customer = $customer;
             $orderdata->amount = $i["amount"];
             $order[] = $orderdata;
  
    }
//dd($order);
        return response()->json($order  );
    }

    public function getprd()
    { $data = array();
        $detailid = orderdetail::groupBy('ProductID')->pluck('ProductID' );
     //   $prd =  orderdetail::where("productID",7)->count();
        foreach($detailid as $id){
            $prd =  product::where("ProductID",$id)->select('ProductName as name')->first();
            $count =  orderdetail::where("ProductID",$id)->count();
          $prd->count = $count;
          $data[] = $prd;
  
    }
//dd($order);
        return response()->json($data);
    }

    public function vieworder()
    {  $id = request()->query('id'); $data=array();
        $order = orderdetail::where('OrderID',$id)->pluck('OrderDetailID');
        foreach($order as $id){
       
       $odata = orderdetail::where('OrderDetailID',$id)->select('OrderDetailID as id','ProductID as productid','yard','quantity','amount as totalamount','OrderDate as date','StatusID as status')->first();//updated by hina, May 6, 7:29pm
       $prddata =  orderdetail::where('OrderDetailID',$id)->first();
       $prdid = $prddata->product->ProductID;
       $name =  $prddata->product->ProductName;
       $img =  $prddata->product->Image;
       $price =  $prddata->product->ProductPrice;
       $subcatid = $prddata->product->SubCatID;
                $catid = subcategory::where('SubCatID',$subcatid)->pluck('CategoryID');
                $catname= category::where('CategoryID',$catid[0])->pluck('CategoryType'); 
                $odata->category = $catname[0];
       $odata->image = $img;
       $odata->price = $price;
       $odata->name = $name;
           if($prddata->color)
           $color = $prddata->getcolor->Color;
           else
           $color =null;
           if($prddata->size)
           $size = $prddata->getsize->Size;
           else
           $size = null;
            $odata->color = $color;
             $odata->size = $size;//update ended by hina, thus 7, 6:24pm                                                   
         $data[] = $odata;                                      
    }
       return view('admin.vieworder',['data'=>$data]);
    }

    public function getorderdate()
    { $data = orderdetail::all();
        return response()->json($data);
    }

}
