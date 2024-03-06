@section('content')

    <div class="row">
        <div class="col-md-12">

        @php

        @endphp
            @component('components.box')
                {!! Form::model($subscription, ['url' => route('subscriptions.update_status', $subscription->hashed_id),'method'=>'PUT','files'=>false,'class'=>'ajax-form']) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::select('status','LMS::attributes.main.status',  __('LMS::attributes.main.status_options') ,true) !!}
                        

                        {!! ModulesForm::formButtons(trans('LMS::attributes.main.edit',['title' => $title_singular]), [], ['show_cancel' => false])  !!}
                    </div>

                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
