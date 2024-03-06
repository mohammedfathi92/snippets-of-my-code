<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 4/6/16
 * Time: 2:29 AM
 */

?>
@extends("frontend.layout.master")
@section("content")
    <div class="col-lg-8">
    @if($data)
        @foreach($data as $post)
            <article>
                <div class="post-image">
                    <div class="post-heading">
                        <h3><a href="{{url("post/".$post->post_slug)}}">{{$post->post_title}}</a></h3>
                    </div>
                    <img src="/assets/img/dummies/blog/img1.jpg" alt=""/>
                </div>
                <p>
                   {!!  str_limit($post->post_body,100) !!}
                </p>
                <div class="bottom-article">
                    <ul class="meta-post">
                        <li><i class="icon-calendar"></i><a href="#"> {{date("Y M d",strtotime($post->created_at))}}</a></li>
                        <li><i class="icon-user"></i><a href="#"> {{ $post->writer }}</a></li>
                        <li><i class="icon-folder-open"></i><a href="#"> {{$post->category_name}}</a></li>
                        <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                    </ul>
                    <a href="#" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
                </div>
            </article>
        @endforeach
            <div id="pagination">
                <span class="all">Page 1 of 3</span>
                <span class="current">1</span>
                <a href="#" class="inactive">2</a>
                <a href="#" class="inactive">3</a>
            </div>
    @endif
    </div>
@stop
