@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Current Project List&nbsp;&nbsp;
                    <a href="{{url('/current-project/create')}}" class="btn btn-link btn-sm">
                            New
                    </a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($current_projects as $cur)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{URL::asset('uploads/current_projects/').'/'.$cur->photo}}" width="100"/></td>
                                    <td>{{$cur->name}}</td>
                                    <td>{{$cur->order}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{url('/current-project/edit/'.$cur->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a  class="btn btn-xs btn-danger"  href="{{url('/current-project/delete/'.$cur->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{$current_projects->links()}}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection