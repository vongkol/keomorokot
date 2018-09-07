@extends('layouts.front')
@section('content')
<div class="container-fluit">
    <img src="{{asset('uploads/pages/'.$page->featured_image)}}" alt="" width="100%">
</div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-warning title-page my-4">
                    <b style="text-shadow:2px 3px 5px #fff;"><i class="fa fa-building"></i> {{$page->title}}</b>
          
                    </h2>
                    <div class="page-by-cat back">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="border-custom">
                                    <aside>{!!$page->description!!}</aside>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <p></p>
@endsection