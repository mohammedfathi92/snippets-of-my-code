<?php
/**
 * @project     : blog
 * @file        : index.blade.php
 * @created_at  : 3/5/16 - 12:59 AM
 * @author      : Mohammed Fathi (mohammedfathi1113@gmail.com)
 **/
?>
@extends("frontend.layout.master")
@section("content")
    <div class="col-lg-8">
        <article>
            <div class="post-image">
                <div class="post-heading">
                    <h3><a href="#">This is an example of standard post format</a></h3>
                </div>
                <img src="assets/img/dummies/blog/img1.jpg" alt=""/>
            </div>
            <p>
                Qui ut ceteros comprehensam. Cu eos sale sanctus eligendi, id ius elitr saperet, ocurreret pertinacia
                pri an. No mei nibh consectetuer, semper laoreet perfecto ad qui, est rebum nulla argumentum ei. Fierent
                adipisci iracundia est ei, usu timeam persius ea. Usu ea justo malis, pri quando everti electram ei, ex
                homero omittam salutatus sed.
            </p>
            <div class="bottom-article">
                <ul class="meta-post">
                    <li><i class="icon-calendar"></i><a href="#"> Mar 23, 2013</a></li>
                    <li><i class="icon-user"></i><a href="#"> Admin</a></li>
                    <li><i class="icon-folder-open"></i><a href="#"> Blog</a></li>
                    <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                </ul>
                <a href="#" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
            </div>
        </article>
        <article>
            <div class="post-slider">
                <div class="post-heading">
                    <h3><a href="#">This is an example of slider post format</a></h3>
                </div>
                <!-- start flexslider -->
                <div id="post-slider" class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="assets/img/dummies/blog/img1.jpg" alt=""/>
                        </li>
                        <li>
                            <img src="assets/img/dummies/blog/img2.jpg" alt=""/>
                        </li>
                        <li>
                            <img src="assets/img/dummies/blog/img3.jpg" alt=""/>
                        </li>
                    </ul>
                </div>
                <!-- end flexslider -->
            </div>
            <p>
                Qui ut ceteros comprehensam. Cu eos sale sanctus eligendi, id ius elitr saperet, ocurreret pertinacia
                pri an. No mei nibh consectetuer, semper laoreet perfecto ad qui, est rebum nulla argumentum ei. Fierent
                adipisci iracundia est ei, usu timeam persius ea. Usu ea justo malis, pri quando everti electram ei, ex
                homero omittam salutatus sed.
            </p>
            <div class="bottom-article">
                <ul class="meta-post">
                    <li><i class="icon-calendar"></i><a href="#"> Mar 23, 2013</a></li>
                    <li><i class="icon-user"></i><a href="#"> Admin</a></li>
                    <li><i class="icon-folder-open"></i><a href="#"> Blog</a></li>
                    <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                </ul>
                <a href="#" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
            </div>
        </article>
        <article>
            <div class="post-quote">
                <div class="post-heading">
                    <h3><a href="#">Nice example of quote post format below</a></h3>
                </div>
                <blockquote>
                    <i class="icon-quote-left"></i> Lorem ipsum dolor sit amet, ei quod constituto qui. Summo labores
                    expetendis ad quo, lorem luptatum et vis. No qui vidisse signiferumque...
                </blockquote>
            </div>
            <div class="bottom-article">
                <ul class="meta-post">
                    <li><i class="icon-calendar"></i><a href="#"> Mar 23, 2013</a></li>
                    <li><i class="icon-user"></i><a href="#"> Admin</a></li>
                    <li><i class="icon-folder-open"></i><a href="#"> Blog</a></li>
                    <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                </ul>
                <a href="#" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
            </div>
        </article>
        <article>
            <div class="post-video">
                <div class="post-heading">
                    <h3><a href="#">Amazing video post format here</a></h3>
                </div>
                <div class="video-container">
                    <iframe src="http://player.vimeo.com/video/30585464?title=0&amp;byline=0">
                    </iframe>
                </div>
            </div>
            <p>
                Qui ut ceteros comprehensam. Cu eos sale sanctus eligendi, id ius elitr saperet, ocurreret pertinacia
                pri an. No mei nibh consectetuer, semper laoreet perfecto ad qui, est rebum nulla argumentum ei. Fierent
                adipisci iracundia est ei, usu timeam persius ea. Usu ea justo malis, pri quando everti electram ei.
            </p>
            <div class="bottom-article">
                <ul class="meta-post">
                    <li><i class="icon-calendar"></i><a href="#"> Mar 23, 2013</a></li>
                    <li><i class="icon-user"></i><a href="#"> Admin</a></li>
                    <li><i class="icon-folder-open"></i><a href="#"> Blog</a></li>
                    <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                </ul>
                <a href="#" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
            </div>
        </article>
        <div id="pagination">
            <span class="all">Page 1 of 3</span>
            <span class="current">1</span>
            <a href="#" class="inactive">2</a>
            <a href="#" class="inactive">3</a>
        </div>
    </div>


@stop
