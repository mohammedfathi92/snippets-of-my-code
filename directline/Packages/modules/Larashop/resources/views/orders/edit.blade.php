@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($order, ['url' => url($resource_url.'/'.$order->hashed_id),'method'=>$order->exists?'PUT':'POST','files'=>false,'class'=>'ajax-form']) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::select('status','Larashop::attributes.order.status_order', $order_statuses ,true) !!}
                        {!! PackagesForm::select('shipping[status]','Larashop::attributes.order.shipping_status', $order_statuses ,false, $order->shipping['status'] ?? '',['class'=>'']) !!}
                        {!! PackagesForm::text('shipping[tracking_number]','Larashop::attributes.order.shipping_track', false, $order->shipping['tracking_number'] ?? '',['class'=>'']) !!}
                        {!! PackagesForm::text('shipping[label_url]','Larashop::attributes.order.shipping_label', false, $order->shipping['label_url'] ?? '',['class'=>'']) !!}
                        {!! PackagesForm::select('billing[payment_status]','Larashop::attributes.order.payment_status', $payment_statuses , false, $order->billing['payment_status'] ?? '',['class'=>'']) !!}
                        {!! PackagesForm::text('billing[gateway]','Larashop::attributes.order.payment_method', false, $order->billing['gateway'] ?? '',['class'=>'']) !!}
                        {!! PackagesForm::text('billing[payment_reference]','Larashop::attributes.order.payment_reference', false, $order->billing['payment_reference'] ?? '',['class'=>'']) !!}

                        {!! PackagesForm::formButtons(trans('Packages::labels.save',['title' => $title_singular]), [], ['show_cancel' => false])  !!}
                    </div>

                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
