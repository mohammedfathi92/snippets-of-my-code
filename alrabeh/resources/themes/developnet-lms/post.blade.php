@extends('layouts.master')

@section('css')
 {!! Theme::css('css/pages.css') !!}
@endsection

@section('content')	

	@include('partials.banner', ['page_title' => $item->title])

	<section class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 blog-main">
				       	<div class="post-single">
				       		<div class="post-content">
				       			@if($featured_image)
					            <div class="post-img ">
					              <a title="{{ $item->title }}" href="{{ $featured_image }}"><img src="{{ $featured_image }}" alt="{{ $item->title }}"></a>
					           {{--    <div class="post-department">
						              <a href="#"><span>DEVELOPMENT</span></a>
						           </div> --}}
					            </div>
					            @endif
					           <div class=" post-content">
					           	 	<div class="post-heading">
					              		{{-- <h2>{{$item->title}}</h2> --}}
					              		<div class="post-meta-content">
											<ul>
												<li>
													<i class="fa fa-clock-o"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->published_at)->format('Y-m-d')
												}}
												</li>
												<li>
													<i class="fa fa-user"></i><span>
													@lang('developnet-lms::labels.spans.span_by')
													</span><a href="javascript:;" title="{{$item->author->name}}"> &nbsp;{{$item->author->name}}</a>
												</li>
												{{-- <li>
													<a href="#" title="comments"><i class="fa fa-comments-o"></i><span>4 </span></a>
												</li> --}}
											</ul>
										</div>
					             	 		{!! $item->rendered !!}
					            	</div>

					           </div>
					        </div>
					        <div class="clearfix "></div>
					      </div>
					      <br><hr>
					      @if(count($activeTags = $item->post->activeTags))
					       <div class="tags">
				       		@foreach($activeTags as $tag)
                                    <a href="{{ url('tag/'.$tag->slug) }}">{{ $tag->name }}</a>,&nbsp;
                                @endforeach
				       	</div>
				       	@endif
				       	@include('partials.media_share')
				    {{--    	<div class="course-review-comments">
				  			<ul>
				  				<li class="course-review-comment">
				  					<div class="media">
				  						<img src="/assets/themes/developnet-lms/img/user.png">
				  						<div class="media-body">
				  							<div class="comment-stars">
				  								<span>Mikle</span>
				  								<div class="review-stars">
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</div>
				  							</div>
				  							<div class="comment-title">
				  								Beautiful theme - Awesome plugin
				  							</div>
				  							<p>Admin bar avatar Minhluu
												Beautiful theme - Awesome plugin

												5 stars for this theme too. Education WP theme brings the best LMS experience ever with super friendly UX and complete eLearning features. Really satisfied.
											</p>
											<span class="reply">@lang('developnet-lms::labels.spans.span_reply_comment')</span>
											<div class="reply-form contact-form">
												<form>
									       		<div class="form-group form-inline">
									              <div class="col-lg-12">
									                <textarea class="form-control" name="’Message" placeholder="التعليق" style="height: 150px;"></textarea>
									              </div>
									              <div class="col-md-4">
									                <input type="text" class="form-control" name="Name" placeholder="الاسم">
									              </div>
									              <div class="col-md-4">
									                <input type="mail" class="form-control" name="Mail" placeholder="الايميل">
									              </div>
									              <div class="col-md-4">
									                <input type="text" class="form-control" name="Title" placeholder="عنوان التعليق">
									              </div>
									              <div class="col-lg-12">
									                <input type="submit" name="Submit" value="تعليق" title="اhvshg" class="colored-btn">
									              </div>
									            </div>
								            	</form>
								            </div>
				  						</div>
				  					</div>
				  				</li>
				  				<li class="course-review-comment">
				  					<div class="media">
				  						<img src="/assets/themes/developnet-lms/img/user.png">
				  						<div class="media-body">
				  							<div class="comment-stars">
				  								<span>Mikle</span>
				  								<div class="review-stars">
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</div>
				  							</div>
				  							<div class="comment-title">
				  								Beautiful theme - Awesome plugin
				  							</div>
				  							<p>Admin bar avatar Minhluu
												Beautiful theme - Awesome plugin

												5 stars for this theme too. Education WP theme brings the best LMS experience ever with super friendly UX and complete eLearning features. Really satisfied.
											</p>
											<span class="reply">@lang('developnet-lms::labels.spans.span_reply_comment')</span>
											<div class="reply-form contact-form">
												<form>
									       		<div class="form-group form-inline">
									              <div class="col-lg-12">
									                <textarea class="form-control" name="’Message" placeholder="التعليق" style="height: 150px;"></textarea>
									              </div>
									              <div class="col-md-4">
									                <input type="text" class="form-control" name="Name" placeholder="الاسم">
									              </div>
									              <div class="col-md-4">
									                <input type="mail" class="form-control" name="Mail" placeholder="الايميل">
									              </div>
									              <div class="col-md-4">
									                <input type="text" class="form-control" name="Title" placeholder="عنوان التعليق">
									              </div>
									              <div class="col-lg-12">
									                <input type="submit" name="Submit" value="تعليق" title="اhvshg" class="colored-btn">
									              </div>
									            </div>
								            	</form>
								            </div>
				  						</div>
				  					</div>
				  				</li>
				  				<li class="course-review-comment">
				  					<div class="media">
				  						<img src="/assets/themes/developnet-lms/img/user.png">
				  						<div class="media-body">
				  							<div class="comment-stars">
				  								<span>Mikle</span>
				  								<div class="review-stars">
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</div>
				  							</div>
				  							<div class="comment-title">
				  								Beautiful theme - Awesome plugin
				  							</div>
				  							<p>Admin bar avatar Minhluu
												Beautiful theme - Awesome plugin

												5 stars for this theme too. Education WP theme brings the best LMS experience ever with super friendly UX and complete eLearning features. Really satisfied.
											</p>
											<span class="reply">@lang('developnet-lms::labels.spans.span_reply_comment')</span>
											<div class="reply-form contact-form">
												<form>
									       		<div class="form-group form-inline">
									              <div class="col-lg-12">
									                <textarea class="form-control" name="’Message" placeholder="التعليق" style="height: 150px;"></textarea>
									              </div>
									              <div class="col-md-4">
									                <input type="text" class="form-control" name="Name" placeholder="الاسم">
									              </div>
									              <div class="col-md-4">
									                <input type="mail" class="form-control" name="Mail" placeholder="الايميل">
									              </div>
									              <div class="col-md-4">
									                <input type="text" class="form-control" name="Title" placeholder="عنوان التعليق">
									              </div>
									              <div class="col-lg-12">
									                <input type="submit" name="Submit" value="تعليق" title="اhvshg" class="colored-btn">
									              </div>
									            </div>
								            	</form>
								            </div>
				  						</div>
				  					</div>
				  				</li>
				  			</ul>
				  		</div>
			  			<div class="add-comment contact-form ">
					       		<h4>@lang('developnet-lms::labels.headings.text_add_comment')</h4>
					       	<form>
					       		<div class="form-group form-inline">
					              <div class="col-lg-12">
					                <textarea class="form-control" name="Message" placeholder="{{__('developnet-lms::attributes.inputs.input_comment')}}" style="height: 250px;"></textarea>
					              </div>
					              <div class="col-md-4">
					                <input type="text" class="form-control" name="Name" placeholder="{{__('developnet-lms::attributes.inputs.input_name')}}">
					              </div>
					              <div class="col-md-4">
					                <input type="mail" class="form-control" name="Mail" placeholder="{{__('developnet-lms::attributes.inputs.input_email')}}">
					              </div>
					              <div class="col-md-4">
					                <input type="text" class="form-control" name="Title" placeholder="{{__('developnet-lms::attributes.inputs.input_comment_title')}}">
					              </div>
					              <div class="col-lg-12">
					                <input type="submit" name="Submit" value="{{__('developnet-lms::attributes.inputs.btn_comment')}}" title="اhvshg" class="colored-btn">
					              </div>
					            </div>
				            </form>
				       	</div> --}}
			       	</div>
				@include('partials.sidebar')
			</div>
		</div>
	</section>


@endsection
 