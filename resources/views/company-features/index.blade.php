@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Company Feature List&nbsp;&nbsp;
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Name</th>
                                <th>Short Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($company_features as $com)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$com->title}}</td>
                                <td>{{$com->short_description}}</td>
                                <td>
                                    <a class="btn btn-info btn-xs" href="{{url('/company-feature/edit/'.$com->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                    {{$company_features->links()}}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection