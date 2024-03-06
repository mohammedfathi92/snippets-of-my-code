@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($tax_class, ['url' => url($resource_url.'/'.$tax_class->hashed_id),'method'=>$tax_class->exists?'PUT':'POST','files'=>false,'class'=>'ajax-form']) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::text('name','Payment::attributes.tax_class.name',true,$tax_class->name,
                        ['help_text'=>'']) !!}
                        {!! PackagesForm::formButtons(trans('Packages::labels.save',['title' => $title_singular]), [], ['show_cancel' => false])  !!}
                    </div>

                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
