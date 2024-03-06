<?php
/**
 * Created by mohammed Zidan.
 * email: php.mohammedzidan@gmail.com
 * Date: 6/23/18
 * Time: 11:19 AM
 */
?>
@if($testimonials->count())
    <div class="container">
        <br class="clearfix">
        <div class="row add-clearfix image-box style1">
            <div class="">
                <h3 class="text-center">{{trans("testimonials.title_testimonials")}}</h3>
                @foreach($testimonials as $item)
                    @if($item->video_url)
                        <div class="iso-item col-xs-12 col-sms-6 col-sm-6 col-md-3 filter-all filter-island filter-beach">
                            <article class="box">
                                <figure>
                                    @php
                                        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $item->video_url, $matches);
                                    @endphp


                                    <a class="fancyYoutube fancybox fancybox.iframe" title="{{$item->title}}"
                                       href="https://www.youtube.com/embed/{{$matches[0]}}" >
                                        @if(isset($matches[0]))
                                            <img class="img-responsive" alt=""
                                                 src="{{url("https://img.youtube.com/vi/$matches[0]/0.jpg")}}">
                                        @else
                                            <img width="370" height="190" alt=""
                                                 src="https://placehold.it/370x190">
                                        @endif


                                        <div class="details" style="padding:10px;">
                                            <h4 class="box-title">{{$item->title}}</h4>
                                        </div>

                                    </a>
                                </figure>

                            </article>
                        </div>
                    @endif
                @endforeach
                <div class="clearfix"></div>
                <a href="{{\LaravelLocalization::localizeURL("/testimonials/videos")}}"
                   class="btn btn-primary">{{trans("testimonials.btn_home_show_more_videos")}} </a>
                
            </div>
        </div>
    </div>
@endif
