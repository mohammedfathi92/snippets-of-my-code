<?php
/**
 * Created by Mohammed Zidan Mohammed@developnet.net.
 * Project: easystudy
 * File: grid.blade.php
 * Date: 8/2/17
 * Time: 2:48 PM
 */
?>

<div class="row">
    @if($institutes->count())
        @foreach($institutes as $institute)
            <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                <div class="tour_container">
                    @if($institute->fetured)
                        <div class="ribbon_3 popular">
                            <span>{{trans("institutes.featured")}}</span>
                        </div>
                    @endif
                    <div class="img_container">
                        <a href="{{route("institute.details",['slug'=>str_slug($institute->{"name:en"}),"id"=>$institute->id])}}">
                            <img src="{{url("files/{$institute->photo}?size=800,533&encode=jpg")}}" width="800"
                                 height="533" class="img-responsive" alt="{{$institute->name}}">
                            <div class="short_info">
                                <i class="icon-location"></i>{{$institute->city->name}}
                            </div>
                        </a>
                    </div>
                    <div class="tour_title">
                        <h3>{!! Html::link(route('institute.details',['slug'=>str_slug($institute->{"name:en"}),'id'=>$institute->id]),$institute->name) !!}</h3>
                        <div class="rating">
                            <i class="{{$institute->locale_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                            <i class="{{$institute->locale_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                        </div><!-- end rating -->
                           <div class="compare">
                                            
                                          <label class="compare-label">
                                           <input  type="checkbox" name="selected[]" value="<%course.id%>">
                                           
                                            {{trans("courses.btn_compare")}}
                                            </label>
                                           

                                        </div>

                    </div>
                </div><!-- End box tour -->
            </div><!-- End col-md-6 -->
        @endforeach
    @else
        <div class="alert alert-info">{{trans("institutes.no_institutes_found")}}</div>
    @endif

</div><!-- End row -->


<hr>

<div class="text-center">
    {!! $institutes->links() !!}
</div><!-- end pagination-->

