@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> New Video &nbsp;&nbsp;
                    <a href="{{url('/admin/video')}}" class="btn btn-link btn-sm">Back To List</a>
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
                        action="{{url('/admin/video/save')}}" 
                        class="form-horizontal" 
                        method="post"
                        enctype="multipart/form-data"  
                    >
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="title" class="control-label col-lg-2 col-sm-2">Title <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="title" name="title" id="title" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="control-label col-lg-2 col-sm-2">URL <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" name="url" id="url" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="control-label col-lg-2 col-sm-2">Category <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="control-label col-lg-2 col-sm-2">Poster Image <span class="text-danger">(180x130)</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="file" name="image" id="image" accept="image/*" onchange="loadFile(event)">
                                <img src="" width="120" id="img" alt="">
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
    </div>
    <script>
    function loadFile(e){
        var output = document.getElementById('img');
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>
@endsection