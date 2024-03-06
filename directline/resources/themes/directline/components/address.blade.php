<div class="row mt-3">
    <div class="{{ $container??'col-md-8' }}">
        <div class="row">
            <div class="{{ isset($type)?'col-md-6':'col-md-5' }}">
                {!! PackagesForm::text($key.'[address_1]','Packages::labels.address_label.address_one',true, $object['address_1'] ?? '') !!}
            </div>
            <div class="{{ isset($type)?'col-md-6':'col-md-4' }}">
                {!! PackagesForm::text($key.'[address_2]', 'Packages::labels.address_label.address_two',false, $object['address_2'] ?? '') !!}
            </div>
            @if(isset($type))
                {!! Form::hidden($key.'[type]', $type) !!}
            @else
                <div class="col-md-3">
                    {!! PackagesForm::select($key.'[type]', 'Packages::labels.address_label.type', $addressTypes??\Settings::get('address_types',[]), true, $object['type'] ?? '') !!}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-3">
                {!! PackagesForm::text($key.'[city]', 'Packages::labels.address_label.city',true, $object['city'] ?? '') !!}
            </div>
            <div class="col-md-3">
                {!! PackagesForm::text($key.'[state]', 'Packages::labels.address_label.state',true, $object['state'] ?? '') !!}
            </div>
            <div class="col-md-3">
                {!! PackagesForm::text($key.'[zip]', 'Packages::labels.address_label.zip',true, $object['zip'] ?? '') !!}
            </div>
            <div class="col-md-3">
            {!! PackagesForm::select($key.'[country]', 'Packages::labels.address_label.country', ['SA' => __('Ecommerce::labels.checkout.saudi_arabia')], true, 'SA',['readonly']) !!}

                {{-- {!! PackagesForm::select($key.'[country]', 'Packages::labels.address_label.country', \Settings::getCountriesList(), true, $object['country'] ?? '',[], 'select2') !!} --}}
            </div>
        </div>
    </div>
</div>