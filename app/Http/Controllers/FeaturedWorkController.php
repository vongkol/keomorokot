<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class FeaturedWorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     // index
     public function index()
     {
        if(!Right::check('Featured Work', 'l'))
        {
            return view('permissions.no');
        }
        $data['posts'] = DB::table('featured_works')
             ->where('active',1)
             ->orderBy('id', 'desc')
             ->paginate(18);
        return view('featured-works.index', $data);
     }
     // load create form
     public function create()
     {
        if(!Right::check('Featured Work', 'i'))
        {
            return view('permissions.no');
        }
         return view('featured-works.create');
     }
     // save new page
     public function save(Request $r)
     {
        if(!Right::check('Featured Work', 'i'))
        {
            return view('permissions.no');
        }
         $data = array(
             'title' => $r->title,
             'short_description' => $r->short_description,
             'description' => $r->description
         );
         $i = DB::table('featured_works')->insertGetId($data);
         if($i)
         {
             if($r->feature_image) {
 
                 $file = $r->file('feature_image');
                 $file_name = $file->getClientOriginalName();
                 $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                 $file_name = 'post' .$i . $ss;
                 
                 // upload 250
                 $destinationPath = 'uploads/featured-works/250x250/';
                 $new_img = Image::make($file->getRealPath())->resize(350, 250);
                 $new_img->save($destinationPath . $file_name, 80);
                 DB::table('featured_works')->where('id', $i)->update(['featured_image'=>$file_name]);
             }
             $r->session()->flash('sms', 'New post has been created successfully!');
             return redirect('/admin/featured-work/create');
         }
         else{
             $r->session()->flash('sms1', 'Fail to create new post. Please check your input again!');
             return redirect('/admin/featured-work/create')->withInput();
         }
     }
     // delete
     public function delete($id)
     {
        if(!Right::check('Featured Work', 'd'))
        {
            return view('permissions.no');
        }
         DB::table('featured_works')->where('id', $id)->update(['active'=>0]);
         return redirect('/admin/featured-work');
     }
 
     public function edit($id)
     {
        if(!Right::check('Featured Work', 'u'))
        {
            return view('permissions.no');
        }
         $data['post'] = DB::table('featured_works')
             ->where('id',$id)->first();
         return view('featured-works.edit', $data);
     }
 
     public function update(Request $r)
     {
        if(!Right::check('Featured Work', 'u'))
        {
            return view('permissions.no');
        }
         $data = array(
             'title' => $r->title,
             'short_description' => $r->short_description,
             'description' => $r->description
         );
         if($r->feature_image) {
            
             $file = $r->file('feature_image');
             $file_name = $file->getClientOriginalName();
             $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
             $file_name = 'post' .$r->id . $ss;
             // upload 250
             $destinationPath = 'uploads/featured-works/250x250/';
             $new_img = Image::make($file->getRealPath())->resize(350, 250);
             $new_img->save($destinationPath . $file_name, 80);
             $data['featured_image'] =  $file_name;
         }
         $i = DB::table('featured_works')->where('id', $r->id)->update($data);
         if ($i)
         {
             $sms = "All changes have been saved successfully.";
             $r->session()->flash('sms', $sms);
             return redirect('/admin/featured-work/edit/'.$r->id);
         }
         else
         {   
             $sms1 = "Fail to to save changes, please check again!";
             $r->session()->flash('sms1', $sms1);
             return redirect('/admin/featured-work/edit/'.$r->id);
         }
     }
     // view detail
     public function view($id) 
     {
        if(!Right::check('Featured Work', 'l'))
        {
            return view('permissions.no');
        }
         $data['post'] = DB::table('featured_works')
             ->where('id',$id)->first();
         return view('featured-works.detail', $data);
     }
}
