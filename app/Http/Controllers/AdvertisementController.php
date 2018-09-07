<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class AdvertisementController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Advertisement', 'l'))
        {
            return view('permissions.no');
        }
        $data['advertisements'] = DB::table('advertisements')
            ->where('active', 1)
            ->orderBy('id','desc')
            ->paginate(12);
        return view('advertisements.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Advertisement', 'i'))
        {
            return view('permissions.no');
        }
        return view('advertisements.create');
    }
    // save new page
    public function save(Request $r)
    {
        if(!Right::check('Advertisement', 'i'))
        {
            return view('permissions.no');
        }
        $data = array(
            'url' => $r->url,
            'order' => $r->order,
        );
        $i = DB::table('advertisements')->insertGetId($data);
        if ($i)
        {
            if($r->photo) {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'ad' .$i . $ss;
                $destinationPath = 'uploads/advertisements/';
                $file->move($destinationPath, $file_name);
               
                DB::table('advertisements')->where('id', $i)->update(['photo'=>$file_name]);
                
            }
            
            $sms = "The new advertisement has been created successfully.";
            $r->session()->flash('sms', $sms);
            return redirect('/advertisement/create');
        }
        else
        {
            $sms1 = "Fail to create the new advertisement, please check again!";
            $r->session()->flash('sms1', $sms1);
            return redirect('/advertisement/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Advertisement', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('advertisements')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('advertisement?page='.$page);
        }
        
        return redirect('advertisement');
    }

    public function edit($id)
    {
        if(!Right::check('Advertisement', 'u'))
        {
            return view('permissions.no');
        }
        $data['advertisement'] = DB::table('advertisements')
            ->where('id',$id)->first();
        return view('advertisements.edit', $data);
    }

    public function update(Request $r)
    {
        if(!Right::check('Advertisement', 'u'))
        {
            return view('permissions.no');
        }
        $data = array(
            'url' => $r->url,
            'order' => $r->order,
        );
        
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'ad'.$r->id. $ss;
            $destinationPath = 'uploads/advertisements/';
            $file->move($destinationPath, $file_name);
            $data['photo'] = $file_name;
        }
        DB::table('advertisements')->where('id', $r->id)->update($data);
        $r->session()->flash('sms', 'All changes have saved successfully!');
        return redirect('/advertisement/edit/'.$r->id);
    }
}

