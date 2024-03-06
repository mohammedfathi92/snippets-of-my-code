<?php
/**
 * Created by mohammed Zidan.
 * email: php.mohammedzidan@gmail.com
 * Date: 6/23/18
 * Time: 11:19 AM
 */
?>
@if($testimonials->count())
    <br class="clearfix">
    <div class="global-map-area section parallax" data-stellar-background-ratio="0.5">
        <div class="container">
            <h1 class="text-center white-color">{{trans("testimonials.frontend_title_what_say")}}</h1>
            <div class="testimonial style3">
                <ul class="slides">

                    @foreach($testimonials as $item)
                        <li>
                            <div class="author"><a href="#">
                                    <img src="@if($item->avatar) {{url("files/$item->avatar?size=270,270&encode=jpg")}} @else /images/default-avatar.jpg @endif"
                                         alt="{{$item->visitor_name}}" width="74"
                                         height="74"/></a>
                            </div>
                            <blockquote class="description" style="font-size: 14px; color: #fff; padding: 10px;" >
                               {{-- <em>{{$item->title}}</em> --}}
                               {!! str_limit(strip_tags($item->description),400 )!!} 
                            </blockquote>
                            <h2 class="name">{{$item->visitor_name}}</h2>
                        </li>
                    @endforeach


                </ul>
               
            </div>
             <center><a href="{{\LaravelLocalization::localizeURL("/testimonials")}}"
                   class="btn btn-success">{{trans("testimonials.btn_home_show_more_text")}} </a></center>
        </div>
    </div>
@endif

