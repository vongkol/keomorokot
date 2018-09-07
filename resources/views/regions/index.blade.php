@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Project Region List&nbsp;&nbsp;
                    <a href="{{url('/admin/region/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Name</th>
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
                            @foreach($regions as $l)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$l->name}}</td>
                                    <td>
                                        <a class="btn btn-info btn-xs" href="{{url('/admin/region/edit/'.$l->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs"  href="{{url('/admin/region/delete/'.$l->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $regions->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection