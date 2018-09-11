@extends('layouts.front')
@section('content')
    <?php 
        $slides = DB::table('slides')->where('active',1)->orderBy('order','asc')->get(); 
        $i = 1; 
        $c = 0;
    ?>
    <div class="container-fluit">
        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                @foreach($slides as $sl)
                    @if($c == 0)
                        <li data-target="#demo" data-slide-to="{{$c}}" class="active"></li>
                    @else 
                        <li data-target="#demo" data-slide-to="{{$c}}"></li>
                    @endif  
                    <?php $c++; ?>
                @endforeach
            </ul>
            <div class="carousel-inner">
                @foreach($slides as $slide)
                @if($i++ == 1)
                    <div class="carousel-item active">
                        <img src="{{asset('front/slides/'.$slide->photo)}}" alt="" width="100%">
                        <div class="carousel-caption carousel-caption-c hidden-sm-down">
                            <div class="col-md-6 btn-slide">
                                <p><b>{{$slide->name}}</b></p>
                                <a href="{{$slide->url}}" class="btn btn-dark btn-cicle text-white">Read More</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="carousel-item">
                        <img src="{{asset('front/slides/'.$slide->photo)}}" alt="" width="100%">
                        <div class="carousel-caption carousel-caption-c hidden-sm-down">
                            <div class="col-md-6 btn-slide">
                                <p><b>{{$slide->name}}</b></p>
                                <a href="{{$slide->url}}" class="btn btn-dark btn-cicle text-white">Read More</a>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
       
        <?php
            $a = DB::table('company_features')->where('id',1)->first();
            $b = DB::table('company_features')->where('id',2)->first();
            $c = DB::table('company_features')->where('id',3)->first();
            $d = DB::table('company_features')->where('id',4)->first();
        ?>
        <!-- Page Content -->
        <div class="container ">
            <div class="row my-5 my-5-c">
                <div class="col-lg-3 col-md-3 col-sm-6 portfolio-item">
                    <div class="card card-c  h-100">
                        <div class="text-center icon-home">
                            <i class="fas fa-users-cog text-dark"></i>
                        </div>
                        <div class="card-body card-body-c text-center">
                            <h6 class="card-title">
                                <span class="text-dark-gray rep-title"><b>{{$a->title}}</b></span>
                            </h6>
                            <p class="card-text text-gray rep-des">{{$a->short_description}}</p>
                        </div>
                    </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm- portfolio-item">
                <div class="card card-c h-100">
                    <div class="text-center icon-home">
                        <i class="fas fa-trophy text-dark"></i>
                    </div>
                    <div class="card-body card-body-c text-center">
                        <h6 class="card-title">
                            <span class="text-dark-gray rep-title"><b>{{$b->title}}</b></span>
                        </h6>
                        <p class="card-text text-gray rep-des">{{$b->short_description}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 portfolio-item">
                <div class="card card-c h-100">
                    <div class="text-center icon-home">
                        <i class="far fa-gem text-dark"></i>
                    </div>
                    <div class="card-body card-body-c text-center">
                    <h6 class="card-title">
                        <span class="text-dark-gray rep-title"><b>{{$c->title}}</b></span>
                    </h6>
                    <p class="card-text text-gray rep-des">{{$c->short_description}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 portfolio-item">
                <div class="card card-c h-100">
                    <div class="text-center  icon-home">
                        <i class="fas fa-handshake text-dark"></i>
                    </div>
                    <div class="card-body card-body-c text-center">
                        <h6 class="card-title">
                            <span class="text-dark-gray rep-title"><b>{{$d->title}}</b></span>
                        </h6>
                        <p class="card-text text-gray rep-des">{{$d->short_description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $ads = DB::table('advertisements')->where('active',1)->orderBy('order','asc')->get(); 
        $j = 1;
        $a = 0;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators carousel-indicators-c">
                        @foreach($ads as $ad)
                            @if($a == 0)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$a}}" class="active"></li>
                            @else 
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$a}}"></li>
                            @endif  
                            <?php $a++; ?>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                    @foreach($ads as $adv)
                        @if($j++ == 1)
                            <div class="carousel-item active">
                                <a href="{{$adv->url}}">
                                    <img src="{{asset('uploads/advertisements/'.$adv->photo)}}" alt="" width="100%">
                                </a>
                            </div>
                        @else
                            <div class="carousel-item">
                                <a href="{{$adv->url}}">
                                    <img src="{{asset('uploads/advertisements/'.$adv->photo)}}" alt="" width="100%">
                                </a>
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluit our-service">
        <div class="row">
            <div class="col-md-12 text-center text-gray">
                <div class="container">
                    <div class='service-icon'> <i class="fas fa-cog text-dark" style="font-size: 50px;"></i></a></div>
                    <h5 class="text-dark-gray"> {{$our_service->title}}</h5>
                    <aside class="text-os">{{$our_service->qoute}}</aside>
                    <p></p>
                    <p>{{$our_service->description}}</p>

                </div>
            </div>
        </div>
    </div>
    <!-- portfolio-section -->
    <div class="space-medium">
        <div class="container-fluit portfolio">
             <div class="container">
              <ul class="nav justify-content-center" id="pills-tab" role="tablist">
              <?php $p= 1; ?>
                  @foreach($portfolio_categories as $por_cat)
                  @if($p == 1)
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-{{$por_cat->name}}-tab" data-toggle="pill" href="#pills-{{$por_cat->name}}" role="tab" aria-controls="pills-{{$por_cat->name}}" aria-selected="true"> {{$por_cat->name}}</a>
                  </li>
                  @else
                  <li class="nav-item">
                    <a class="nav-link" id="pills-{{$por_cat->name}}-tab" data-toggle="pill" href="#pills-{{$por_cat->name}}" role="tab" aria-controls="pills-{{$por_cat->name}}" aria-selected="false">{{$por_cat->name}}</a>
                  </li>
                  @endif
                  <?php $p++; ?>
                    @endforeach
                </ul>
                </div>
            </div>
                <div class="tab-content" id="pills-tabContent">
                <?php $p2 = 1; ?>
                @foreach($portfolio_categories as $pc)
                <?php $portfolios= DB::table('portfolios')
                    ->where('active',1)
                    ->orderBy('order', 'asc')
                    ->where('category_id',  $pc->id)
                    ->limit(8)
                    ->get();
                ?>
                @if($p2++ == 1)
                  <div class="tab-pane fade show active" id="pills-{{$pc->name}}" role="tabpanel" aria-labelledby="pills-{{$pc->name}}-tab">
                  <div class="col-md-12">
                  <div class="row">
                        @foreach($portfolios as $hp)
                        <div class="col-lg-3 col-md-3 col-sm-6  pd-0">
                            <div class="gallery-img"><a href="{{asset('uploads/portfolios/'.$hp->photo)}}" class="image-link" title="{{$hp->name}}"><img src="{{asset('uploads/portfolios/small/'.$hp->photo)}}"  width="100%" alt="" style="border-bottom: 2px solid #fff;"></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                  </div>
                  </div>  
                  @else 
                  <div class="tab-pane fade show" id="pills-{{$pc->name}}" role="tabpanel" aria-labelledby="pills-{{$pc->name}}-tab">
                  <div class="col-md-12">  
                    <div class="row">
                            @foreach($portfolios as $hp)
                            <div class="col-lg-3 col-md-3 col-sm-6  pd-0">
                                <div class="gallery-img"><a href="{{asset('uploads/portfolios/'.$hp->photo)}}" class="image-link" title="{{$hp->name}}"><img src="{{asset('uploads/portfolios/small/'.$hp->photo)}}"  width="100%" alt=""></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                  </div>
                @endif
                @endforeach
                </div>
                </div>
              </div>
             </div>
    <p></p>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <i class="fa fa-building building-icon"></i>&nbsp;&nbsp;<h6> FEATURED WORKED</h6>
            </div>
        </div>
        <aside class="text-partner text-gray"> WE TAKE PRIDE IN OUR WORK</aside> 
        <div class="in-icon"></div>    
        <div class="my-4">
            <div class="row">
                @foreach($feature_works as $fw)
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class=" h-100">
                        <a href="{{url('/featured-work/'.$fw->id)}}"><img class="card-img-top" src="{{asset('uploads/featured-works/250x250/'.$fw->featured_image)}}" alt="" width="100%"></a>
                        <div class="card-body card-body-f text-center">
                            <h5>
                                <a href="{{url('featured-work/'.$fw->id)}}" class="a text-dark"><b>{{$fw->title}}</b></span></a>
                            </h5>
                            <aside class="card-text text-gray">{{$fw->short_description}}</aside> 
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    var burl = "{{url('/')}}";
    function play(obj, evt)
    {
        evt.preventDefault();
        var id= $(obj).attr('data-id');
        var vid = "#vid"+id;
        var url = $(obj).attr('url');
        // remove all style
        $('.vdo-bg').removeAttr('style');
        $("#vdo").attr('src', url);
        $(vid).css('background', '#ccc');
    }

   
</script>
@endsection