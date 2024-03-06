   @extends('frontend.layouts.master')
@section("content")
   <div class="clearfix"></div>
    

    
    <!-- main content -->
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_home")}}</a></li>
            
                    <li>قارن</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->
        <!-- End Map -->
       {{--  <div class="container margin_60"> --}}

   <section class="cd-products-comparison-table">
        <header>
            <h2>{{trans("compare.text_compare_table")}}</h2>

            <div class="actions">
                <a href="#0" class="reset">Reset</a>
                <a href="#0" class="filter">Filter</a>
            </div>
        </header>


         <div class="cd-products-table">
                        <div class="features">
                            <div class="top-info">{{trans("compare.text_model")}}</div>
                            <ul class="cd-features-list">

                                <li>{{trans("compare.label_institute")}}</li>
                                 @if($attrs)
                                            @foreach($attrs as $attr)
                                            <li>$attr->name</li>
                                            @endforeach
                                            @endif
                               {{--  <li>{{trans("compare.text_country")}}</li>
                                <li>{{trans("compare.text_city")}}</li>
                                <li>{{trans("compare.text_possition")}}</li>
                                <li>{{trans("compare.text_locale_rating")}}</li>
                                <li>{{trans("compare.text_international_rating")}}</li>
                                <li>{{trans("compare.label_insurance")}}</li>
                                <li>{{trans("compare.label_house")}}</li>
                                <li>{{trans("compare.label_transport")}}</li>
                                <li>{{trans("compare.label_courses_num")}}</li>
                                <li>{{trans("compare.label_featured")}}</li> --}}
                            </ul>
                        </div> <!-- .features -->


                        <div class="cd-products-wrapper">
                            <ul class="cd-products-columns">
                                @foreach ($data as $row)
                                @php
                                $institute = \Corsata\Institute::find($row['id']);
                                @endphp
                                    <li class="product">
                                        <div class="top-info">
                                            <div class="check"></div>
                                            <img src="{{url("files/{$institute->photo}?size=200,150")}}"
                                                 alt="{{$institute->name}}">
                                            <!-- <h3>{{$institute->name}}</h3> -->
                                        </div> <!-- .top-info -->
                                    

                                        <ul class="cd-features-list">
                                            <li>{{$institute->name}}</li>
                                            @if($attrs)
                                            @foreach($attrs as $attr)
                                             @if($attr->type== 'country')

                                            <li>

                                                {{$institute->country?$institute->country->name:""}}

                                               
                                            </li>
                                            @elseif($attr->type== 'city')

                                            <li>

                                                {{$institute->city?$institute->city->name:""}}

                                               
                                            </li>
                                            @elseif($attr->type== 'location_type')
                                            
                                            <li>

                                                @if($institute->location_type == 1)

                                                {{trans_choice("institutes.institute_location_type_option",1)}}

                                                @elseif($institute->location_type == 2)

                                                {{trans_choice("institutes.institute_location_type_option",2)}}

                                                @elseif($institute->location_type == 3)

                                                {{trans_choice("institutes.institute_location_type_option",3)}}

                                                @elseif($institute->location_type == 4)

                                                {{trans_choice("institutes.institute_location_type_option",4)}}

                                                @elseif($institute->location_type == 5)

                                                {{trans_choice("institutes.institute_location_type_option",5)}}

                                                @elseif($institute->location_type == 6)

                                                {{trans_choice("institutes.institute_location_type_option",6)}}

                                                @else

                                                {{trans_choice("institutes.institute_location_type_option",7)}}

                                                @endif
                                               
                                            </li>
                                            @elseif($attr->type== 'locale_rate')
                                            <li class="rate">
                                                <span>{{($institute->local_rate?$institute->local_rate:'---')}}</span></li>
                                             @elseif($attr->type== 'international_rate')
                                            <li class="rate">
                                                <span>{{($institute->international_rate?$institute->international_rate:'---')}}</span>
                                            </li>
                                             @elseif($attr->type== 'services')
                                            <li>{{($institute->services()->where('type', 'insurance')? trans('compare.label_yes'):'---')}}</li>
                                            <li>{{($institute->services()->where('type', 'house')? trans('compare.label_yes'):'---')}}</li>
                                            <li>{{($institute->services()->where('type', 'transport')? trans('compare.label_yes'):'---')}}</li>
                                            <li>{{$institute->courses()->count()}}</li>
                                           @else
                                            <li>{{($institute->featured?"&#9989;":'---')}}</li>
                                            @endif
                                            @endforeach
                                            @endif

                                        </ul>
                                    </li> <!-- .product -->
                                @endforeach
                            </ul> <!-- .cd-products-columns -->
                        </div> <!-- .cd-products-wrapper -->

                        <ul class="cd-table-navigation">
                            <li><a href="#0" class="prev inactive">Prev</a></li>
                            <li><a href="#0" class="next">Next</a></li>
                        </ul>
                    </div> <!-- .cd-products-table -->
            

        </section> <!-- .cd-products-comparison-table -->
    <!-- end of compare content-->

       {{--  </div> --}}
        <!--End container -->



        <div id="overlay"></div>
        <!-- Mask on input focus -->

    </main>

@endsection
@section("styles")

 <!--comparison-->
    <link rel="stylesheet" href="/assets/comparison/css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="/assets/comparison/css/style.css"> <!-- Resource style -->
    <link rel="stylesheet" href="/assets/comparison/css/style.rtl.css"> 
     <script src="/assets/comparison/js/modernizr.js"></script> <!-- Modernizr -->

@stop
@section("scripts")
     <script src="/assets/comparison/js/main.js"></script>
 @stop