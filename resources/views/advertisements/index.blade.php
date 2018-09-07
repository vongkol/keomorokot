@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Advertisement List&nbsp;&nbsp;
                    <a href="{{url('/advertisement/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Image</th>
                                <th>URL</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $pagex = @$_GET['page'];
                                if(!$pagex)
                                    $pagex = 1;
                                $i = 12 * ($pagex - 1) + 1;
                            ?>
                            @foreach($advertisements as $advertisement)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{asset('uploads/advertisements/'.$advertisement->photo)}}" width="65"></td>
                                    <td>{{$advertisement->url}}</td>
                                    <td>{{$advertisement->order}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-info" href="{{url('/advertisement/edit/'.$advertisement->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger" href="{{url('/advertisement/delete/'.$advertisement->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{$advertisements->links()}}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection