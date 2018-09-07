@extends('layouts.front')
@section('content')
    <div class="container" style="margin-top: 45px">
        <h3 class="text-primary">{{$work->title}}</h3>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                {!!$work->description!!}
            </div>
        </div>
    </div>
@endsection
