<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

class BackgroundImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
   
        $data['background_images'] = DB::table('background_images')
            ->get();
        return view('background-images.index', $data);
    }
 

    public function edit($id)
    {
        $data['b'] = DB::table('background_images')
            ->where('id', $id)
            ->first();
            
        return view('background-images.edit', $data);
    }
    public function update(Request $r)
    {
        if($r->photo) {
           
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'background' .$r->id . $ss;
            // upload 250
            $destinationPath = 'uploads/backgrounds/';
            $new_img = Image::make($file->getRealPath())->resize(1350, 280);
            $new_img->save($destinationPath . $file_name, 80);
            $data['photo'] =  $file_name;
            $i = DB::table('background_images')->where('id', $r->id)->update($data);
            $sms = "All changes have been saved successfully.";
            $r->session()->flash('sms', $sms);
            return redirect('/background-image/edit/'.$r->id);
            
        }
        else
        {   
            $sms1 = "Fail to to save changes, please check again!";
            $r->session()->flash('sms1', $sms1);
            return redirect('/background-image/edit/'.$r->id);
        }
    }
}
