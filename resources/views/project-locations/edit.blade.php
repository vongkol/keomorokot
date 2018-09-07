@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Project Location&nbsp;&nbsp;
                    <a href="{{url('/admin/project-location')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                    @if(Session::has('sms'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms')}}
                            </div>
                        </div>
                    @endif
                    @if(Session::has('sms1'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms1')}}
                            </div>
                        </div>
                    @endif

                    <form 
                        action="{{url('/admin/project-location/update')}}" 
                        class="form-horizontal" 
                        enctype="multipart/form-data"  
                        method="post"
                    >
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$location->id}}">
                        <div class="form-group row">
                            <label for="title" class="control-label col-lg-2 col-sm-2">Title <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" required autofocus name="title" id="title"
                                value="{{$location->title}}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="address" class="control-label col-lg-2 col-sm-2">Address</label>
                            <div class="col-lg-6 col-sm-8">
                                <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{$location->address}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="region" class="control-label col-lg-2 col-sm-2">Project Region</label>
                                <div class="col-lg-6 col-sm-8">
                                    <select name="region" id="region" class="form-control">
                                        @foreach($regions as $r)
                                            <option value="{{$r->id}}" {{$r->id==$location->region_id?'selected':''}}>{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="icon" class="control-label col-lg-2 col-sm-2">Icon <span class="text-danger">(110x80)</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="file" name="icon" id="icon" accept="image/*"  onchange="loadFile(event)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact" class="control-label col-lg-2 col-sm-2"></label>
                            <div class="col-lg-6 col-sm-8">
                                <img src="{{asset('uploads/locations/'.$location->icon)}}" id="img"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-danger" type="reset">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
<script>
    function loadFile(e){
        var output = document.getElementById('img');
        output.width = 170;
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>
@endsection