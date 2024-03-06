<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Loreal Interactive Reports</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/frontend/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/frontend/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}"
          rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('assets/frontend/css/mdb.min.css')}}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link rel='stylesheet' id='keyboard-css-css'
          href="{{asset('assets/frontend/plugins/keyboard/css/keyboard.min.css')}}" type='text/css' media='all'/>
    <link rel='stylesheet' id='keyboard-previewkeyset-css-css'
          href="{{asset('assets/frontend/plugins/keyboard/css/keyboard-previewkeyset.min.css')}}" type='text/css'
          media='all'/>
    <link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet">
    <style>

        .ui-keyboard {
            background: #333;

        }

        button.ui-keyboard-button.btn {
            /*padding: 1px 4px;*/
            /*font-size: 14px;*/
        }

        .report-panel form:first {
            position: relative;
        }

    </style>
    <script type="text/javascript">
        window.base_url = '{!! url('/') !!}';
    </script>

    @stack('css')
</head>

<body>

<!-- Start your project here-->
<div style="height: 100vh">
    <div class="container-fluid absolute none">
        <div class="row">
            <div class="col-lg-4 heightvh white">
                1
            </div>
            <div class="col-lg-4 heightvh white">
                1
            </div>
            <div class="col-lg-4 heightvh white">
                1
            </div>
        </div>
    </div>


    <div class="logo animated fadeInUp delay-1-8s">
        <img src="{{asset("assets/frontend/img/logo.png")}}">
    </div>

    <div class="container-fluid noscroll">
        <div class="row">
            <div class="col-lg-4 heightvh sioreportsection animated fadeIn delay-1-1s " data-wow-duration="1.s">

                <div class="colorednameyellow animated fadeInUp">
                    <div class="text-center mainreportname animated fadeInUp delay-1-2s">
                        <span>1</span>
                        <span>io</span>
                    </div>
                    <div class="addreport animated fadeInUp delay-1-4s">
                        <div class="addouterborder animated fadeInUp delay-1-4s">
                            <div class="addborder">
                                <img src="{{ asset('assets/frontend/img/addreport.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 heightvh mesurreportsection animated fadeIn delay-1-3s">

                <div class="colorednamebana fadeInUp ">
                    <div class="text-center mainreportname animated fadeInUp delay-1-4s">
                        <span>2</span>
                        <span>mesur</span>
                    </div>
                    <div class="addreport animated fadeInUp delay-1-6s">
                        <div class="addouterborder animated fadeInUp delay-1-6s">
                            <div class="addborder">
                                <img src="{{asset('assets/frontend/img/addreport.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 heightvh incidentreportsection animated fadeIn delay-1-5s">

                <div class="colorednamered fadeInUp">
                    <div class="text-center mainreportname animated fadeInUp delay-1-6s">
                        <span>3</span>
                        <span>Incident</span>
                    </div>
                    <div class="addreport animated fadeInUp delay-1-8s">
                        <div class="addouterborder">
                            <div class="addborder">
                                <img src="{{asset('assets/frontend/img/addreport.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include("frontend.forms.io")
    @include("frontend.forms.mesur")
    @include("frontend.forms.incident")


</div>
<!-- /Start your project here-->


<!-- Button trigger modal -->


<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="{{asset("js/app.js")}}"></script>

<script type="text/javascript" src="{{asset("assets/frontend/js/jquery-3.3.1.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/frontend/js/jquery-ui.min.js")}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset("assets/frontend/js/popper.min.js")}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset("assets/frontend/js/bootstrap.min.js")}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript"
        src="{{asset("assets/frontend/plugins/flash-message/bootstrap-flash-alert.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/frontend/js/mdb.min.js")}}"></script>
<script type="text/javascript"
        src="{{asset("assets/frontend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js")}}"></script>
<script type='text/javascript' src="{{asset("assets/frontend/plugins/keyboard/js/jquery.keyboard.js")}}"></script>
<script type='text/javascript'
        src="{{asset("assets/frontend/plugins/keyboard/js/jquery.keyboard.extension-typing.min.js")}}"></script>
<script type='text/javascript'
        src="{{asset("assets/frontend/plugins/keyboard/js/jquery.keyboard.extension-previewkeyset.min.js")}}"></script>
<script type='text/javascript'
        src="{{asset("assets/frontend/plugins/keyboard/layouts/keyboard-layouts-microsoft.min.js")}}"></script>


<script>
    $(".report-panel .back").on("click touchstart", function () {
        $(this).parent(".panelpadding").animate({
            scrollTop: 0
        });
    });
    keyboard();

    function keyboard() {
        var maxCharcterLimit = 200, kb = $("input[type=text]:not(.datepicker),textarea");

        kb.keyboard({
            layout: 'qwerty',
            resetDefault: true,
            // userClosed: true, // keyboard open until user closes with accept or cancel
            autoAccept: true, // required for userClosed: true
            usePreview: false,
            alwaysOpen: false,
            language: "en",
            maxInsert: maxCharcterLimit,
            // appendTo: ".mhsaif-search-form",
            // position: true,
            beforeInsert: function (e, keyboard, el, txt) {
                var btn = keyboard.last;
                if (($(el).val().length >= maxCharcterLimit) && btn.key !== 'bksp') {
                    return false;
                }
                return txt;
            },
            change: function (event, keyboard, el) {
                $(el).trigger("change");
            },
            css: {
                // input & preview
                // "label-default" for a darker background
                // "light" for white text
                // input: 'form-control input-sm dark',
                // keyboard container
                // container: 'center-block well',
                // default state
                buttonDefault: 'btn btn-dark',
                // hovered button
                // buttonHover: 'btn-primary',
                // Action keys (e.g. Accept, Cancel, Tab, etc);
                // this replaces "actionClass" option
                buttonAction: 'active',
                // used when disabling the decimal button {dec}
                // when a decimal exists in the input area
                buttonDisabled: 'disabled'
            }
        }).addTyping();
        $.keyboard.language = {
            ar: {
                display: {
                    langSwitcher: "English",
                    cancel: "إلغاء",
                    accept: "موافق",
                    bksp: "حذف"
                }
            }, en: {display: {langSwitcher: "عربي"}}
        }

        $.keyboard.keyaction.langSwitcher = function (t) {
            "en" == t.options.language ? (t.options.display.langSwitcher = "English", t.options.layout = "ms-Arabic (102)", t.options.language = "ar") : (t.options.display.langSwitcher = "عربي", t.options.layout = "qwerty", t.options.language = "en"), t.redraw()
        }
        return kb;
    }

</script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script>
    /*$( function() {
      $( ".datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true
      });
    } );*/
</script>
<script>

    $(function () {
        $('.sioreportsection').on('click', function () {
            $('.sioreportpanel').removeClass('none');
            $('.sioreportpanel').removeClass('fadeOut');
            $('.sioreportpanel').addClass('fadeIn');
        });
    });


    $(function () {

        $('.back').on('click', function () {

            //$("form").reset();
            $('.sioreportpanel').removeClass('fadeIn');
            $('.sioreportpanel').addClass('fadeOut');
            $('.ajax-resp-data').text('').html('');
            setTimeout(function () {
                $('.sioreportpanel').addClass('none');

            }, 400);
        });
    });


    $(function () {
        $('.mesurreportsection').on('click', function () {
            $('.mesurreportpanel').removeClass('none');
            $('.mesurreportpanel').removeClass('fadeOut');
            $('.mesurreportpanel').addClass('fadeIn');
        });
    });


    $(function () {

        $('.back').on('click', function () {
            $(".error-input").remove();
            $('form').trigger("reset");
            $("#user_type").trigger("change");
            $("#user_type").val("employee");
            $("#EmpNumberContainer").show();
            $("#GuestNameContainer").hide();
            $('.mesurreportpanel').removeClass('fadeIn');
            $('.mesurreportpanel').addClass('fadeOut');
            setTimeout(function () {
                $('.mesurreportpanel').addClass('none');

            }, 400);
        });
    });


    $(function () {
        $('.incidentreportsection').on('click', function () {
            $('.incidentreportpanel').removeClass('none');
            $('.incidentreportpanel').removeClass('fadeOut');
            $('.incidentreportpanel').addClass('fadeIn');
        });
    });


    $(function () {

        $('.back').on('click', function () {
            $('.incidentreportpanel').removeClass('fadeIn');
            $('.incidentreportpanel').addClass('fadeOut');
            setTimeout(function () {
                $('.incidentreportpanel').addClass('none');

            }, 400);
        });


    });


</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function flashMessage(type, title, message) {
        if (type == 'success') {

            $.alert(message, {
                withTime: true,
                type: 'success',
                title: title,
                icon: 'glyphicon glyphicon-heart',
                minTop: 300
            });
        } else {

            $.alert(message, {
                withTime: true,
                type: 'warning',
                title: title,
                icon: 'glyphicon glyphicon-heart',
                minTop: 300
            });
        }
    }

    $('body').on('submit', '.ajax-form', function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        $.ajax({
            method: method,
            url: url,
            data: form.serialize(),
        }).then(function (data) {
            if (data.success) {

                $(".back").click();
                form[0].reset();
                $('.row-form-table').remove();
                flashMessage('success', 'Done !', "Thank you ... The report submitted successfully. ");
            }

        }, function (err) {
            let resp = err.responseJSON;

            $(".error-input").remove();
            if (!resp.success && resp.message) {
                flashMessage('error', 'Alert', resp.message);
            }
            if (resp.errors.length) {
                $.each(resp.errors, function (input, error) {
                    console.log(error);
                    var errEl = "<span class='text-danger error-input'>" + error + "</span>";
                    $("[name=" + input + "]").parent().append(errEl);
                });
            }


        });
    });
</script>

@stack('scripts')
</body>

</html>
