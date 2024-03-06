                            
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
       {{--  <li class="@if($active_tab=="profile") active @endif">
            <a href="#profile" data-toggle="tab">
                @lang('corals-admin::labels.auth.profile')
            </a>
        </li> --}}
        @php \Actions::do_action('user_profile_tabs',$userLMS,$active_tab) @endphp

    </ul>
    <div class="tab-content" style="background: #fff">
        <div class="tab-pane @if($active_tab=="profile") active @endif" id="profile">
            {!! Form::model($userLMS, ['url' => route('account.update', ['user_id' => $userLMS->hashed_id]), 'method'=>'PUT','class'=>'ajax-form','files'=>true]) !!}
            <div >
                <ul class="nav nav-tabs custom" style="margin: 0 -25px">
                    <li class=" nav-item">
                        <a class="nav-link active" href="#edit_profile" data-toggle="pill"><i
                                    class="fa fa-pencil"></i> @lang('corals-admin::labels.auth.edit_profile')
                        </a>
                    </li>
                    {{--  <li>
                        <a href="#profile_addresses" data-toggle="pill"><i class="fa fa-map-marker"></i>
                            @lang('corals-admin::labels.auth.addresses')</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#reset_password" data-toggle="pill"><i class="fa fa-lock"></i>
                            @lang('corals-admin::labels.auth.auth_password')</a>
                    </li>
                    {{--<li>
                        <a href="#notification_preferences" data-toggle="pill"><i class="fa fa-bell-o"></i>
                            @lang('corals-admin::labels.auth.notification_preferences')</a>
                    </li> --}}
                </ul>
                <div class="tab-content">
                    <br>
                    <div class="tab-pane active" id="edit_profile">
                        <div class="row">
                            <div class="col-lg-6">
                                {!! ModulesForm::text('name','User::attributes.user.name',true) !!}
                                {!! ModulesForm::email('email','User::attributes.user.email',true) !!}
                                {!! ModulesForm::text('address','developnet-lms::labels.headings.text_adress',true) !!}

                                 {!! ModulesForm::file('picture',  'User::attributes.user.picture' ) !!}

                                <img src="{{ $userBase->picture }}" class="img-circle img-responsive" width="150"
                                     alt="User Picture"/>
                                <div>
                                         
                                     
                                @if($userBase->exists && $userBase->getFirstMedia('user-picture'))
                                    {!! ModulesForm::checkbox('clear',  'User::attributes.user.default_picture' ) !!}
                                @endif
                                </div>
                              
                               
                            </div>
                            <div id="country-div" class="col-lg-6">
                                
                                {!! ModulesForm::text('user_country','developnet-lms::labels.headings.text_country',false,__('developnet-lms::labels.headings.text_saudi'),['id'=>'country', 'readonly']) !!}
                                {!! ModulesForm::text('phone_country_code','User::attributes.user.phone_country_code',true,'+996',['id'=>'authy-countries', 'readonly']) !!}
                                {!! ModulesForm::text('phone_number','User::attributes.user.phone_number',true,null,['id'=>'authy-cellphone']) !!}
                                 {!! ModulesForm::textarea('properties[about]', 'LMS::attributes.main.about_user' , false, null,[
                                    'class'=>'limited-text',
                                    'maxlength'=>250,
                                    'help_text'=>'<span class="limit-counter">0</span>/250',
                                'rows'=>'4']) !!}
                               {{--  {!! ModulesForm::text('job_title','User::attributes.user.job_title') !!} --}}
                            </div>
                               
                            
                        </div>
                    </div>
                     {{--  <div class="tab-pane" id="profile_addresses">
                        @include('Settings::addresses.address_list_form', [
                        'url'=>url('users/'.$userLMS->hashed_id.'/address'),'method'=>'POST',
                        'model'=>$userLMS,
                        'addressDiv'=>'#profile_addresses'
                        ])
                    </div> --}}
                    {{--   <div class="tab-pane" id="notification_preferences">
                        @forelse(\ModulesNotification::getUserNotificationTemplates($userLMS) as $notifications_template)
                            <div class="row">
                                <div class="col-md-12">
                                    {!! ModulesForm::checkboxes(
                                    'notification_preferences['.$notifications_template->id .'][]',
                                    $notifications_template->friendly_name,
                                    false, $options = config('notification.supported_channels'),
                                    $selected = $userLMS->notification_preferences[$notifications_template->id] ?? [],
                                    ['checkboxes_wrapper'=>'span', 'label'=>['class' => 'm-r-10']])
                                    !!}
                                </div>
                            </div>
                        @empty
                            <h4>@lang('corals-admin::labels.auth.no_notification')</h4>
                        @endforelse
                    </div> --}}
                    <div class="tab-pane" id="reset_password">
                        <div class="row">
                            <div class="col-md-4">
                                {!! ModulesForm::password('password','User::attributes.user.password') !!}
                                {!! ModulesForm::password('password_confirmation','User::attributes.user.password_confirmation') !!}

                                @if(\TwoFactorAuth::isActive())
                                    {!! ModulesForm::checkbox('two_factor_auth_enabled','User::attributes.user.two_factor_auth_enabled',\TwoFactorAuth::isEnabled($userLMS)) !!}

                                    @if(!empty(\TwoFactorAuth::getSupportedChannels()))
                                        {!! ModulesForm::radio('channel','User::attributes.user.channel', false,\TwoFactorAuth::getSupportedChannels(),array_get($userLMS->getTwoFactorAuthProviderOptions(),'channel', null)) !!}
                                    @endif
                                @endif
                            </div>
                            <div class="col-md-6 text-center">
                                <i class="fa fa-lock" style="color:#7777770f; font-size: 10em;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    {!! ModulesForm::formButtons(trans('corals-admin::labels.auth.save',['title' => $title_singular]),[],['href'=>route('account.profile', $userLMS->hashed_id)]) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        @php \Actions::do_action('user_profile_tabs_content',$userLMS,$active_tab) @endphp

    </div>
    <!-- /.tab-pane -->
</div>
