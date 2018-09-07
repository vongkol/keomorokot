<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class VideoCategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['categories'] = DB::table('video_categories')
            ->where('active', 1)
            ->paginate(18);
        return view('video-categories.index', $data);
    }
    public function create()
    {
        return view('video-categories.create');
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('video_categories')->insert($data);
        if($i)
        {
            $r->session()->flash('sms', 'New video category has been created successfully!');
            return redirect('/admin/video-category/create');
        }
        else{
            $r->session()->flash('sms1', 'Fail to create new video category!');
            return redirect('/admin/video-category/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['category'] = DB::table('video_categories')->where('id', $id)->first();
        return view('video-categories.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('video_categories')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('/admin/video-category/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', 'Fail to save change. You maynot change anything!');
            return redirect('/admin/video-category/edit/'.$r->id);
        }
    }
    public function delete($id)
    {
        DB::table('video_categories')->where('id', $id)->update(['active'=>0]);
        return redirect('/admin/video-category');
    }
}
