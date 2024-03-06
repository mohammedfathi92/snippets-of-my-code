
@php
$content = json_decode($block->content);
$type = "";
if(!empty($content->data_type)){
  $type = $content->data_type;

}

if($type !== 'countries' || $type !== 'country_items' || $type !== 'cities' || $type !== 'city_items' ){



  if(!empty($content->by_ids) && $content->by_ids == 1 && !empty($content->topics) && is_array($content->topics) ){

    switch ($type) {
      case 'hotels':

      $data = \Sirb\Hotel::whereIn('id', $content->topics);
      break;

      case 'places':
      $data = \Sirb\Place::whereIn('id', $content->topics);

      break;
      case 'packages':

      $data = \Sirb\Package::whereIn('id',$content->topics);

      break;

      case 'packagesType':
      $data = \Sirb\PackageType::whereIn('id',$content->topics);

      break;

      case 'articles':
      $data = \Sirb\Article::whereIn('id',$content->topics);

      break;

      default: $data = NULL;
    }


  }else{


    switch ($type) {
      case 'hotels':

      $data = \Sirb\Hotel::published();
      break;

      case 'places':
      $data = \Sirb\Place::published();

      break;
      case 'packages':

      $data = \Sirb\Package::published();

      break;

      case 'packagesType':
      $data = \Sirb\PackageType::published();

      break;

      case 'articles':
      $data = \Sirb\Article::published();

      break;

      default: $data = \Sirb\Category::published();
    }

    if(!empty($data) && $type != "articles"){

      if (!empty($block->country_id)) {

       $data->where("country_id", $block->country_id);



     }
     if(!empty($block->city_id) && $type != 'packages' && $type != 'packagesType' && $type != 'articles' && is_int($block->city_id)){
      $data->where("city_id", $block->city_id);
    }

  }
  if(!empty($data) && $type == "articles"){

    if (!empty($block->country_id)) {


     $data->whereHas("category", function ($q) use ($block)  {
      $q->where("country_id", $block->country_id);
    });

   }
   if(!empty($block->category_id)){
    $data->where("category_id", $block->category_id);

  }
}



if(!empty($content->order_stars) && $type == "packages"){
  $data->where('level', $content->order_stars);
}


if(!empty($content->order_stars) && $type == "hotels"){
  $data->where('stars', $content->order_stars);
}

if(!empty($content->order_comment) && $content->order_comment == 1){
  $data->withCount('comments')->orderBy('comments_count', 'desc');
}

if(!empty($content->order_review) && $content->order_review == 1){
  $data->withCount('reviews')->orderBy('reviews_count', 'desc');
}


}

}



@endphp

@if(!empty($content->only_text) && $content->only_text == 1)
<hr>
<!--End Blog area-->
<!--start tech-space-area-->
<section class="tech-space-area" id="specs">
  <div class="container">

    <div class="my_right_div">
      @if(!empty($content->title))
      <h2 style="line-height: 17px;">{{$content->title}}</h2>
      @endif
      @if(!empty($content->description))
      <p>{{$content->description}}</p>
      @endif
    </div>
    <br>
    <div class="row tech-space">
      @if($type == "hotels")
      @foreach($data->take($block->amount)->get() as $hotel)
      <div class="col-md-3">
        <p><a href="{{route("hotels.show",['id'=>$hotel->id,'slug'=>make_slug($hotel->name)])}}">{{ $hotel->name }}</a></p>
        <div  data-placement="bottom" data-toggle="tooltip"
        class="five-stars-container" title="{{trans_choice("hotels.hotel_stars_option",$hotel->stars)}}">
        <div id="stars-existing" class="star" data-rating="4">
          <span class="fa-star fa" style="color: #ffa825;"></span>
          <span class="{{($hotel->stars > 1)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
          <span class="{{($hotel->stars > 2)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
          <span class="{{($hotel->stars > 3)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
          <span class="{{($hotel->stars > 4)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
          <span> ( {{trans_choice("hotels.hotel_stars_option",$hotel->stars)}} ) </span>
        </div>
      </div>
      <p><small class="my-location"><i class="fa fa-map-marker"></i> {{$hotel->country->name}} - {{$hotel->city->name}} </small></p>
    </div>
    @endforeach
    @endif

    @if($type == "places")
    @foreach($data->take($block->amount)->get() as $place)
    <div class="col-md-3">
      <p><a href="{{\LaravelLocalization::localizeURL("places/{$place->id}/".make_slug($place->name))}}">{{ $place->name }}</a></p>

      <p><small class="my-location"><i class="fa fa-map-marker"></i> {{$place->country->name}} - {{$place->city->name}} </small></p>
    </div>
    @endforeach
    @endif

    @if($type == "packages")
    @foreach($data->take($block->amount)->get() as $package)
    <div class="col-md-3">
      <p><a href="{{\LaravelLocalization::localizeURL("packages/{$package->id}/".make_slug($package->name))}}">{{ $package->name }}</a></p>
      <div  data-placement="bottom" data-toggle="tooltip"
      class="five-stars-container" title="{{trans_choice("hotels.hotel_stars_option",$package->stars)}}">
      <div id="stars-existing" class="star" data-rating="4">
        <span class="fa-star fa" style="color: #ffa825;"></span>
        <span class="{{($package->level > 1)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
        <span class="{{($package->level > 2)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
        <span class="{{($package->level > 3)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
        <span class="{{($package->level > 4)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
        <span> ( {{trans_choice("hotels.hotel_stars_option",$package->level)}} ) </span>
      </div>
    </div>
    <p><small class="my-location"><i class="fa fa-map-marker"></i> {{$package->country->name}}</small></p>
  </div>
  @endforeach
  @endif

  @if($type == "packagesType")
  @foreach($data->take($block->amount)->get() as $packagesType)
  <div class="col-md-3">
    <p><a href="{{route("hotels.show",['id'=>$packagesType->id,'slug'=>make_slug($packagesType->name)])}}">{{ $packagesType->name }}</a></p>
  </div>
  @endforeach
  @endif

  @if($type == "articles")
  @foreach($data->take($block->amount)->get() as $article)
  <div class="col-md-3">
    <p><a href="{{\LaravelLocalization::localizeURL("guide/{$article->category->id}/{$article->id}/".make_slug($article->name))}}">{{ $article->name }}</a></p>
  </div>
  @endforeach
  @endif

</div>
</div>
</section>
<!--End tech-space-area-->
<!--start find-store-->
@else
<section class="blog-area form-blog" id="block_{{$block->id}}">
  <div class="container">

    <div class="section-title">
      @if(!empty($content->title))
      <h2 style="line-height: 17px;">{{$content->title}}</h2>
      @endif
      @if(!empty($content->description))
      <p>{{$content->description}}</p>
      @endif
    </div>

    <div class="row blogs pr-blog">

      @if(!is_null($data))

      @if($type == "hotels")

      @foreach($data->take($block->amount)->get() as $hotel)


      <div class="col-md-3 col-sm-12" style="margin-top: 30px; max-height: 451px; min-height: 451px;">
        <div class="blog-item wow fadeIn animated" data-wow-delay="0s" data-wow-duration="1500ms">
          <a href="{{route("hotels.show",['id'=>$hotel->id,'slug'=>make_slug($hotel->name)])}}" class="img">

            <img class="my_img par_div" src="{{url("files/{$hotel->photo}?size=170,270&encode=jpg")}}" alt="{{$hotel->name}}" >

            <div class="badge_save"><p>{{trans('pages.label_special_offers')}}</p>
             {{-- <strong>{{($hotel->offer_price / $hotel->price)*100}} %</strong> --}}</div>


             <div class="ch_div">
              <div  data-placement="bottom" data-toggle="tooltip"
              class="five-stars-container" title="{{trans_choice("hotels.hotel_stars_option",$hotel->stars)}}">
              <div id="stars-existing" class="star" data-rating="4">
                <span class="fa-star fa" style="color: #ffa825;"></span>
                <span class="{{($hotel->stars > 1)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
                <span class="{{($hotel->stars > 2)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
                <span class="{{($hotel->stars > 3)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
                <span class="{{($hotel->stars > 4)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
                <span style="color: #fff"> ( {{trans_choice("hotels.hotel_stars_option",$hotel->stars)}} ) </span>
              </div>
            </div>
          </div>
        </a>
        <div class="texts" style="padding-bottom: 10px;">
          <a href="{{route("hotels.show",['id'=>$hotel->id,'slug'=>make_slug($hotel->name)])}}">
            <h4 class="th-h2" style="line-height: 18px;">{{$hotel->name}}</h4></a>
            <small class="my-location"><i class="fa fa-map-marker"></i> {{$hotel->country->name}} - {{$hotel->city->name}} </small>
            <p class="my_text"> {!! str_limit(strip_tags($hotel->description),200) !!} </p>
            <center><a href="{{route("hotels.show",['id'=>$hotel->id,'slug'=>make_slug($hotel->name)])}}" class="btn product-btn pr-2-btn active btn_c">{{trans("hotels.btn_details")}}</a></center>
          </div>
        </div>
      </div>


      @endforeach

      @endif

      @if($type == "places")
      @foreach($data->take($block->amount)->get() as $place)
      <div class="col-md-3 col-sm-12" style="margin-top: 30px; max-height: 455px; min-height: 455px;">
        <div class="blog-item wow fadeIn animated" data-wow-delay="0s" data-wow-duration="1500ms">
          <a href="{{\LaravelLocalization::localizeURL("places/{$place->id}/".make_slug($place->name))}}" class="img">
            <img class="my_img par_div" src="{{url("files/{$place->photo}?size=270,160&encode=jpg")}}" alt="{{$place->name}}" >

          </a>
          <div class="texts" style="padding-bottom: 10px;">
            <h2 class="th-h2" style="line-height: 17px;"><a href="{{\LaravelLocalization::localizeURL("places/{$place->id}/".make_slug($place->name))}}">{{$place->name}}</a></h2>
            <small class="my-location"><i class="fa fa-map-marker"></i> {{$place->country->name}} - {{$place->city->name}}</small>
            <p class="my_text"> {!! str_limit(strip_tags($place->description),200) !!} </p>
            <center><a href="#" class="btn product-btn pr-2-btn btn_c active">{{trans("places.btn_show")}}</a></center>
          </div>
        </div>
      </div>
      @endforeach
      @endif


      @if($type == "packages")
      @foreach($data->take($block->amount)->get() as $package)
      <div class="col-md-3 col-sm-12" style="margin-top: 30px; max-height: 401px; min-height: 401px;">
        <div class="blog-item wow fadeIn animated" data-wow-delay="0s" data-wow-duration="1500ms">
          <a href="{{\LaravelLocalization::localizeURL("packages/{$package->id}/".make_slug($package->name))}}" class="img">
            <img class="my_img par_div" src="{{url("files/$package->photo?size=270,160&encode=jpg")}}" alt="{{$package->name}}" >
            <div class="badge_save"><p>{{trans('pages.label_special_offers')}}</p>
             {{-- <strong>{{($hotel->offer_price / $hotel->price)*100}} %</strong> --}}</div>
             <div class="ch_div">
              <div  data-placement="bottom" data-toggle="tooltip"
              class="five-stars-container" title="{{trans_choice("hotels.hotel_stars_option",$package->level)}}">
              <div id="stars-existing" class="star" data-rating="4">
                <span class="fa-star fa" style="color: #ffa825;"></span>
                <span class="{{($package->level > 1)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
                <span class="{{($package->level > 2)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
                <span class="{{($package->level > 3)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
                <span class="{{($package->level > 4)? 'fa-star fa':'fa-star-o fa'}}" style="color: #ffa825;"></span>
                <span style="color: #fff"> ( {{trans_choice("hotels.hotel_stars_option",$package->level)}} ) </span>
                @if($package->adults_count)
                <span style="color: #fff;" class="text-left"> {{trans("packages.adults_count",['count'=>$package->adults_count])}} </span>
                @endif
              </div>
            </div>
          </div>
        </a>
        <div class="texts" style="padding-bottom: 10px;">
          <h2 class="th-h2" style="line-height: 17px;"><a href="{{\LaravelLocalization::localizeURL("packages/{$package->id}/".make_slug($package->name))}}">{{$package->name}}</a></h2>
          <small class="my-location"><i class="fa fa-map-marker"></i> {{$package->country->name}}</small>
          <hr class="my_hr">
          <center><a href="{{\LaravelLocalization::localizeURL("packages/type/{$package->type->id}/".make_slug($package->type->name))}}">{{$package->type->name}}</a></center>
          <center><a href="{{\LaravelLocalization::localizeURL("packages/{$package->id}/".make_slug($package->name))}}" class="btn product-btn pr-2-btn btn_c active">{{trans("packages.btn_show_more")}}</a></center>
        </div>
      </div>
    </div>
    @endforeach
    @endif

    @if($type == "packagesType")
    @foreach($data->take($block->amount)->get() as $packageType)
    <div class="col-md-3 col-sm-12" style="margin-top: 30px; max-height: 356px; min-height: 356px;">
      <div class="blog-item wow fadeIn animated" data-wow-delay="0s" data-wow-duration="1500ms">
        <a href="{{\LaravelLocalization::localizeURL("packages/type/{$packageType->id}/".make_slug($packageType->name))}}" class="img">
          <img class="my_img par_div" src="{{url("files/$packageType->photo?size=270,160&encode=jpg")}}" alt="{{$packageType->name}}" >


        </a>
        <div class="texts" style="padding-bottom: 10px;">
          <h2 class="th-h2" style="line-height: 17px;"><a href="{{\LaravelLocalization::localizeURL("packages/type/{$packageType->id}/".make_slug($packageType->name))}}"> {{$packageType->name}} </a></h2>
          <small class="my-location"><i class="fa fa-map-marker"></i> {{$packageType->country->name}}</small>
          <hr class="my_hr">

          <center><a href="{{\LaravelLocalization::localizeURL("packages/type/{$packageType->id}/".make_slug($packageType->name))}}" class="btn product-btn pr-2-btn btn_c active">{{trans("packages.btn_show_more")}}</a></center>
        </div>
      </div>
    </div>
    @endforeach
    @endif

    @if($type == "articles")
    @foreach($data->take($block->amount)->get() as $article)
    <div class="col-md-3 col-sm-12" style="margin-top: 30px; max-height: 439px; min-height: 439px;">
      <div class="blog-item wow fadeIn animated" data-wow-delay="0s" data-wow-duration="1500ms">
        <a href="{{\LaravelLocalization::localizeURL("guide/{$article->category->id}/{$article->id}/".make_slug($article->name))}}" class="img">
          <img class="my_img par_div" src="{{url("files/$article->photo?size=270,160&encode=jpg")}}" alt="" >


        </a>
        <div class="texts" style="padding-bottom: 10px;">
          <h2 class="th-h2" style="line-height: 17px;"><a href="{{\LaravelLocalization::localizeURL("guide/{$article->category->id}/{$article->id}/".make_slug($article->name))}}">{{$article->name}}</a></h2>

          <p class="my_text">  {!! str_limit(strip_tags($article->description),200) !!} </p>
          <center><a href="#" class="btn product-btn pr-2-btn btn_c active">{{trans("packages.btn_show_more")}}</a></center>
        </div>
      </div>
    </div>
    @endforeach
    @endif


    @endif

    @if($type == "cities")
    @php
 if(!empty($content->by_cities_ids) && $content->by_cities_ids == 1 && !empty($content->citiesIds)){
  $cities = \Sirb\City::whereIn('id', $content->citiesIds)->get();
 }else{
    $cities = \Sirb\City::where('status', 1)->where('country_id',$block->country_id )->take($block->amount)->get();
    }
    @endphp




    @foreach($cities as $city)

    <div class="col-md-3 col-sm-12" style="margin-top: 30px; max-height: 350px; min-height: 350px;">
      <div class="blog-item wow fadeIn animated" data-wow-delay="0s" data-wow-duration="1500ms">
        <a href="{{\LaravelLocalization::localizeURL("city/$city->id/".make_slug($city->name))}}" class="img">
          <img class="my_img par_div" src="{{url("files/{$city->photo}?size=270,160&encode=jpg")}}" alt="{{$city->name}}" >

        </a>
        <div class="texts" style="padding-bottom: 10px;">
          <h2 class="th-h2" style="line-height: 17px;"><a href="{{\LaravelLocalization::localizeURL("city/$city->id/".make_slug($city->name))}}">{{$city->name}}</a></h2>
          <small class="my-location"><i class="fa fa-map-marker"></i> {{$city->country->name}} - {{$city->name}}</small>


          <center><a href="{{\LaravelLocalization::localizeURL("city/$city->id/".make_slug($city->name))}}" class="btn product-btn pr-2-btn btn_c active">{{trans("cities.btn_show")}}</a></center>
        </div>
      </div>
    </div>





    @endforeach

    @endif


    @if($type == "city_items" && !empty($content->place_topic))
     @php
 if(!empty($content->by_cities_ids) && $content->by_cities_ids == 1 && !empty($content->citiesIds)){
  $cities = \Sirb\City::whereIn('id', $content->citiesIds);
 }else{
    $cities = \Sirb\City::where('status', 1)->where('country_id',$block->country_id )->take($block->amount)->get();
    }
    @endphp

    @foreach($cities as $city)

    @if($content->place_topic == "places")

    <div class="col-md-3 col-sm-12" style="margin-top: 30px; max-height: 350px; min-height: 350px;">
      <div class="blog-item wow fadeIn animated" data-wow-delay="0s" data-wow-duration="1500ms">
        <a href="{{\LaravelLocalization::localizeURL("city/$city->id/".make_slug($city->name)."/places")}}" class="img">
          <img class="my_img par_div" src="{{url("files/{$city->photo}?size=270,160&encode=jpg")}}" alt="{{$city->name}}" >

        </a>
        <div class="texts" style="padding-bottom: 10px;">
          <h2 class="th-h2" style="line-height: 17px;"><a href="{{\LaravelLocalization::localizeURL("city/$city->id/".make_slug($city->name)."/places")}}">{{trans("places.country_cities_places_item",['city'=>$city->name])}}</a></h2>
          <small class="my-location"><i class="fa fa-map-marker"></i> {{$city->country->name}} - {{$city->name}}</small>

          <center><a href="{{\LaravelLocalization::localizeURL("city/$city->id/".make_slug($city->name)."/places")}}" class="btn product-btn pr-2-btn btn_c active">{{trans("cities.btn_show")}}</a></center>
        </div>
      </div>
    </div>
    @else

    <div class="col-md-3 col-sm-12" style="margin-top: 30px; max-height: 350px; min-height: 350px;">
      <div class="blog-item wow fadeIn animated" data-wow-delay="0s" data-wow-duration="1500ms">
        <a href="{{route("city.hotels",[$city->id,make_slug($city->name)])}}" class="img">
          <img class="my_img par_div" src="{{url("files/{$city->photo}?size=270,160&encode=jpg")}}" alt="{{$city->name}}" >

        </a>
        <div class="texts" style="padding-bottom: 10px;">
          <h2 class="th-h2" style="line-height: 17px;"><a href="{{route("city.hotels",[$city->id,make_slug($city->name)])}}">{{trans("hotels.country_cities_hotels_item",['city'=>$city->name])}}</a></h2>
          <small class="my-location"><i class="fa fa-map-marker"></i> {{$city->country->name}} - {{$city->name}}</small>

          <center><a href="{{route("city.hotels",[$city->id,make_slug($city->name)])}}" class="btn product-btn pr-2-btn btn_c active">{{trans("cities.btn_show")}}</a></center>
        </div>
      </div>
    </div>
    @endif
    @endforeach
    @endif

  </div>
  <a href="{{!empty($content->read_more_url)?$content->read_more_url:''}}" class="btn product-btn blog-btn">{{trans("packages.btn_show_more")}}</a>
</div>
</section>
<!--End Blog area-->

@endif

@if($type == "countries" && count(\Sirb\Country::publishedAtHome()))
<section class="blog-area form-blog" id="block_{{$block->id}}">
  <div class="container">


    <div class="section-title">
      @if(!empty($content->title))
      <h2>{{$content->title}}</h2>
      @endif
      @if(!empty($content->description))
      <p>{{$content->description}}</p>
      @endif
    </div>

    <div class="row blogs pr-blog">



      @foreach(\Sirb\Country::publishedAtHome() as $country)

      <div class="col-md-4 col-sm-12">
        <div class="blog-item wow fadeIn animated" data-wow-delay="0s" data-wow-duration="1500ms">
          <a href="{{\LaravelLocalization::localizeURL("country/{$country->id}/".make_slug($country->name))}}"
           class="hover-effect" class="img">
           <img class="img-responsive" style="height: 250; width: 371" src="{{url("/files/{$country->photo}?size=407,371&encode=jpg")}}" alt="{{$country->name}}" >


         </a>
         <div class="texts" style="padding-bottom: 10px;">
          <h2 class="th-h2" style="line-height: 17px;"><a href="{{\LaravelLocalization::localizeURL("country/{$country->id}/".make_slug($country->name))}}">{{$country->name}}</a></h2>

          <p class="my_text"><a href="{{\LaravelLocalization::localizeURL("/country/{$country->id}/".make_slug($country->name)."/hotels")}}"><i class="fa fa-h-square"></i>  {{trans("countries.country_hotels_title",['name'=>$country->name])}}</a></p>
          <hr style="margin:10px;">
          <p class="my_text"><a href="{{\LaravelLocalization::localizeURL("/country/{$country->id}/".make_slug($country->name)."/places")}}"><i class="fa fa-globe"></i>  {{trans("countries.country_places_title",['name'=>$country->name])}}</a>

          </p>
          <hr style="margin:10px;">
          <p class="my_text"><a href="{{\LaravelLocalization::localizeURL("/country/{$country->id}/".make_slug($country->name)."/packages")}}"><i class="fa fa-shopping-bag"></i>  {{trans("countries.country_packages_title",['name'=>$country->name])}}</a>
          </p>
          <br style="margin: 10px;">

          <center><a href="{{\LaravelLocalization::localizeURL("country/{$country->id}/".make_slug($country->name))}}" class="btn product-btn pr-2-btn btn_c active" > {{trans("packages.btn_show_more")}}</a> </center>


        </div>
      </div>
    </div>
    @endforeach




  </div>
  <a href="{{!empty($content->read_more_url)?$content->read_more_url:''}}" class="btn product-btn blog-btn">{{trans("packages.btn_show_more")}}</a>
</div>
</section>
<!--End Blog area-->
@endif


