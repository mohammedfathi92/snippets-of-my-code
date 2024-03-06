<?php
/**
 * Created by Mohammed Zidan Mohammed@developnet.net.
 * Project: easystudy
 * File: grid.blade.php
 * Date: 8/2/17
 * Time: 2:48 PM
 */
?>



@if($institutes->count())
    @foreach($institutes as $institute)


                        {{-- <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">

                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4">
                                                        @if($institute->featured)
                                                            <div class="ribbon_3 featured">
                                                                <span>{{trans("institutes.featured")}}</span>
                                                            </div>
                                                        @endif 
                                                        <div class="wishlist">
                                                            <a class="tooltip_flip tooltip-effect-1"
                                                               href="javascript:void(0);">+<span
                                                                        class="tooltip-content-flip"><span
                                                                            class="tooltip-back">Add to wishlist</span></span></a>
                                                        </div>
                                                       
                                                        <div class="img_list"><a href="{{route("institute.details",['id'=>$institute->id,'slug'=>$institute->{"name:en"}])}}"><img src="{{url("files/{$institute->photo}?size=293,220&encode=jpg")}}" alt="{{$institute->name}}">
                        <div class="short_info"></div>
                        </a>
                        </div>
                                                    </div>
                                                    <div class="clearfix visible-xs-block"></div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <div class="tour_list_desc">
                                                          <h3>
                                                                <a href="{{route("institute.details",['id'=>$institute->id,'slug'=>$institute->{"name:en"}])}}">{{$institute->name}}</a> 
                                                            </h3>
                                                            <p>{{str_limit(strip_tags($institute->description),500)}}</p>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <div class="price_list">
                                                            <div><sup>$</sup>{{$course->price}}*<span
                                                                        class="normal_price_list">{{$course->price}}</span>
                                                                <small>*{{trans("courses.price_per_week")}}</small>
                                                                <p>
                                                                    <a href="{{route("course.details",['id'=>$course->id,'slug'=>$course->{"name:en"}])}}"
                                                                       class="btn_1">Details</a>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div> 
                                                </div>
                                                <hr>
                                           
                 <div class="row">
                    <div class="col-md-12">
                                                    <div class="panel-group" id="accordion" style="margin-bottom: 0px">
                  <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #51bce6;">
                      <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color: #fff">Anim pariatur cliche reprehenderit?<i class="indicator icon-minus pull-right"></i></a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                      </div>
                    </div>
                  </div>
                 
               
                </div>
                                        </div>
                                        </div>
                    </div> <!--End strip --> --}}

    <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                @if($institute->fetured)
                        <div class="ribbon_3 popular">
                            <span>{{trans("institutes.featured")}}</span>
                        </div>
                    @endif
                                <div class="wishlist">
                                    <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                                </div>
                                <div class="img_list">
                                    <a href="{{route("institute.details",['slug'=>str_slug($institute->{"name:en"}),"id"=>$institute->id])}}"><img src="{{url("files/{$institute->photo}?size=293,220&encode=jpg")}}" alt="Image">
                                        <div class="short_info"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix visible-xs-block"></div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="tour_list_desc">
                                
                                    <h3>{!! Html::link(route('institute.details',['slug'=>str_slug($institute->{"name:en"}),'id'=>$institute->id]),$institute->name) !!}</h3>
                                    <p>{!! str_limit(strip_tags($institute->description),200) !!}</p>
                                    <div class="row">
                        <div class="rating col-md-6 col-sm-12" data-toggle="tooltip"
                             title="{{trans("institutes.text_locale_rating")}}">
                             <small>( {{trans("institutes.text_locale_rating")}} )</small>
                            
                            <i class="{{$institute->locale_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                        </div>
                        <div class="rating col-md-6 col-sm-12" data-toggle="tooltip"
                             title="{{trans("institutes.text_international_rating")}}">
                            <small>( {{trans("institutes.text_international_rating")}} )</small>
                            <i class="{{$institute->international_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->international_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->international_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->international_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->international_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                        </div>
                    </div>
                    @if($institute->services()->count())
                                    <ul class="add_info" style="margin-top: 10px;">
                            @php
                    $houses_count = $institute->services()->where('type','house')->count();

                    $transport_count = $institute->services()->where('type','transport')->count();

                    $insurance_count = $institute->services()->where('type','insurance')->count();

                    $books_count = $institute->services()->where('type','insurance')->count();

                            @endphp            
                            

                           @if($houses_count >= 1)            
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Housing"><i class="icon-home-outline"></i></a>
                                        </li>
                            @endif
                            @if($insurance_count >= 1)             
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Insurance"><i class="icon_set_1_icon-82"></i></a>
                                        </li>

                             @endif
                            @if($transport_count >= 1)             
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Trasnportation"><i class=" icon_set_1_icon-21"></i></a>
                                        </li>
                           @endif
                            @if($books_count >= 1)               
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="books"><i class="icon-book"></i></a>
                                        </li>
                                 @endif       
                                      
                                    </ul>
@endif
                        
                                </div>
                            </div>
                           
                        </div>

                    </div>
                    <!--End strip -->
    @endforeach
    <div class="text-center">
        {!! $institutes->links() !!}
    </div><!-- end pagination-->

@else
    <div class="alert alert-info">{{trans("institutes.no_institutes_found")}}</div>
@endif

