<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\mediafile;
use App\mediasize;
use Image;
use Illuminate\Support\Facades\File;
class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $media = mediafile::all();
       return view('admin.media', ['media'=> $media]);
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
    public function store1(Request $request)
    {  
        $image=$request->file('file');

        $size= mediasize::find(1)->first();
        if($image){
      
           $name = time() . '.' . $image->getClientOriginalExtension();
           $path = base_path('/mediafiles/');
           $image->move($path,$name);
           
           $media = new mediafile();
           $media->image = 'http://localhost/adminportal/mediafiles/'.$name;
           $media->name = $image->getClientOriginalName();

           $thumbnail=Image::make(base_path('/mediafiles/'.$name))->resize($size->icon_width, $size->icon_height)->save(base_path('/thumbnailfiles/'.$name));
           
           $media->thumbnail = 'http://localhost/adminportal/thumbnailfiles/'.$name;
           $media->type='icon';
           $media->save();
        
        }

        return 'go';
    }

    public function store2(Request $request)
    {  
        $image=$request->file('file');

        $size= mediasize::find(1)->first();
        if($image){
      
           $name = time() . '.' . $image->getClientOriginalExtension();
           $path = base_path('/mediafiles/');
           $image->move($path,$name);
           
           $media = new mediafile();
           $media->image = 'http://localhost/adminportal/mediafiles/'.$name;
           $media->name = $image->getClientOriginalName();

           $thumbnail=Image::make(base_path('/mediafiles/'.$name))->resize($size->thumb_width,$size->thumb_height)->save(base_path('/thumbnailfiles/'.$name));
           $media->thumbnail = 'http://localhost/adminportal/thumbnailfiles/'.$name;
           
           $thumbnail=Image::make(base_path('/mediafiles/'.$name))->resize($size->med_width, $size->med_height)->save(base_path('/smallfiles/'.$name));
           $media->SmallImage = 'http://localhost/adminportal/smallfiles/'.$name;
           
           $media->type='category';
           $media->save();
        }

        return 'go';
    }

    public function store3(Request $request)
    {  
        $image=$request->file('file');
       $size= mediasize::find(1)->first();
        if($image){
      
           $name = time() . '.' . $image->getClientOriginalExtension();
           $path = base_path('/mediafiles/');
           $image->move($path,$name);
           
           $media = new mediafile();
           $media->image = 'http://localhost/adminportal/mediafiles/'.$name;
           $media->name = $image->getClientOriginalName();

           $thumbnail=Image::make(base_path('/mediafiles/'.$name))->resize($size->thumb_width, $size->thumb_height)->save(base_path('/thumbnailfiles/'.$name));
           $media->thumbnail = 'http://localhost/adminportal/thumbnailfiles/'.$name;

           $thumbnail=Image::make(base_path('/mediafiles/'.$name))->resize($size->med_width, $size->med_height)->save(base_path('/smallfiles/'.$name));
           $media->SmallImage = 'http://localhost/adminportal/smallfiles/'.$name;

           $media->type='subcategory';
           $media->save();
        }

        return 'go';
    }

    public function settingchanges(request $request){
     $setting= mediasize::find(1);
     $setting->thumb_width=$request->thumb_width;
     $setting->thumb_height=$request->thumb_height;
     $setting->med_width=$request->med_width;
     $setting->med_height=$request->med_height;
     $setting->icon_width=$request->icon_width;
     $setting->icon_height=$request->icon_height;
     $setting->save();
     return 'done';

    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(request $request)
    {
        mediafile::where('id',$request->id)->delete();
        return ;

    }
    public function imgshow(){
   
        $media = mediafile::all();
        return view('admin.imageshow', ['media'=> $media]);
    
    }

    public function detail(request $request){
        $media = mediafile::where('id',$request->id)->first();

        list($width, $height, $type, $attr) = getimagesize($media->image); 
   
        return view('admin.detail', ['media'=> $media,'width'=>$width,'height'=>$height]);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function setting(){
       $set=mediasize::find(1)->first();

       return view('admin.setting',['set'=>$set]);
    }

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
    public function deletefile(Request $request)
    {
        $path = $request->name;

       unlink();
    }
}