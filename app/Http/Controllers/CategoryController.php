<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Post Category', 'l')){
            return view('permissions.no');
        }
        $data['categories'] = DB::table('categories as a')
            ->leftjoin('categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->where('a.active',1)
            ->paginate(18);
        return view('categories.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Post Category', 'i')){
            return view('permissions.no');
        }
        $data['categories'] = DB::table('categories')
            ->where('parent_id', 0)
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('categories.create', $data);
    }
    // save new category
    public function save(Request $r)
    {
        if(!Right::check('Post Category', 'i')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'parent_id' => $r->parent
        );
        $sms = "The new category has been created successfully.";
        $sms1 = "Fail to create the new category, please check again!";
        $i = DB::table('categories')->insertGetId($data);
        if ($i)
        {
            if($r->icon)
            {
               
                $file = $r->file('icon');
                $file_name = $i . '-' . $file->getClientOriginalName();
                $destinationPath = 'uploads/icons/'; // usually in public folder
                $file->move($destinationPath, $file_name);
                DB::table('categories')->where('id', $i)->update(['icon'=>$file_name]);
            }
            $r->session()->flash('sms', $sms);
            return redirect('/admin/category/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/category/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Post Category', 'd')){
            return view('permissions.no');
        }
        DB::table('categories')->where('id', $id)->update(['active'=>0]);
        return redirect('/admin/category');
    }

    public function edit($id)
    {
        if(!Right::check('Post Category', 'u')){
            return view('permissions.no');
        }
        $data['cat'] = DB::table('categories')
           ->where('active', 1)
           ->where('parent_id', 0)
           ->orderBy('name')
           ->get();
        $data['categories'] = DB::table('categories')
            ->where('id', $id)
            ->first();
            
        return view('categories.edit', $data);
    }
    public function update(Request $r)
    {
        if(!Right::check('Post Category', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name, 
            'parent_id' => $r->parent
        );
        if($r->icon)
        {
            
            $file = $r->file('icon');
            $file_name = $r->id . '-' . $file->getClientOriginalName();
            $destinationPath = 'uploads/icons/'; // usually in public folder
            $file->move($destinationPath, $file_name);
            $data['icon'] = $file_name;
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('categories')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/category/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/category/edit/'.$r->id);
        }
    }
}
