@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Project Location List&nbsp;&nbsp;
                    <a href="{{url('/admin/project-location/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Address</th>
                                <th>Region</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $pagex = @$_GET['page'];
                                if(!$pagex)
                                    $pagex = 1;
                                $i = 18 * ($pagex - 1) + 1;
                            ?>
                            @foreach($locations as $l)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{URL::asset('uploads/locations/'.$l->icon)}}" width="35"/></td>
                                    <td>{{$l->title}}</td>
                                    <td>{{$l->address}}</td>
                                    <td>{{$l->rname}}</td>
                                    <td>
                                        <a class="btn btn-info btn-xs" href="{{url('/admin/project-location/edit/'.$l->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs"  href="{{url('/admin/project-location/delete/'.$l->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $locations->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection