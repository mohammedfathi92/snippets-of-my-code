@extends('layouts.master')

@section('css')
 {!! Theme::css('css/pages.css') !!}
@endsection

@section('content') 

    @include('partials.banner')

    <section class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <section class=" blogs-grid ">
                        <div class="container">
                              @foreach($posts as $post)
                          <div class="row blogs-content">
                          
                            <div class="col-md-12 col-lg-12">
                              <article class="post" style="padding: 10px;">
                                <div class="post-img">
                                  <a href="{{ url($post->slug) }}"><img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="max-width: 100%; height: auto; vertical-align: middle;"></a>
                                </div>
                                <div class="post-date">
                                  {{-- <span><i class="fa fa-clock-o"></i>&nbsp;</span>  --}}<span><i class="fa fa-clock-o"></i>&nbsp;{!! \Carbon\Carbon::instance($post->published_at)->diffForHumans() !!}</span>
                                </div>
                                <div class="post-heading">
                                  <h2><a href="{{ url($post->slug) }}">{{ $post->title }}</a></h2>
                                  <p class="text-justify">{{ str_limit(strip_tags($post->rendered ),250) }}</p>
                                </div>
                                <div class="post-read-more">
                                    <a href='{{ url($post->slug) }}'>@lang('developnet-lms::labels.links.link_read_more')</a>
                                
                                </div>
                              </article>
                            </div>
                 
                          </div>
                          <hr>
                           @endforeach
                          <hr>
                          <div class="row">
                         {{ $posts->links('partials.paginator') }}
                           
                          </div>
                        </div>  
                      </section>
                </div>
                @include('partials.sidebar')
            </div>
        </div>
    </section>


@endsection
 