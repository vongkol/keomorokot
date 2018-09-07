<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class ProjectLocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['locations'] = DB::table('project_locations')
            ->join('project_regions', 'project_locations.region_id', 'project_regions.id')
            ->where('project_locations.active', 1)
            ->select('project_locations.*', 'project_regions.name as rname')
            ->paginate(18);
        
        return view('project-locations.index', $data);
    }
    public function create()
    {
        $data['regions'] = DB::table('project_regions')->where('active', 1)->orderBy('name')->get();
        return view('project-locations.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'address' => $r->address,
            'region_id' => $r->region
        );
        $i = DB::table('project_locations')->insertGetId($data);
        if($i)
        {
            if($r->icon)
            {
                $file = $r->file('icon');
                $file_name = $i.'-'.$file->getClientOriginalName();
                $destinationPath = 'uploads/locations/';
                $file->move($destinationPath, $file_name);
                DB::table('project_locations')->where('id', $i)->update(['icon'=>$file_name]);
            }
            $r->session()->flash('sms', 'New project location has been created successfully!');
            return redirect('/admin/project-location/create');
        }
        else{

            $r->session()->flash('sms1', 'Fail to create new project location!');
            return redirect('/admin/project-location/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['location'] = DB::table('project_locations')
            ->where('id', $id)
            ->first();
        $data['regions'] = DB::table('project_regions')->where('active', 1)->orderBy('name')->get();
        return view('project-locations.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'address' => $r->address,
            'region_id' => $r->region
        );
        if($r->icon)
        {
            $file = $r->file('icon');
            $file_name = $r->id.'-'.$file->getClientOriginalName();
            $destinationPath = 'uploads/locations/';
            $file->move($destinationPath, $file_name);
            $data['icon'] = $file_name;
        }
        $i = DB::table('project_locations')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('/admin/project-location/edit/'.$r->id);
        }
        else{

            $r->session()->flash('sms1', 'Fail to save change. You maynot change anything!');
            return redirect('/admin/project-location/edit/'.$r->id);
        }
    }
    public function delete($id)
    {
       
        DB::table('project_locations')->where('id', $id)->update(['active'=>0]);
        return redirect('/admin/project-location');
    }
   
}
