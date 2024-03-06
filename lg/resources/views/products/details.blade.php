<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 7/28/16
 * Time: 11:16 PM
 */
?>

<div class="thumbnail col-md-5">

    @if($data->photo && Storage::disk('uploads')->has("small/".$data->photo))
        <img src="{{url("images/sm/".$data->photo)}}" class="img-thumbnail img-bordered"
             alt="">
    @else
        <img src="/assets/images/no-product-image.jpg" class="img-thumbnail img-bordered"
             alt="">
    @endif

</div>
<div class="col-md-7">
    <div class="form-group">
        <label for="name" class="control-label col-md-3"><strong>{{trans('products.label_name')}}</strong></label>
        <p class="col-md-7"><span>{{$data->name}}</span></p>
    </div>
    {{--<div class="form-group">
        <label for="name" class="control-label col-md-3"><strong>{{trans('products.price')}}</strong></label>
        <p class="col-md-7">
            @if($data->promotion)
                <span style="text-decoration: line-through;color:red">
                                                {{number_format($data->price)}} {{trans("products.currency_symbol") }}</span>
                <br>
                {{number_format($data->promotion)}} {{trans("products.currency_symbol") }}
            @else
                {{number_format($data->price)}} {{trans("products.currency_symbol") }}
            @endif
        </p>
    </div>--}}
    <div class="form-group">
        <label for="name" class="control-label col-md-12"><strong>{{trans('products.label_details')}}</strong></label>
        <p class="col-md-12">
        <pre>{{$data->details}}</pre>
        </p>
    </div>

</div>
<div class="clearfix"></div>

