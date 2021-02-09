<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repo\categoryrepository;
class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     $data =new data;
        return view('admin.category',["data"=>$data->getcat()]);
       
    //   dd($maxsubcatid);
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
        $data = new data;
        $data->addcat($request->all());
       return response()->json("success"); 
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

    public function getbooks(Request $request){
     
     $cat=new categoryrepository;
     return $cat->findById($request->id);

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
    public function update(Request $request)
    {  
        $cat=new categoryrepository;
        return $cat->update($request);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {   $id = request()->query('id');
          $cat = new data;
          $cat->delcat($id);
         return response()->json("success");
    }
   
    public function addcat(){
           $data = new data;
      return view('admin.add',["data"=>$data->getcat()]);
    }

}
