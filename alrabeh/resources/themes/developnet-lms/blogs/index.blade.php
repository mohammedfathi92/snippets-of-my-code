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
					      <div class="row blogs-content">
					        <div class="col-md-6 col-lg-4">
					          <div class="post">
					            <div class="post-img">
					              <a href="#"><img src="/assets/themes/developnet-lms/img/01.jpg"></a>
					            </div>
					            <div class="post-date">
					              <span>25</span> <span>Agust</span>
					            </div>
					            <div class="post-heading">
					              <h2><a href="#">Music Playing Featured Technologies For Child and Adults</a></h2>
					              <p class="text-justify">By the same illusion which lifts the horizon of the sea to the level of the the sable cloud beneath was dished out and the car seemed to float in the middle of an dme…</p>
					            </div>
					            <div class="post-read-more">
					              <a href="blog.html">
					              	@lang('developnet-lms::labels.links.link_read_more')
					              </a>
					            </div>
					          </div>
					        </div>
					        <div class="col-md-6 col-lg-4">
					          <div class="post">
					            <div class="post-img">
					              <a href="#"><img src="/assets/themes/developnet-lms/img/03.jpg"></a>
					            </div>
					            <div class="post-date">
					              <span>25</span> <span>Agust</span>
					            </div>
					            <div class="post-heading">
					              <h2><a href="#">Music Playing Featured Technologies For Child and Adults</a></h2>
					              <p class="text-justify">By the same illusion which lifts the horizon of the sea to the level of the the sable cloud beneath was dished out and the car seemed to float in the middle of an dme…</p>
					            </div>
					            <div class="post-read-more">
					              <a href="blog.html">
					              	@lang('developnet-lms::labels.links.link_read_more')
					              </a>
					            </div>
					          </div>
					        </div>
					        <div class="col-md-6 col-lg-4">
					          <div class="post">
					            <div class="post-img">
					              <a href="#"><img src="/assets/themes/developnet-lms/img/02.jpg"></a>
					            </div>
					            <div class="post-date">
					              <span>25</span> <span>Agust</span>
					            </div>
					            <div class="post-heading">
					              <h2><a href="#">Music Playing Featured Technologies For Child and Adults</a></h2>
					              <p class="text-justify">By the same illusion which lifts the horizon of the sea to the level of the the sable cloud beneath was dished out and the car seemed to float in the middle of an dme…</p>
					            </div>
					            <div class="post-read-more">
					              <a href="blog.html">
					              	@lang('developnet-lms::labels.links.link_read_more')
					              </a>
					            </div>
					          </div>
					        </div>
					        <div class="col-md-6 col-lg-4">
					          <div class="post">
					            <div class="post-img">
					              <a href="#"><img src="/assets/themes/developnet-lms/img/02.jpg"></a>
					            </div>
					            <div class="post-date">
					              <span>25</span> <span>Agust</span>
					            </div>
					            <div class="post-heading">
					              <h2><a href="#">Music Playing Featured Technologies For Child and Adults</a></h2>
					              <p class="text-justify">By the same illusion which lifts the horizon of the sea to the level of the the sable cloud beneath was dished out and the car seemed to float in the middle of an dme…</p>
					            </div>
					            <div class="post-read-more">
					              <a href="blog.html">
					              	@lang('developnet-lms::labels.links.link_read_more')
					              </a>
					            </div>
					          </div>
					        </div>
					        <div class="col-md-6 col-lg-4">
					          <div class="post">
					            <div class="post-img">
					              <a href="#"><img src="/assets/themes/developnet-lms/img/01.jpg"></a>
					            </div>
					            <div class="post-date">
					              <span>25</span> <span>Agust</span>
					            </div>
					            <div class="post-heading">
					              <h2><a href="#">Music Playing Featured Technologies For Child and Adults</a></h2>
					              <p class="text-justify">By the same illusion which lifts the horizon of the sea to the level of the the sable cloud beneath was dished out and the car seemed to float in the middle of an dme…</p>
					            </div>
					            <div class="post-read-more">
					              <a href="blog.html">
					              	@lang('developnet-lms::labels.links.link_read_more')
					              </a>
					            </div>
					          </div>
					        </div>
					        <div class="col-md-6 col-lg-4">
					          <div class="post">
					            <div class="post-img">
					              <a href="#"><img src="/assets/themes/developnet-lms/img/03.jpg"></a>
					            </div>
					            <div class="post-date">
					              <span>25</span> <span>Agust</span>
					            </div>
					            <div class="post-heading">
					              <h2><a href="#">Music Playing Featured Technologies For Child and Adults</a></h2>
					              <p class="text-justify">By the same illusion which lifts the horizon of the sea to the level of the the sable cloud beneath was dished out and the car seemed to float in the middle of an dme…</p>
					            </div>
					            <div class="post-read-more">
					              <a href="blog.html">
					              	@lang('developnet-lms::labels.links.link_read_more')
					              </a>
					            </div>
					          </div>
					        </div>
					      </div>
					      <hr>
					      <div class="row">
					        <ul class="pagination">
					          <li class="page-item"><a class="page-link" href="#">
					          	@lang('developnet-lms::labels.spans.span_previous')
					          </a></li>
					          <li class="page-item"><a class="page-link" href="#">1</a></li>
					          <li class="page-item active"><a class="page-link" href="#">2</a></li>
					          <li class="page-item"><a class="page-link" href="#">3</a></li>
					          <li class="page-item"><a class="page-link" href="#">
					          	@lang('developnet-lms::labels.spans.span_next')
					          </a></li>
					        </ul>
					      </div>
					    </div>  
					  </section>
				</div>
				@include('partials.sidebar')
			</div>
		</div>
	</section>


@endsection
 