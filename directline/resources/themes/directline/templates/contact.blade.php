@extends('layouts.master')

@section('editable_content')
    <div class="map">
        <iframe src="{{ \Settings::get('google_map_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d950645.7063079122!2d38.6506424560582!3d21.45046842621979!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3d01fb1137e59%3A0xe059579737b118db!2sJeddah+Saudi+Arabia!5e0!3m2!1sen!2seg!4v1538266477844') }}"
                width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <br>
    <div class="container padding-bottom-3x mb-1">
       {{--  {!! $item->rendered !!} --}}
        <div class="row">
            <br>
            <aside class="col-md-4">
                @include('partials.sidebar')
            </aside>
            <div class="col-md-8">
            <div id="form_status" class=" alert alert-success "
                 style="display: none;font-weight:bold;text-align:center"></div>
                  {!! $item->rendered !!} {{-- @newHere --}}

     {{--        <form id="main-contact-form" class="contact-form" name="contact-form" method="post"
                  action="{{ url('contact/email') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>@lang('Packages-ecommerce-basic::labels.template.contact.name')</label>
                            <input type="text" name="name" class="form-control form-control-rounded" required="required">
                        </div>
                        <div class="form-group">
                            <label>@lang('Packages-ecommerce-basic::labels.template.contact.email')</label>
                            <input type="email" name="email" class="form-control form-control-rounded" required="required">
                        </div>
                        <div class="form-group">
                            <label>@lang('Packages-ecommerce-basic::labels.template.contact.phone')</label>
                            <input type="text" name="phone" class="form-control form-control-rounded">
                        </div>
                        <div class="form-group">
                            <label>@lang('Packages-ecommerce-basic::labels.template.contact.company_name')</label>
                            <input type="text" name="company" class="form-control form-control-rounded">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>@lang('Packages-ecommerce-basic::labels.template.contact.subject')</label>
                            <input type="text" name="subject" class="form-control form-control-rounded" required="required">
                        </div>
                        <div class="form-group">
                            <label>@lang('Packages-ecommerce-basic::labels.template.contact.message')</label>
                            <textarea name="message" id="message" required="required" class="form-control form-control-rounded"
                                      rows="10"></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" name="submit" class="btn btn-outline-primary" required="required">
                                @lang('Packages-ecommerce-basic::labels.template.contact.submit_message')
                            </button>
                        </div>
                    </div>
                </div>
            </form> --}}
        </div>
        </div>
    </div>
@stop


@section('js')
{{--     <script type="text/javascript">

        // Contact form
        var form = $('#main-contact-form');
        form.submit(function (event) {
            event.preventDefault();
            var form_status = $('#form_status');
            form_status.removeClass('alert-success')
            form_status.removeClass('alert-warning')
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Sending Email ...</p>').fadeIn();
                }
            }).done(function (data) {
                $('html, body').animate({
                    scrollTop: form_status.offset().top - 20
                }, 1000);
                form_status.html(data.message).addClass(data.class).delay(3000).fadeOut();
                $('#main-contact-form').find("input[type=text], textarea").val("");
            });
        });
    </script> --}}
@endsection