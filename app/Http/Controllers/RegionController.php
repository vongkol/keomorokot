<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['regions'] = DB::table('project_regions')
            ->where('active', 1)
            ->paginate(18);
        return view('regions.index', $data);
    }
    public function create()
    {
        return view('regions.create');
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('project_regions')->insert($data);
        if($i)
        {
            $r->session()->flash('sms', "New region has been created successfully!");
            return redirect('/admin/region/create');
        }
        else{
            $r->session()->flash('sms1', "Fail to create new region. Check again!");
            return redirect('/admin/region/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['region'] = DB::table('project_regions')
            ->where('id', $id)
            ->first();
        return view('regions.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $id = $r->id;
        $i = DB::table('project_regions')->where('id', $id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', "All changes have been saved!");
            return redirect('/admin/region/edit/'.$id);
        }
        else{
            $r->session()->flash('sms1', "Fail to save change!");
            return redirect('/admin/region/edit/'.$id);
        }

    }
    public function delete($id)
    {
        DB::table('project_regions')->where('id', $id)->update(['active'=>0]);
        return redirect('/admin/region');
    }
}
