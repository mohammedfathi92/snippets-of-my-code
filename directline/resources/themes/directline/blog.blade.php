@extends('layouts.master')

@section('editable_content')
    @include('partials.page_header', ['item'=>$blog, 'content'=> (empty($blog->rendered)?('<h1>'.$blog->title.'</h1>'):$blog->rendered).(isset($title)?('<br/>'.$title):'')])

    <div class="container padding-bottom-3x mb-1">
        <div class="row {{ !in_array($blog->template, ['right', 'left'])?'justify-content-center':'' }}">
            <div class="{{ !in_array($blog->template, ['right', 'left'])?'col-lg-10':'col-xl-9 col-lg-8' }} {{ $blog->template =='left' ? 'order-lg-2':'' }}">
                @forelse($posts as $post)
                    <article class="row">
                        <div class="col-md-3">
                            <ul class="post-meta">
                                <li><i class="icon-clock"></i>&nbsp;{{ format_date($post->published_at) }}</li>
                                <li><i class="icon-head"></i>&nbsp;{{ $post->author->name }}</li>
                                @if(count($activeTags = $post->activeTags))
                                    <li>
                                        <i class="icon-tag"></i>
                                        @foreach($activeTags as $tag)
                                            <a href="{{ route('frontend_tag', ['id' => $tag->hashed_id, 'slug' =>  \CMS::getSlugName($tag->name)]) }}">&nbsp;{{ $tag->name }}</a>,
                                        @endforeach
                                    </li>
                                @endif
                                <li>
                                    <i class="icon-folder"></i>
                                    @foreach($post->activeCategories as $category)
                                        <a href="{{ route('frontend_category', ['id' => $category->hashed_id, 'slug' =>  \CMS::getSlugName($category->name)]) }}">
                                            &nbsp;{{ $category->name }}
                                        </a>,
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9 blog-post">
                            @if($post->featured_image)
                                <a class="post-thumb" href="{{ route('frontend_single', ['slugOrId' => $post->hashed_id, 'slug_name' => \CMS::getSlugName($post->title)]) }}"><img
                                            src="{{ $post->featured_image }}"
                                            alt="Post"></a>
                            @endif

                            <h3 class="post-title">
                                <a href="{{ route('frontend_single', ['slugOrId' => $post->hashed_id, 'slug_name' => \CMS::getSlugName($post->title)]) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p>
                                {{ str_limit(strip_tags($post->rendered ),250) }}
                                <a href='{{ route('frontend_single', ['slugOrId' => $post->hashed_id, 'slug_name' => \CMS::getSlugName($post->title)]) }}' class='text-medium'>@lang('Packages-ecommerce-basic::labels.blog.read_more')</a>
                            </p>
                        </div>
                    </article>
                @empty
                    <div class="alert alert-warning">
                        <h4>@lang('Packages-ecommerce-basic::labels.blog.found')</h4>
                    </div>
                @endforelse
                {{ $posts->links('partials.paginator') }}
            </div>
            @if(in_array($blog->template, ['right', 'left']))
                <div class="col-xl-3 col-lg-4  {{ $blog->template =='left' ? 'order-lg-1':'' }}">
                    @include('partials.blog_sidebar')
                </div>
            @endif
        </div>
    </div>
@endsection