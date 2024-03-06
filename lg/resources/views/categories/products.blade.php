@extends('layouts.app')
@section('content')
    <div class="projects-sort">
        <span class="projects-sort-label">{{trans('products.projects_sort_by')}} : </span>
        <div class="inline-block dropdown">
          <span class="dropdown-toggle" id="projects-menu" data-toggle="dropdown" aria-expanded="false" role="button">
              {{$category->name}}
              <i class="icon md-chevron-down" aria-hidden="true"></i>
          </span>
            <ul class="dropdown-menu animation-scale-up animation-top-left animation-duration-250"
                aria-labelledby="projects-menu" role="menu">
                @if($menuCategories)
                    @foreach($menuCategories as $cat)
                        @if($cat->id !=$category->id)
                            <li role="presentation">
                                <a href="{{url('products/category/'.$cat->id)}}" role="menuitem"
                                   tabindex="-1">{{$cat->name}}</a>
                            </li>
                        @endif
                    @endforeach
                @endif

            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="projects-wrap">
        @if($data && count($data))
            <ul class="blocks blocks-100 blocks-xlg-5 blocks-md-4 blocks-sm-3 blocks-xs-2" data-plugin="animateList"
                data-child=">li">

                @foreach($data as $i=>$product)
                    <li class="animation-scale-up"
                        style="animation-fill-mode: backwards; animation-duration: 250ms; animation-delay: {{$i*50}}ms;">
                        <div class="panel">
                            <figure class="overlay overlay-hover animation-hover">

                                @if($product->photo && Storage::disk('uploads')->has("small/".$product->photo))
                                    <img src="{{url("images/sm/".$product->photo)}}" class=" caption-figure"
                                         alt="">
                                @else
                                    <img src="/assets/images/no-product-image.jpg" class="caption-figure"
                                         alt="">
                                @endif


                                <figcaption
                                        class="overlay-panel overlay-background overlay-fade text-center vertical-align">

                                    <button type="button" modal data-url="{{url('products/details/'.$product->id)}}"
                                            class="btn btn-inverse project-button waves-effect waves-light"
                                            data-target="#productDetailsModal" data-toggle="modal">
                                        {{trans('products.link_view_details')}}
                                    </button>
                                </figcaption>
                            </figure>
                            <div class="text-truncate text-center">{{$product->name}}</div>
                        </div>
                    </li>

                @endforeach
            </ul>
        @else
            <p class="alert alert-warning">{{trans("products.no_data")}}</p>
        @endif
    </div>
    {!! $data->links() !!}

    <div class="modal fade" id="productDetailsModal" aria-hidden="true" aria-labelledby="productDetailsModal"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="modalContent">

                </div>

            </div>
        </div>
    </div>
@endsection