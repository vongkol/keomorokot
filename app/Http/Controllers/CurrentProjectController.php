<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class CurrentProjectController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Current Project', 'l'))
        {
            return view('permissions.no');
        }
        $data['current_projects'] = DB::table('current_projects')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(18);
        return view('current-projects.index', $data);
    }
    public function create()
    {
        if(!Right::check('Current Project', 'i'))
        {
            return view('permissions.no');
        }
        return view('current-projects.create');
    }
    public function save(Request $r)
    {
        if(!Right::check('Current Project', 'i'))
        {
            return view('permissions.no');
        }  
        $data = array(
            'name' => $r->name,
            'order' => $r->order,
        );
        $i = DB::table('current_projects')->insertGetId($data);
        if($r->hasFile('photo')) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'current_project' .$i . $ss;
            $destinationPath = 'uploads/current_projects/'; // usually in public folder
         
            $image_resize = Image::make($file->getRealPath())->resize(70, 45)->save('uploads/current_projects/icon/'.$file_name);
            $file->move($destinationPath, $file_name);
            $data['photo'] = $file_name;
            $i = DB::table('current_projects')->where('id', $i)->update($data);
        }
        if ($i) {
            $r->session()->flash("sms", "New current project has been created successfully!");
            return redirect("/current-project/create");
        } else {
            $r->session()->flash("sms1", "Fail to create new current project!");
            return redirect("/current-project/create")->withInput();
        }   
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Current Project', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('current_projects')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0) {
            return redirect('/current-project?page='.$page);
        }

        return redirect('/current-project');
    }
    public function edit($id)
    {
        if(!Right::check('Current Project', 'u'))
        {
            return view('permissions.no');
        }
        $data['current_project'] = DB::table('current_projects')
            ->where('id',$id)->first();
        return view('current-projects.edit', $data);
    }
    
    public function update(Request $r)
    {
        if(!Right::check('Current Project', 'u'))
        {
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'order' => $r->order,
        );
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'current_project' .$r->id . $ss;

            $image_resize = Image::make($file->getRealPath())->resize(70, 45)->save('uploads/current_projects/icon/'.$file_name);
            $destinationPath = 'uploads/current_projects/'; // usually in public folder
            $file->move($destinationPath, $file_name);

            $data['photo'] = $file_name;
            $i = DB::table('current_projects')->where("id", $r->id)->update($data);
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/current-project/edit/". $r->id);
        }
        $i = DB::table('current_projects')->where("id", $r->id)->update($data);
        if($i){
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/current-project/edit/". $r->id);
        } else {
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/current-project/edit/". $r->id);
        }
    }
}

