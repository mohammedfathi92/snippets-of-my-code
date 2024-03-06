<div class="photo-gallery style1" id="photo-gallery1" data-animation="slide" data-sync="#image-carousel1">
    <ul class="slides">
        @foreach($gallery as $image)
            <li><img class="img-responsive" src="{{url("files/$image->name?size=900,500&encode=jpg")}}"
                     alt="{{$room->name}}"/></li>
        @endforeach
        @if($room->embed_video)
            <li>
                <div class="embed-container">
                    {!! $room->embed_video !!}
                </div>

            </li>
        @endif


    </ul>
</div>
<div class="image-carousel style1" id="image-carousel1" data-animation="slide" data-item-width="70"
     data-item-margin="10" data-sync="#photo-gallery1">
    <ul class="slides">
        @foreach($gallery as $image)
            <li><img class="img-responsive" src="{{url("files/$image->name?size=70,70&encode=jpg")}}"
                     alt="{{$room->name}}"/></li>
        @endforeach
        @if($room->embed_video)
            <li><img src="/assets/images/video-thumbnail.png" alt=""></li>
        @endif
    </ul>
</div>