 {{--  <div id="slideshow">
        @if(\App\Slide::published()->count())
            <div class="fullwidthbanner-container">
                <div class="revolution-slider rev_slider" style="height: 0; overflow: hidden;">
                    <ul>    <!-- SLIDE  -->
                    @foreach(\App\Slide::published()->get() as $slide)
                        @if(Storage::disk('public')->exists(config('settings.upload_dir')."/".$slide->photo))
                            <!-- Slide1 -->
                                <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500">
                                    <!-- MAIN IMAGE -->
                                    <a href="{{$slide->url}}">
                                        <img class="lazy img-responsive"
                                             src="{{url("files/{$slide->photo}?size=1351,646&encode=jpg")}}"
                                             alt="{{$slide->name}}">
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>--}}
@if(LaravelLocalization::getCurrentLocaleDirection()=="rtl")
     <div id="slideshow">
            <div class="fullwidthbanner-container">
                <div class="revolution-slider rev_slider" style="height: 0; overflow: hidden;">
                    <ul>    <!-- SLIDE  -->
                    
                        <!-- SLIDE  -->
                        <li data-index="rs-14" data-transition="zoomout" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="1000"  data-thumb="http://static.soaptheme.net/uploads/revslider1/homepage/bg1.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="/images/revslider1/homepage/bg1.jpg"  alt="" title="Slider1"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-1-1"
                                 data-x="576" 
                                 data-y="16" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:left;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:1500;s:1500;" 
                                data-start="500" 
                                data-responsive_offset="on"

                                style="z-index: 5;"><img src="/images/revslider1/homepage/girl.png" alt="" data-ww="650px" data-hh="637px" data-no-retina> </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-2-1"
                                 data-x="27" 
                                 data-y="359" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:right;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:1500;s:1500;" 
                                data-start="800" 
                                data-responsive_offset="on"

                                style="z-index: 6;"><img src="/images/revslider1/homepage/island.png" alt="" data-ww="267px" data-hh="187px" data-no-retina> </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-3-2"
                                 data-x="266" 
                                 data-y="479" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:bottom;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:-50px;opacity:0;s:300;s:300;" 
                                data-start="1100" 
                                data-responsive_offset="on"

                                style="z-index: 7;"><img src="/images/revslider1/homepage/ballon.png" alt="" data-ww="25px" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-4-3"
                                 data-x="384" 
                                 data-y="441" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:left;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:-50px;opacity:0;s:300;s:300;" 
                                data-start="1400" 
                                data-responsive_offset="on"

                                style="z-index: 8;"><img src="/images/revslider1/homepage/plane1.png" alt="" data-ww="262px" data-hh="100px" data-no-retina> </div>

                            <!-- LAYER NR. 5 -->
                            <div class="tp-caption large_bold_white_med_2   tp-resizeme" 
                                 id="slide-14-layer-1-2"
                                 data-x="25" 
                                 data-y="100" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:bottom;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="1700" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 9; white-space: nowrap; color: rgba(255, 255, 255, 1.00);font-family:Arial;  border-color:rgba(255, 214, 88, 1.00);"><p class="caption-big-title">{{trans("slides.first_title")}}</p> </div>



                            <!-- LAYER NR. 10 -->
                            <div class="tp-caption large_bold_white_med   tp-resizeme" 
                                 id="slide-14-layer-10" 
                                 data-x="72" 
                                 data-y="180" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:top;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:-50px;opacity:0;s:300;s:300;" 
                                data-start="3200" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 14; white-space: nowrap; color: rgba(255, 255, 255, 1.00);font-family:Arial; text-align: right;  border-color:rgba(255, 214, 88, 1.00);">

<p> 
{{trans("slides.first_one")}} <strong> - </strong>
</p>

<p> 
{{trans("slides.first_two")}} <strong> - </strong>
</p>

<p> 
{{trans("slides.first_three")}} <strong> - </strong>
</p>

<p> 
{{trans("slides.first_four")}} <strong> - </strong>
</p>

</div>
 


                            <!-- LAYER NR. 14 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-14-1"
                                 data-x="29" 
                                 data-y="410" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:1300;s:1300;" 
                                data-start="4400" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 18; white-space: nowrap; font-size: 12px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><a class="link link-home-slider-blue" href="#">{{trans("slides.more_info")}}</a> </div>
                        </li>
                                   <!-- slide (1) end -->

                        <!-- SLIDE  -->
                        <li data-index="rs-15" data-transition="slidedown" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="1500"  data-thumb="http://static.soaptheme.net/uploads/revslider1/homepage/bg2.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="/images/revslider1/homepage/bg2.jpg"  alt="" title="Slider1"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-1" 
                                 data-x="right" data-hoffset="-10" 
                                 data-y="center" data-voffset="" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:right;s:400;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:300;s:300;" 
                                data-start="1000" 
                                data-responsive_offset="on"

                                style="z-index: 5;"><img src="/images/revslider1/homepage/cloud.png" alt="" data-no-retina> </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-2" 
                                 data-x="right" data-hoffset="307" 
                                 data-y="134" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:400;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:300;s:300;" 
                                data-start="1700" 
                                data-responsive_offset="on"

                                style="z-index: 6;"><img src="/images/revslider1/homepage/balloon.png" alt="" data-no-retina> </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-3" 
                                 data-x="center" data-hoffset="24" 
                                 data-y="139" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:800;y:450;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:600;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:600;s:600;" 
                                data-start="2100" 
                                data-responsive_offset="on"

                                style="z-index: 7;"><img src="/images/revslider1/homepage/plane2.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-4" 
                                 data-x="right" data-hoffset="486" 
                                 data-y="116" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="3900" 
                                data-responsive_offset="on"

                                style="z-index: 8;"><img src="/images/revslider1/homepage/italy.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 5 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-5" 
                                 data-x="right" data-hoffset="437" 
                                 data-y="117" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="3700" 
                                data-responsive_offset="on"

                                style="z-index: 9;"><img src="/images/revslider1/homepage/building5.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 6 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-6" 
                                 data-x="right" data-hoffset="498" 
                                 data-y="201" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="3500" 
                                data-responsive_offset="on"

                                style="z-index: 10;"><img src="/images/revslider1/homepage/building4.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            
                            <!-- LAYER NR. 8 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-8" 
                                 data-x="right" data-hoffset="367" 
                                 data-y="152" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="3100" 
                                data-responsive_offset="on"

                                style="z-index: 12;"><img src="/images/revslider1/homepage/building2.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 9 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-9" 
                                 data-x="right" data-hoffset="365" 
                                 data-y="53" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="2900" 
                                data-responsive_offset="on"

                                style="z-index: 13;"><img src="/images/revslider1/homepage/paris.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 10 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-10" 
                                 data-x="right" data-hoffset="342" 
                                 data-y="183" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="2700" 
                                data-responsive_offset="on"

                                style="z-index: 14;"><img src="/images/revslider1/homepage/sydney.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 11 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-11" 
                                 data-x="right" data-hoffset="481" 
                                 data-y="178" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="2500" 
                                data-responsive_offset="on"

                                style="z-index: 15;"><img src="/images/revslider1/homepage/building.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 12 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-12" 
                                 data-x="right" data-hoffset="413" 
                                 data-y="30" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="2300" 
                                data-responsive_offset="on"

                                style="z-index: 16;"><img src="/images/revslider1/homepage/london.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 13 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-13" 
                                 data-x="right" data-hoffset="440" 
                                 data-y="120" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="2100" 
                                data-responsive_offset="on"

                                style="z-index: 17;"><img src="/images/revslider1/homepage/newyork.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 14 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-14" 
                                 data-x="right" data-hoffset="-60" 
                                 data-y="220"  
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:800;y:450;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:600;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:300;s:300;" 
                                data-start="1600" 
                                data-responsive_offset="on"

                                style="z-index: 18;"><img src="/images/revslider1/homepage/hand.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 15 -->
                            <div class="tp-caption large_bold_white_med   tp-resizeme" 
                                 id="slide-15-layer-15" 
                                 data-x="25" 
                                 data-y="100" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:right;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:1000;s:1000;" 
                                data-start="4000" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 19; white-space: nowrap; color: rgba(255, 255, 255, 1.00);font-family:Arial;border-color:rgba(255, 214, 88, 1.00);"><p class="caption-big-title">{{trans("slides.second_title")}}
                                </p> </div>

                            <!-- LAYER NR. 16 -->
                            
                            <!-- LAYER NR. 17 -->
                            <div class="tp-caption large_bold_white_med   tp-resizeme" 
                                 id="slide-15-layer-17" 
                                 data-x="72" 
                                 data-y="180" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:-50px;opacity:0;s:1000;s:1000;" 
                                data-start="4400" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 21; white-space: nowrap;text-align: right;   color: rgba(255, 255, 255, 1.00);font-family:Arial;border-color:rgba(255, 214, 88, 1.00);">
<p> 
{{trans("slides.second_one")}} <strong> - </strong>
</p>

<p> 
{{trans("slides.second_two")}} <strong> - </strong>
</p>

<p> 
{{trans("slides.second_three")}} <strong> - </strong>
</p>

<p> 
{{trans("slides.second_four")}} <strong> - </strong>
</p>

   </div>

                            
                            <!-- LAYER NR. 24 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-24" 
                                 data-x="29" 
                                 data-y="410" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:1300;s:1300;" 
                                data-start="5700" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 28; white-space: nowrap; font-size: 12px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><a class="link link-home-slider-blue" href="#">{{trans("slides.more_info")}}</a> </div>
                        </li>

                        <!-- Slide (2) Ended -->
                        
                        <!--slide -->
                         <li data-index="rs-21" data-transition="cube" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="800"  data-thumb="http://static.soaptheme.net/uploads/revslider1/snapshot/bg1.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="/images/revslider1/snapshot/bg1.jpg"  alt="" title="Slider1"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                          
                      

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-4" 
                                 data-x="618" 
                                 data-y="22" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:top;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:-50px;opacity:0;s:300;s:300;" 
                                data-start="2000" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 8;"><img src="/images/revslider1/snapshot/poss8.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 5 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-5" 
                                 data-x="514" 
                                 data-y="123" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:300;s:300;" 
                                data-start="2300" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 9;"><img src="/images/revslider1/snapshot/poss6.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 6 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-6" 
                                 data-x="762" 
                                 data-y="67" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:right;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="2600" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 10;"><img src="/images/revslider1/snapshot/poss7.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 7 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-7" 
                                 data-x="723" 
                                 data-y="109" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:300;s:300;" 
                                data-start="2900" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 11;"><img src="/images/revslider1/snapshot/poss5.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 8 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-8" 
                                 data-x="606" 
                                 data-y="337" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:bottom;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:bottom;s:300;s:300;" 
                                data-start="3200" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 12;"><img src="/images/revslider1/snapshot/poss4.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 9 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-9" 
                                 data-x="656" 
                                 data-y="196" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:300;s:300;" 
                                data-start="3500" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 13;"><img src="/images/revslider1/snapshot/poss3.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 10 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-10" 
                                 data-x="588" 
                                 data-y="316" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:-50px;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:300;s:300;" 
                                data-start="3800" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 14;"><img src="/images/revslider1/snapshot/small_pos.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 11 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-11" 
                                 data-x="836" 
                                 data-y="265" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:right;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="4100" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 15;"><img src="/images/revslider1/snapshot/poss22.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 12 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-12" 
                                 data-x="762" 
                                 data-y="362" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:300;s:300;" 
                                data-start="4400" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 16;"><img src="/images/revslider1/snapshot/pos.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>
                                
                                
                                <!-- LAYER NR. 5 -->
                            <div class="tp-caption large_bold_white_med_2   tp-resizeme" 
                                 id="slide-14-layer-2-2"
                                 data-x="25" 
                                 data-y="100" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:bottom;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="1700" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 9; white-space: nowrap; color: rgba(255, 255, 255, 1.00);font-family:Arial;border-color:rgba(255, 214, 88, 1.00);"><p class="caption-big-title">{{trans("slides.third_title")}}</p> </div>

                            
                            <!-- LAYER NR. 13 -->
                            <div class="tp-caption large_bold_white_med   tp-resizeme" 
                                 id="slide-14-layer-13-1"
                                 data-x="75" 
                                 data-y="180" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:top;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:300;s:300;" 
                                data-start="4100" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 17; white-space: nowrap; text-align: right;  color: rgba(255, 255, 255, 1.00);font-family:Arial;  border-color:rgba(255, 214, 88, 1.00);">
<p> 
{{trans("slides.third_one")}} <strong> - </strong>
</p>

<p> 
{{trans("slides.third_two")}} <strong> - </strong>
</p>

<p> 
{{trans("slides.third_three")}} <strong> - </strong>
</p>

<p> 
{{trans("slides.third_four")}} <strong> - </strong> 
</p>
</div>
                            <!-- LAYER NR. 14 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-14-2"
                                 data-x="29" 
                                 data-y="410" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:1300;s:1300;" 
                                data-start="4400" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 18; white-space: nowrap; font-size: 12px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><a class="link link-home-slider-blue" href="#">{{trans("slides.more_info")}}</a> </div>
                    
                        </li>
                        
                        <!-- SLIDE (3) Ended -->

                        <!-- SLIDE  -->
                        <li data-index="rs-8" data-transition="slideup" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="800"  data-thumb="http://static.soaptheme.net/uploads/revslider1/family/sky.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="/images/revslider1/family/sky.jpg"  alt="" title="Slider1"  data-bgposition="center top" data-bgfit="normal" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-1" 
                                 data-x="" 
                                 data-y="" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:50px;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="1700" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 5;"><img src="/images/revslider1/family/clouds1.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-2" 
                                 data-x="right" data-hoffset="-400" 
                                 data-y="30" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="2000" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 6;"><img src="/images/revslider1/family/cloud2.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-3" 
                                 data-x="right" data-hoffset="141" 
                                 data-y="137" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:1000;y:360;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:300;s:300;" 
                                data-start="2300" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 7;"><img src="/images/revslider1/family/plane1.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-4" 
                                 data-x="center" data-hoffset="" 
                                 data-y="bottom" data-voffset="120" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:2000;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="1400" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 8;"><img src="/images/revslider1/family/building1.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 5 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-5" 
                                 data-x="center" data-hoffset="" 
                                 data-y="bottom" data-voffset="108" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1.875;e:Linear.easeNone;" 
                                 data-transform_out="opacity:0;s:600;s:600;" 
                                data-start="0" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 9;"><img src="/images/revslider1/family/grass12.png" alt="" data-ww="2080px" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 6 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-6" 
                                 data-x="center" data-hoffset="" 
                                 data-y="bottom" data-voffset="" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1.875;e:Linear.easeNone;" 
                                 data-transform_out="opacity:0;s:600;s:600;" 
                                data-start="0" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 10;"><img src="/images/revslider1/family/road.jpg" alt="" data-ww="auto" data-hh="107px" data-no-retina> </div>

                            <!-- LAYER NR. 7 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-7" 
                                 data-x="center" data-hoffset="" 
                                 data-y="bottom" data-voffset="96" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1.875;e:Linear.easeNone;" 
                                 data-transform_out="opacity:0;s:600;s:600;" 
                                data-start="0" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 11;"><img src="/images/revslider1/family/tile.png" alt="" data-ww="2084px" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 8 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-8" 
                                 data-x="center" data-hoffset="" 
                                 data-y="bottom" data-voffset="10" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:left;s:2500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="2600" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 12;"><img src="/images/revslider1/family/car1.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 9 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-9" 
                                 data-x="right" data-hoffset="-50" 
                                 data-y="bottom" data-voffset="10" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:-50px;opacity:0;s:2000;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:300;s:300;" 
                                data-start="2900" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 13;"><img src="/images/revslider1/family/family1.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                           
                            <!-- LAYER NR. 11 -->

            <div class="tp-caption large_bold_white_med_2   tp-resizeme" 
                                 id="slide-14-layer-3-3"
                                 data-x="40" 
                                 data-y="100" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:-50px;opacitys:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="3500" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                            

                                
                                style="z-index: 19; white-space: nowrap; color: rgba(255, 255, 255, 1.00);font-family:Arial; text-align: center; border-color:rgba(255, 214, 88, 1.00);"><p class="caption-big-title">{{trans("slides.fourth_title")}} </div>

                            <!-- LAYER NR. 12 -->
                                <div class="tp-caption large_bold_white_med   tp-resizeme" 
                                 id="slide-8-layer-12" 
                                 data-x="75" 
                                 data-y="180" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:top;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:300;s:300;" 
                                data-start="4100" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 17; white-space: nowrap; text-align: right;  color: rgba(255, 255, 255, 1.00);font-family:Arial;  border-color:rgba(255, 214, 88, 1.00);">
 
<p> 
{{trans("slides.fourth_one")}} <strong> - </strong> 
</p>

<p> 
{{trans("slides.fourth_two")}} <strong> - </strong> 
</p>

<p> 
{{trans("slides.fourth_three")}} <strong> - </strong> 
</p>

<p> 
{{trans("slides.fourth_four")}} <strong> - </strong>
</p>
</div>

                            <!-- LAYER NR. 13 -->
                            <a href="#" class="tp-caption largewhitebg_button1_blue   tp-resizeme" 
                                 id="slide-8-layer-13" 
                                 data-x="65" 
                                 data-y="410" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:left;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:300;s:300;" 
                                data-start="4100" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 17;">{{trans("slides.more_info")}}</a>

                            
                        </li>
                        
                  
                    </ul>
                </div>
            </div>
        </div>      
        @else
              {{--  <div id="slideshow">
        @if(\App\Slide::published()->count())
            <div class="fullwidthbanner-container">
                <div class="revolution-slider rev_slider" style="height: 0; overflow: hidden;">
                    <ul>    <!-- SLIDE  -->
                    @foreach(\App\Slide::published()->get() as $slide)
                        @if(Storage::disk('public')->exists(config('settings.upload_dir')."/".$slide->photo))
                            <!-- Slide1 -->
                                <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500">
                                    <!-- MAIN IMAGE -->
                                    <a href="{{$slide->url}}">
                                        <img class="lazy img-responsive"
                                             src="{{url("files/{$slide->photo}?size=1351,646&encode=jpg")}}"
                                             alt="{{$slide->name}}">
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>--}}

     <div id="slideshow">
            <div class="fullwidthbanner-container">
                <div class="revolution-slider rev_slider" style="height: 0; overflow: hidden;">
                    <ul>    <!-- SLIDE  -->
                    
                        <!-- SLIDE  -->
                        <li data-index="rs-14" data-transition="zoomout" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="1000"  data-thumb="http://static.soaptheme.net/uploads/revslider1/homepage/bg1.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="/images/revslider1/homepage/bg1.jpg"  alt="" title="Slider1"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-1-3"
                                 data-x="576" 
                                 data-y="16" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:left;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:1500;s:1500;" 
                                data-start="500" 
                                data-responsive_offset="on"

                                style="z-index: 5;"><img src="/images/revslider1/homepage/girl.png" alt="" data-ww="650px" data-hh="637px" data-no-retina> </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-2-3"
                                 data-x="27" 
                                 data-y="359" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:right;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:1500;s:1500;" 
                                data-start="800" 
                                data-responsive_offset="on"

                                style="z-index: 6;"><img src="/images/revslider1/homepage/island.png" alt="" data-ww="267px" data-hh="187px" data-no-retina> </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-3-1"
                                 data-x="266" 
                                 data-y="479" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:bottom;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:-50px;opacity:0;s:300;s:300;" 
                                data-start="1100" 
                                data-responsive_offset="on"

                                style="z-index: 7;"><img src="/images/revslider1/homepage/ballon.png" alt="" data-ww="25px" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-4-1"
                                 data-x="384" 
                                 data-y="441" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:left;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:-50px;opacity:0;s:300;s:300;" 
                                data-start="1400" 
                                data-responsive_offset="on"

                                style="z-index: 8;"><img src="/images/revslider1/homepage/plane1.png" alt="" data-ww="262px" data-hh="100px" data-no-retina> </div>

                            <!-- LAYER NR. 5 -->
                            <div class="tp-caption large_bold_white_med_2   tp-resizeme" 
                                 id="slide-14-layer-4-2"
                                 data-x="25" 
                                 data-y="100" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:bottom;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="1700" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 9; white-space: nowrap; color: rgba(255, 255, 255, 1.00);font-family:Arial;  border-color:rgba(255, 214, 88, 1.00);"><p class="caption-big-title">{{trans("slides.first_title")}}</p> </div>



                            <!-- LAYER NR. 10 -->
                            <div class="tp-caption large_bold_white_med   tp-resizeme" 
                                 id="slide-14-layer-10" 
                                 data-x="72" 
                                 data-y="180" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:top;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:-50px;opacity:0;s:300;s:300;" 
                                data-start="3200" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 14; white-space: nowrap; color: rgba(255, 255, 255, 1.00);font-family:Arial;   border-color:rgba(255, 214, 88, 1.00);">

<p> 
<strong> - </strong> {{trans("slides.first_one")}}
</p>

<p> 
<strong> - </strong> {{trans("slides.first_two")}}
</p>

<p> 
<strong> - </strong> {{trans("slides.first_three")}}
</p>

<p> 
<strong> - </strong> {{trans("slides.first_four")}}
</p>

</div>
 


                            <!-- LAYER NR. 14 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-14-3"
                                 data-x="29" 
                                 data-y="410" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:1300;s:1300;" 
                                data-start="4400" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 18; white-space: nowrap; font-size: 12px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><a class="link link-home-slider-blue" href="#">{{trans("slides.more_info")}}</a> </div>
                        </li>
                                   <!-- slide (1) end -->

                        <!-- SLIDE  -->
                        <li data-index="rs-15" data-transition="slidedown" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="1500"  data-thumb="http://static.soaptheme.net/uploads/revslider1/homepage/bg2.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="/images/revslider1/homepage/bg2.jpg"  alt="" title="Slider1"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-1" 
                                 data-x="right" data-hoffset="-10" 
                                 data-y="center" data-voffset="" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:right;s:400;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:300;s:300;" 
                                data-start="1000" 
                                data-responsive_offset="on"

                                style="z-index: 5;"><img src="/images/revslider1/homepage/cloud.png" alt="" data-no-retina> </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-2" 
                                 data-x="right" data-hoffset="307" 
                                 data-y="134" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:400;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:300;s:300;" 
                                data-start="1700" 
                                data-responsive_offset="on"

                                style="z-index: 6;"><img src="/images/revslider1/homepage/balloon.png" alt="" data-no-retina> </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-3" 
                                 data-x="center" data-hoffset="24" 
                                 data-y="139" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:800;y:450;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:600;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:600;s:600;" 
                                data-start="2100" 
                                data-responsive_offset="on"

                                style="z-index: 7;"><img src="/images/revslider1/homepage/plane2.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-4" 
                                 data-x="right" data-hoffset="486" 
                                 data-y="116" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="3900" 
                                data-responsive_offset="on"

                                style="z-index: 8;"><img src="/images/revslider1/homepage/italy.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 5 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-5" 
                                 data-x="right" data-hoffset="437" 
                                 data-y="117" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="3700" 
                                data-responsive_offset="on"

                                style="z-index: 9;"><img src="/images/revslider1/homepage/building5.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 6 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-6" 
                                 data-x="right" data-hoffset="498" 
                                 data-y="201" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="3500" 
                                data-responsive_offset="on"

                                style="z-index: 10;"><img src="/images/revslider1/homepage/building4.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            
                            <!-- LAYER NR. 8 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-8" 
                                 data-x="right" data-hoffset="367" 
                                 data-y="152" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="3100" 
                                data-responsive_offset="on"

                                style="z-index: 12;"><img src="/images/revslider1/homepage/building2.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 9 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-9" 
                                 data-x="right" data-hoffset="365" 
                                 data-y="53" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="2900" 
                                data-responsive_offset="on"

                                style="z-index: 13;"><img src="/images/revslider1/homepage/paris.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 10 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-10" 
                                 data-x="right" data-hoffset="342" 
                                 data-y="183" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="2700" 
                                data-responsive_offset="on"

                                style="z-index: 14;"><img src="/images/revslider1/homepage/sydney.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 11 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-11" 
                                 data-x="right" data-hoffset="481" 
                                 data-y="178" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="2500" 
                                data-responsive_offset="on"

                                style="z-index: 15;"><img src="/images/revslider1/homepage/building.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 12 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-12" 
                                 data-x="right" data-hoffset="413" 
                                 data-y="30" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="2300" 
                                data-responsive_offset="on"

                                style="z-index: 16;"><img src="/images/revslider1/homepage/london.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 13 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-13" 
                                 data-x="right" data-hoffset="440" 
                                 data-y="120" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="2100" 
                                data-responsive_offset="on"

                                style="z-index: 17;"><img src="/images/revslider1/homepage/newyork.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 14 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-14" 
                                 data-x="right" data-hoffset="-60" 
                                 data-y="220"  
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:800;y:450;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:600;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:300;s:300;" 
                                data-start="1600" 
                                data-responsive_offset="on"

                                style="z-index: 18;"><img src="/images/revslider1/homepage/hand.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 15 -->
                            <div class="tp-caption large_bold_white_med   tp-resizeme" 
                                 id="slide-15-layer-15" 
                                 data-x="25" 
                                 data-y="100" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:right;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:1000;s:1000;" 
                                data-start="4000" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 19; white-space: nowrap; color: rgba(255, 255, 255, 1.00);font-family:Arial;border-color:rgba(255, 214, 88, 1.00);"><p class="caption-big-title">{{trans("slides.second_title")}}
                                </p> </div>

                            <!-- LAYER NR. 16 -->
                            
                            <!-- LAYER NR. 17 -->
                            <div class="tp-caption large_bold_white_med   tp-resizeme" 
                                 id="slide-15-layer-17" 
                                 data-x="72" 
                                 data-y="180" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:-50px;opacity:0;s:1000;s:1000;" 
                                data-start="4400" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 21; white-space: nowrap;   color: rgba(255, 255, 255, 1.00);font-family:Arial;border-color:rgba(255, 214, 88, 1.00);">
<p> 
<strong> - </strong> {{trans("slides.second_one")}}
</p>

<p> 
<strong> - </strong> {{trans("slides.second_two")}}
</p>

<p> 
<strong> - </strong> {{trans("slides.second_three")}}
</p>

<p> 
<strong> - </strong> {{trans("slides.second_four")}}
</p>

   </div>

                            
                            <!-- LAYER NR. 24 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-15-layer-24" 
                                 data-x="29" 
                                 data-y="410" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:1300;s:1300;" 
                                data-start="5700" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 28; white-space: nowrap; font-size: 12px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><a class="link link-home-slider-blue" href="#">{{trans("slides.more_info")}}</a> </div>
                        </li>

                        <!-- Slide (2) Ended -->
                        
                        <!--slide -->
                         <li data-index="rs-21" data-transition="cube" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="800"  data-thumb="http://static.soaptheme.net/uploads/revslider1/snapshot/bg1.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="/images/revslider1/snapshot/bg1.jpg"  alt="" title="Slider1"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                          
                      

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-4" 
                                 data-x="618" 
                                 data-y="22" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:top;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:-50px;opacity:0;s:300;s:300;" 
                                data-start="2000" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 8;"><img src="/images/revslider1/snapshot/poss8.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 5 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-5" 
                                 data-x="514" 
                                 data-y="123" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:300;s:300;" 
                                data-start="2300" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 9;"><img src="/images/revslider1/snapshot/poss6.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 6 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-6" 
                                 data-x="762" 
                                 data-y="67" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:right;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="2600" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 10;"><img src="/images/revslider1/snapshot/poss7.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 7 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-7" 
                                 data-x="723" 
                                 data-y="109" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:300;s:300;" 
                                data-start="2900" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 11;"><img src="/images/revslider1/snapshot/poss5.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 8 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-8" 
                                 data-x="606" 
                                 data-y="337" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:bottom;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="y:bottom;s:300;s:300;" 
                                data-start="3200" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 12;"><img src="/images/revslider1/snapshot/poss4.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 9 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-9" 
                                 data-x="656" 
                                 data-y="196" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:300;s:300;" 
                                data-start="3500" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 13;"><img src="/images/revslider1/snapshot/poss3.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 10 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-10" 
                                 data-x="588" 
                                 data-y="316" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:-50px;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:300;s:300;" 
                                data-start="3800" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 14;"><img src="/images/revslider1/snapshot/small_pos.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 11 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-11" 
                                 data-x="836" 
                                 data-y="265" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:right;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="4100" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 15;"><img src="/images/revslider1/snapshot/poss22.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 12 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-21-layer-12" 
                                 data-x="762" 
                                 data-y="362" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;s:300;s:300;" 
                                data-start="4400" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 16;"><img src="/images/revslider1/snapshot/pos.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>
                                
                                
                                <!-- LAYER NR. 5 -->
                            <div class="tp-caption large_bold_white_med_2   tp-resizeme" 
                                 id="slide-14-layer-5"
                                 data-x="25" 
                                 data-y="100" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:bottom;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="1700" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 9; white-space: nowrap; color: rgba(255, 255, 255, 1.00);font-family:Arial;border-color:rgba(255, 214, 88, 1.00);"><p class="caption-big-title">{{trans("slides.third_title")}}</p> </div>

                            
                            <!-- LAYER NR. 13 -->
                            <div class="tp-caption large_bold_white_med   tp-resizeme" 
                                 id="slide-14-layer-13-2"
                                 data-x="75" 
                                 data-y="180" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:top;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:300;s:300;" 
                                data-start="4100" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 17; white-space: nowrap;   color: rgba(255, 255, 255, 1.00);font-family:Arial;  border-color:rgba(255, 214, 88, 1.00);">
<p> 
<strong> - </strong> {{trans("slides.third_one")}}
</p>

<p> 
<strong> - </strong> {{trans("slides.third_two")}}
</p>

<p> 
<strong> - </strong> {{trans("slides.third_three")}}
</p>

<p> 
<strong> - </strong> {{trans("slides.third_four")}} 
</p>
</div>
                            <!-- LAYER NR. 14 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-14-layer-14-4"
                                 data-x="29" 
                                 data-y="410" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:1300;s:1300;" 
                                data-start="4400" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 18; white-space: nowrap; font-size: 12px; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 1.00);"><a class="link link-home-slider-blue" href="#">{{trans("slides.more_info")}}</a> </div>
                    
                        </li>
                        
                        <!-- SLIDE (3) Ended -->

                        <!-- SLIDE  -->
                        <li data-index="rs-8" data-transition="slideup" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="800"  data-thumb="http://static.soaptheme.net/uploads/revslider1/family/sky.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="/images/revslider1/family/sky.jpg"  alt="" title="Slider1"  data-bgposition="center top" data-bgfit="normal" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-1" 
                                 data-x="" 
                                 data-y="" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:50px;opacity:0;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="1700" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 5;"><img src="/images/revslider1/family/clouds1.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-2" 
                                 data-x="right" data-hoffset="-400" 
                                 data-y="30" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:50px;opacity:0;s:300;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="2000" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 6;"><img src="/images/revslider1/family/cloud2.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-3" 
                                 data-x="right" data-hoffset="141" 
                                 data-y="137" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:1000;y:360;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;" 
                                 data-transform_out="opacity:0;s:300;s:300;" 
                                data-start="2300" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 7;"><img src="/images/revslider1/family/plane1.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-4" 
                                 data-x="center" data-hoffset="" 
                                 data-y="bottom" data-voffset="120" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:50px;opacity:0;s:2000;e:Power3.easeInOut;" 
                                 data-transform_out="y:50px;opacity:0;s:300;s:300;" 
                                data-start="1400" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 8;"><img src="/images/revslider1/family/building1.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 5 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-5" 
                                 data-x="center" data-hoffset="" 
                                 data-y="bottom" data-voffset="108" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1.875;e:Linear.easeNone;" 
                                 data-transform_out="opacity:0;s:600;s:600;" 
                                data-start="0" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 9;"><img src="/images/revslider1/family/grass12.png" alt="" data-ww="2080px" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 6 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-6" 
                                 data-x="center" data-hoffset="" 
                                 data-y="bottom" data-voffset="" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1.875;e:Linear.easeNone;" 
                                 data-transform_out="opacity:0;s:600;s:600;" 
                                data-start="0" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 10;"><img src="/images/revslider1/family/road.jpg" alt="" data-ww="auto" data-hh="107px" data-no-retina> </div>

                            <!-- LAYER NR. 7 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-7" 
                                 data-x="center" data-hoffset="" 
                                 data-y="bottom" data-voffset="96" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="opacity:0;s:1.875;e:Linear.easeNone;" 
                                 data-transform_out="opacity:0;s:600;s:600;" 
                                data-start="0" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 11;"><img src="/images/revslider1/family/tile.png" alt="" data-ww="2084px" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 8 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-8" 
                                 data-x="center" data-hoffset="" 
                                 data-y="bottom" data-voffset="10" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:left;s:2500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="2600" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 12;"><img src="/images/revslider1/family/car1.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                            <!-- LAYER NR. 9 -->
                            <div class="tp-caption   tp-resizeme" 
                                 id="slide-8-layer-9" 
                                 data-x="right" data-hoffset="-50" 
                                 data-y="bottom" data-voffset="10" 
                                            data-width="['none','none','none','none']"
                                data-height="['none','none','none','none']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:-50px;opacity:0;s:2000;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:300;s:300;" 
                                data-start="2900" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 13;"><img src="/images/revslider1/family/family1.png" alt="" data-ww="auto" data-hh="auto" data-no-retina> </div>

                           
                            <!-- LAYER NR. 11 -->

            <div class="tp-caption large_bold_white_med_2   tp-resizeme" 
                                 id="slide-14-layer-6"
                                 data-x="40" 
                                 data-y="100" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:-50px;opacitys:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:50px;opacity:0;s:300;s:300;" 
                                data-start="3500" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                            

                                
                                style="z-index: 19; white-space: nowrap; color: rgba(255, 255, 255, 1.00);font-family:Arial; text-align: center; border-color:rgba(255, 214, 88, 1.00);"><p class="caption-big-title">{{trans("slides.fourth_title")}} </div>

                            <!-- LAYER NR. 12 -->
                                <div class="tp-caption large_bold_white_med   tp-resizeme" 
                                 id="slide-8-layer-12" 
                                 data-x="75" 
                                 data-y="180" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="y:top;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:300;s:300;" 
                                data-start="4100" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on"

                                style="z-index: 17; white-space: nowrap;   color: rgba(255, 255, 255, 1.00);font-family:Arial;  border-color:rgba(255, 214, 88, 1.00);">
 
<p> 
<strong> - </strong> {{trans("slides.fourth_one")}} 
</p>

<p> 
<strong> - </strong> {{trans("slides.fourth_two")}} 
</p>

<p> 
<strong> - </strong> {{trans("slides.fourth_three")}} 
</p>

<p> 
<strong> - </strong> {{trans("slides.fourth_four")}} 
</p>
</div>

                            <!-- LAYER NR. 13 -->
                            <a href="#" class="tp-caption largewhitebg_button1_blue   tp-resizeme" 
                                 id="slide-8-layer-13" 
                                 data-x="65" 
                                 data-y="410" 
                                            data-width="['auto']"
                                data-height="['auto']"
                                data-transform_idle="o:1;"
                     
                                 data-transform_in="x:left;s:1500;e:Power3.easeInOut;" 
                                 data-transform_out="x:-50px;opacity:0;s:300;s:300;" 
                                data-start="4100" 
                                data-splitin="none" 
                                data-splitout="none" 
                                data-responsive_offset="on" 

                                
                                style="z-index: 17;">{{trans("slides.more_info")}}</a>

                            
                        </li>
                        
                  
                    </ul>
                </div>
            </div>
        </div>      
       

        
        @endif
       
