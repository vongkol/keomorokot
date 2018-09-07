<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class CompanyFeatureController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Company Feature', 'l'))
        {
            return view('permissions.no');
        }
        $data['company_features'] = DB::table('company_features')
            ->paginate(12);
        return view('company-features.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Company Feature', 'i'))
        {
            return view('permissions.no');
        }
        return view('company-features.create');
    }
    // save new page
    public function save(Request $r)
    {
        if(!Right::check('Company Feature', 'i'))
        {
            return view('permissions.no');
        }
        $data = array(
            'title' => $r->title,
            'short_description' => $r->short_description,
        );
        $i = DB::table('company_features')->insertGetId($data);
        if ($i)
        {
            $sms = "The new company feature has been created successfully.";
            $r->session()->flash('sms', $sms);
            return redirect('/company-feature/create');
        }
        else
        {    
            $sms1 = "Fail to create the new company feature, please check again!";
            $r->session()->flash('sms1', $sms1);
            return redirect('/company-feature/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Company Feature', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('company_features')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('company-feature?page='.$page);
        }
        
        return redirect('company-feature');
    }

    public function edit($id)
    {
        if(!Right::check('Company Feature', 'u'))
        {
            return view('permissions.no');
        }
        $data['company_feature'] = DB::table('company_features')
            ->where('id',$id)->first();
        return view('company-features.edit', $data);
    }

    public function update(Request $r)
    {
        if(!Right::check('Company Feature', 'u'))
        {
            return view('permissions.no');
        }
        $data = array(
            'title' => $r->title,
            'short_description' => $r->short_description,
        );
        
        DB::table('company_features')->where('id', $r->id)->update($data);
        $r->session()->flash('sms', 'All changes have saved successfully!');
        return redirect('/company-feature/edit/'.$r->id);
    }
}

