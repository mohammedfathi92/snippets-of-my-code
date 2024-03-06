<!DOCTYPE html>
<html lang="en" data-ng-app="frontendApp">
<head>
    <meta charset="utf-8">
    <title>DevelopNet Landing Page Builder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{csrf_token()}}"/>
                
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!--[if lt IE 10]>
    <link href="css/ie-masonry.css" rel="stylesheet">
    <script src="js/masonry.pkgd.min.js"></script>
    <![endif]-->
 <link href="/builder/assets/css/vendor/bootstrap.min.css" rel="stylesheet">
    <link href="/builder/assets/css/flat-ui-pro.css" rel="stylesheet">
    <link href="/builder/assets/css/style.css" rel="stylesheet">
    <link href="/builder/assets/css/font-awesome.css" rel="stylesheet">
    <link href="/builder/assets/css/builder.css" rel="stylesheet">

    <link href="/builder/assets/css/spectrum.css" rel="stylesheet">
    <link href="/builder/assets/css/chosen.css" rel="stylesheet">
    
    <link href="/builder/assets/css/topbar.css" rel="stylesheet" type="text/css" />
        
    <link rel="shortcut icon" href="/builder/assets/images/favicon.png">

</head>
<body>


    <input id="DNet_page_id" type="hidden" name="DN_pageID" value="{{$page->id}}">
    <input id="DNet_page_lang" type="hidden" name="DN_page_lang" value="{{$pageLang}}">
    
    <div class="topbar" id="topBar">
        <div class="topbarWrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <p>If you refresh page and come back again <b>Pleas Update dynamic content settings</b> </p>
                    </div>
                    <div class="col-md-2">
                        <a class="btn" href="{{url(config("settings.backend_uri").'/landing-pages/'.$page->id.'/edit')}}">Return to page Config</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="builder">

        <div class="menu" id="menu">

            <div class="main" id="main">

                <h3>
                    <span class="fui-list"></span> Blocks
                </h3>

                <ul id="elementCats">
                    <li><a href="#" id="all">All Blocks</a></li>
                </ul>

                <a class="toggle" href="#">
                    <span class="fui-gear"></span>
                </a>

                <hr>
                
                <h3>
                    <span class="fui-windows"></span> Pages
                </h3>

                <ul id="pages">

                    <li style="display: none;" id="newPageLI">
                        <input type="text" value="index" name="page">
                        <span class="pageButtons">
                            <a href="" class="fileEdit"><span class="fui-new"></span></a>
                            <a href="" class="fileDel"><span class="fui-cross"></span></a>
                            <a class="btn btn-xs btn-primary btn-embossed fileSave" href="#"><span class="fui-check"></span></a>
                        </span>
                    </li>
                    
                </ul>

               {{-- } <div class="sideButtons clearfix">
                    <a href="#" class="btn btn-primary btn-sm btn-embossed" id="addPage">
                        <span class="fui-plus"></span> Add Page
                    </a>
                </div> --}}

            </div><!-- /##main -->

            <div class="second" id="second">

                <ul id="elements">
                
                </ul>

            </div><!-- /#second -->

        </div><!-- /#menu -->

        <div class="container">

            <header class="clearfix affix">

                <ul class="nav nav-pills nav-inverse pull-left responsiveToggle" id="responsiveToggle">
                    <li>
                        <a href="" data-responsive="mobile">
                            <i class="fa fa-mobile" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="" data-responsive="tablet">
                            <i class="fa fa-tablet" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="active">
                        <a href="" data-responsive="desktop">
                            <i class="fa fa-desktop" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>

                <a href="#" id="clearScreen" class="btn btn-danger pull-right actionButtons nohover">
                    <i class="fui-trash"></i> 
                    <span>Empty Page</span>
                </a>

                <a href="#previewModal" data-toggle="modal" class="btn btn-inverse pull-right actionButtons nohover" id="buttonPreview">
                    <i class="fui-window"></i>
                    <span>Preview</span>
                </a> 

                

              {{-- <a href="#exportModal" id="exportPage" data-toggle="modal" class="btn btn-info pull-right actionButtons nohover">
                    <i class="fui-export"></i>
                    <span>Export</span>
                </a> --}}

                <a href="#" id="savePage" data-toggle="modal" class="btn btn-primary pull-right nohover">
                    <i class="fui-check"></i>
                    <span class="bLabel">Nothing to save</span>
                </a>

            </header>

            <div class="screen" id="screen">

                <div class="toolbar">
                
                    <div class="buttons clearfix">
                        <span class="left red"></span>
                        <span class="left yellow"></span>
                        <span class="left green"></span>
                    </div>
                    
                    <div class="title">
                        <span id="pageTitle">index</span>
                    </div>
                    
                </div>

                <div id="frameWrapper" class="frameWrapper empty">
                    <div id="pageList">
                        
                    </div>
                    <div class="start" id="start">
                        <span>BUILD YOUR PAGE BY DRAGGING BLOCKS ONTO THE CANVAS</span>
                    </div>
                </div>

            </div><!-- /#screen -->

        </div><!-- /.container -->

        <div id="styleEditor" class="styleEditor">

            <a href="#" class="close"><span class="fui-cross-circle"></span></a>

            <h3><span class="fui-new"></span> Detail editor</h3>

            <ul class="breadcrumb">
                <li>EDITING:</li>
                <li class="active" id="editingElement">p</li>
            </ul>

            <ul class="nav nav-tabs" id="detailTabs">
                <li class="active">
                    <a href="#tab1">
                        <span class="fui-new"></span> Style
                    </a>
                </li>
                <li style="display: none;">
                    <a href="#link_Tab" id="link_Link">
                        <span class="fui-clip"></span> Link
                    </a>
                </li>
                <li style="display: none;">
                    <a href="#image_Tab" id="img_Link">
                        <span class="fui-image"></span> Image
                    </a>
                </li>
                <li style="display: none;">
                    <a href="#icon_Tab" id="icon_Link">
                        <span class="fa fa-flag"></span> Icon
                    </a>
                </li>
                <li style="display: none;">
                    <a href="#video_Tab" id="video_Link">
                        <span class="fa fa-youtube-play"></span> Video
                    </a>
                </li>
            </ul><!-- /tabs -->

            <div class="tab-content">
            
                <div class="tab-pane active" id="tab1">
                    
                    <form class="" role="form" id="stylingForm">
                    
                        <div id="styleElements">
                    
                            <div class="form-group clearfix" style="display: none;" id="styleElTemplate">
                                <label for="" class="control-label"></label>
                                <input type="text" class="form-control input-sm" id="" placeholder="">
                            </div>
                        
                        </div>
                      
                    </form>
                    
                </div><!-- /.tab-pane -->

                <div class="tab-pane link_Tab" id="link_Tab">

                    <div class="form-group fullWidth">
                        <input type="text" class="form-control" id="linkText" name="linkText" placeholder="Link text" value="">
                    </div>
                    
                    <div class="form-group">
                        <select id="pageLinksDropdown" class="form-control select select-primary btn-block mbl">
                            <option value="#">Choose a page</option>                            
                        </select>
                    </div>
                    
                    <p class="text-center or">
                        <span>or</span>
                    </p>
                    
                    <div class="form-group">
                        <!--<select id="pageLinksDropdown" class="form-control select select-primary btn-block mbl">-->
                        <select id="internalLinksDropdown" class="form-control select select-primary btn-block mbl">
                            <option value="#">Choose a block</option>
                        </select>
                    </div>
                    
                    <p class="text-center or">
                        <span>&xvee;</span>
                    </p>
                    
                    <input type="text" class="form-control" id="internalLinksCustom" placeholder="http://somewhere.com/somepage" value="">
                    
                </div><!-- /.tab-pane -->

                <div class="tab-pane imageFileTab" id="image_Tab">
                
                    <label>Enter image path:</label>
                    
                    <input type="text" class="form-control" id="imageURL" placeholder="Enter an image URL" value="">
                    
                  {{--  <p class="text-center or">
                        <span>OR</span>
                    </p>
                    
                     <form id="imageUploadForm" action="_upload.php">
                    
                        <div class="alert alert-info">
                            <button class="close fui-cross" data-dismiss="alert"></button>
                            <h4>Please note</h4>
                            <p>For security reasons; the file upload has been disabled </p>
                        </div>
                                        
                    </form> 

                   <form id="imageUploadForm" action="{{route('builder.upload')}}">
                    
                        <label>Upload image:</label>

                        <div class="form-group">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 150px; line-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-primary btn-sm btn-embossed btn-file">
                                        <span class="fileinput-new"><span class="fui-image"></span>&nbsp;&nbsp;Select image</span>
                                        <span class="fileinput-exists"><span class="fui-gear"></span>&nbsp;&nbsp;Change</span>
                                        <input type="file" name="imageFileField" id="imageFileField">
                                    </span>
                                    <a href="#" class="btn btn-primary btn-sm btn-embossed fileinput-exists" data-dismiss="fileinput"><span class="fui-trash"></span>&nbsp;&nbsp;Remove</a>
                                </div>
                            </div>
                        </div>
                                        
                    </form> --}}
                    
                </div><!-- /.tab-pane -->



                <!-- /tabs -->
                <div class="tab-pane iconTab" id="icon_Tab">
                
                    <label>Choose an icon: </label>
                    
                    <select id="icons" data-placeholder="" class>
                        <option value="fa-adjust">&#xf042; adjust</option>
                        <option value="fa-adn">&#xf170; adn</option>
                        <option value="fa-align-center">&#xf037; align-center</option>
                        <option value="fa-align-justify">&#xf039; align-justify</option>
                        <option value="fa-align-left">&#xf036; align-left</option>
                        <option value="fa-align-right">&#xf038; align-right</option>
                        <option value="fa-ambulance">&#xf0f9; ambulance</option>
                        <option value="fa-anchor">&#xf13d; anchor</option>
                        <option value="fa-android">&#xf17b; android</option>
                        <option value="fa-angellist">&#xf209; angellist</option>
                        <option value="fa-angle-double-down">&#xf103; angle-double-down</option>
                        <option value="fa-angle-double-left">&#xf100; angle-double-left</option>
                        <option value="fa-angle-double-right">&#xf101; angle-double-right</option>
                        <option value="fa-angle-double-up">&#xf102; angle-double-up</option>
                        <option value="fa-angle-down">&#xf107; angle-down</option>
                        <option value="fa-angle-left">&#xf104; angle-left</option>
                        <option value="fa-angle-right">&#xf105; angle-right</option>
                        <option value="fa-angle-up">&#xf106; angle-up
                        </option>
                        
                         <option value="fa-apple">&#xf179; apple
                        </option>
                        
                         <option value="fa-archive">&#xf187; archive
                        </option>
                        
                         <option value="fa-area-chart">&#xf1fe; area-chart
                        </option>
                        
                         <option value="fa-arrow-circle-down">&#xf0ab; arrow-circle-down
                        </option>
                        
                         <option value="fa-arrow-circle-left">&#xf0a8; arrow-circle-left
                        </option>
                        
                         <option value="fa-arrow-circle-o-down">&#xf01a; arrow-circle-o-down
                        </option>
                        
                         <option value="fa-arrow-circle-o-left">&#xf190; arrow-circle-o-left
                        </option>
                        
                         <option value="fa-arrow-circle-o-right">&#xf18e; arrow-circle-o-right
                        </option>
                        
                         <option value="fa-arrow-circle-o-up">&#xf01b; arrow-circle-o-up
                        </option>
                        
                         <option value="fa-arrow-circle-right">&#xf0a9; arrow-circle-right
                        </option>
                        
                         <option value="fa-arrow-circle-up">&#xf0aa; arrow-circle-up
                        </option>
                        
                         <option value="fa-arrow-down">&#xf063; arrow-down
                        </option>
                        
                         <option value="fa-arrow-left">&#xf060; arrow-left
                        </option>
                        
                         <option value="fa-arrow-right">&#xf061; arrow-right
                        </option>
                        
                         <option value="fa-arrow-up">&#xf062; arrow-up
                        </option>
                        
                         <option value="fa-arrows">&#xf047; arrows
                        </option>
                        
                         <option value="fa-arrows-alt">&#xf0b2; arrows-alt
                        </option>
                        
                         <option value="fa-arrows-h">&#xf07e; arrows-h
                        </option>
                        
                         <option value="fa-arrows-v">&#xf07d; arrows-v
                        </option>
                        
                         <option value="fa-asterisk">&#xf069; asterisk
                        </option>
                        
                         <option value="fa-at">&#xf1fa; at
                        </option>
                        
                         <option value="fa-automobile">&#xf1b9; automobile
                        </option>
                        
                         <option value="fa-backward">&#xf04a; backward
                        </option>
                        
                         <option value="fa-ban">&#xf05e; ban
                        </option>
                        
                         <option value="fa-bank">&#xf19c; bank
                        </option>
                        
                         <option value="fa-bar-chart">&#xf080; bar-chart
                        </option>
                        
                         <option value="fa-bar-chart-o">&#xf080; bar-chart-o
                        </option>
                        
                         <option value="fa-barcode">&#xf02a; barcode
                        </option>
                        
                         <option value="fa-bars">&#xf0c9; bars
                        </option>
                        
                         <option value="fa-beer">&#xf0fc; beer
                        </option>
                        
                         <option value="fa-behance">&#xf1b4; behance
                        </option>
                        
                         <option value="fa-behance-square">&#xf1b5; behance-square
                        </option>
                        
                         <option value="fa-bell">&#xf0f3; bell
                        </option>
                        
                         <option value="fa-bell-o">&#xf0a2; bell-o
                        </option>
                        
                         <option value="fa-bell-slash">&#xf1f6; bell-slash
                        </option>
                        
                         <option value="fa-bell-slash-o">&#xf1f7; bell-slash-o
                        </option>
                        
                         <option value="fa-bicycle">&#xf206; bicycle
                        </option>
                        
                         <option value="fa-binoculars">&#xf1e5; binoculars
                        </option>
                        
                         <option value="fa-birthday-cake">&#xf1fd; birthday-cake
                        </option>
                        
                         <option value="fa-bitbucket">&#xf171; bitbucket
                        </option>
                        
                         <option value="fa-bitbucket-square">&#xf172; bitbucket-square
                        </option>
                        
                         <option value="fa-bitcoin">&#xf15a; bitcoin
                        </option>
                        
                         <option value="fa-bold">&#xf032; bold
                        </option>
                        
                         <option value="fa-bolt">&#xf0e7; bolt
                        </option>
                        
                         <option value="fa-bomb">&#xf1e2; bomb
                        </option>
                        
                         <option value="fa-book">&#xf02d; book
                        </option>
                        
                         <option value="fa-bookmark">&#xf02e; bookmark
                        </option>
                        
                         <option value="fa-bookmark-o">&#xf097; bookmark-o
                        </option>
                        
                         <option value="fa-briefcase">&#xf0b1; briefcase
                        </option>
                        
                         <option value="fa-btc">&#xf15a; btc
                        </option>
                        
                         <option value="fa-bug">&#xf188; bug
                        </option>
                        
                         <option value="fa-building">&#xf1ad; building
                        </option>
                        
                         <option value="fa-building-o">&#xf0f7; building-o
                        </option>
                        
                         <option value="fa-bullhorn">&#xf0a1; bullhorn
                        </option>
                        
                         <option value="fa-bullseye">&#xf140; bullseye
                        </option>
                        
                         <option value="fa-bus">&#xf207; bus
                        </option>
                        
                         <option value="fa-cab">&#xf1ba; cab
                        </option>
                        
                         <option value="fa-calculator">&#xf1ec; calculator
                        </option>
                        
                         <option value="fa-calendar">&#xf073; calendar
                        </option>
                        
                         <option value="fa-calendar-o">&#xf133; calendar-o
                        </option>
                        
                         <option value="fa-camera">&#xf030; camera
                        </option>
                        
                         <option value="fa-camera-retro">&#xf083; camera-retro
                        </option>
                        
                         <option value="fa-car">&#xf1b9; car
                        </option>
                        
                         <option value="fa-caret-down">&#xf0d7; caret-down
                        </option>
                        
                         <option value="fa-caret-left">&#xf0d9; caret-left
                        </option>
                        
                         <option value="fa-caret-right">&#xf0da; caret-right
                        </option>
                        
                         <option value="fa-caret-square-o-down">&#xf150; caret-square-o-down
                        </option>
                        
                         <option value="fa-caret-square-o-left">&#xf191; caret-square-o-left
                        </option>
                        
                         <option value="fa-caret-square-o-right">&#xf152; caret-square-o-right
                        </option>
                        
                         <option value="fa-caret-square-o-up">&#xf151; caret-square-o-up
                        </option>
                        
                         <option value="fa-caret-up">&#xf0d8; caret-up
                        </option>
                        
                         <option value="fa-cc">&#xf20a; cc
                        </option>
                        
                         <option value="fa-cc-amex">&#xf1f3; cc-amex
                        </option>
                        
                         <option value="fa-cc-discover">&#xf1f2; cc-discover
                        </option>
                        
                         <option value="fa-cc-mastercard">&#xf1f1; cc-mastercard
                        </option>
                        
                         <option value="fa-cc-paypal">&#xf1f4; cc-paypal
                        </option>
                        
                         <option value="fa-cc-stripe">&#xf1f5; cc-stripe
                        </option>
                        
                         <option value="fa-cc-visa">&#xf1f0; cc-visa
                        </option>
                        
                         <option value="fa-certificate">&#xf0a3; certificate
                        </option>
                        
                         <option value="fa-chain">&#xf0c1; chain
                        </option>
                        
                         <option value="fa-chain-broken">&#xf127; chain-broken
                        </option>
                        
                         <option value="fa-check">&#xf00c; check
                        </option>
                        
                         <option value="fa-check-circle">&#xf058; check-circle
                        </option>
                        
                         <option value="fa-check-circle-o">&#xf05d; check-circle-o
                        </option>
                        
                         <option value="fa-check-square">&#xf14a; check-square
                        </option>
                        
                         <option value="fa-check-square-o">&#xf046; check-square-o
                        </option>
                        
                         <option value="fa-chevron-circle-down">&#xf13a; chevron-circle-down
                        </option>
                        
                         <option value="fa-chevron-circle-left">&#xf137; chevron-circle-left
                        </option>
                        
                         <option value="fa-chevron-circle-right">&#xf138; chevron-circle-right
                        </option>
                        
                         <option value="fa-chevron-circle-up">&#xf139; chevron-circle-up
                        </option>
                        
                         <option value="fa-chevron-down">&#xf078; chevron-down
                        </option>
                        
                         <option value="fa-chevron-left">&#xf053; chevron-left
                        </option>
                        
                         <option value="fa-chevron-right">&#xf054; chevron-right
                        </option>
                        
                         <option value="fa-chevron-up">&#xf077; chevron-up
                        </option>
                        
                         <option value="fa-child">&#xf1ae; child
                        </option>
                        
                         <option value="fa-circle">&#xf111; circle
                        </option>
                        
                         <option value="fa-circle-o">&#xf10c; circle-o
                        </option>
                        
                         <option value="fa-circle-o-notch">&#xf1ce; circle-o-notch
                        </option>
                        
                         <option value="fa-circle-thin">&#xf1db; circle-thin
                        </option>
                        
                         <option value="fa-clipboard">&#xf0ea; clipboard
                        </option>
                        
                         <option value="fa-clock-o">&#xf017; clock-o
                        </option>
                        
                         <option value="fa-close">&#xf00d; close
                        </option>
                        
                         <option value="fa-cloud">&#xf0c2; cloud
                        </option>
                        
                         <option value="fa-cloud-download">&#xf0ed; cloud-download
                        </option>
                        
                         <option value="fa-cloud-upload">&#xf0ee; cloud-upload
                        </option>
                        
                         <option value="fa-cny">&#xf157; cny
                        </option>
                        
                         <option value="fa-code">&#xf121; code
                        </option>
                        
                         <option value="fa-code-fork">&#xf126; code-fork
                        </option>
                        
                         <option value="fa-codepen">&#xf1cb; codepen
                        </option>
                        
                         <option value="fa-coffee">&#xf0f4; coffee
                        </option>
                        
                         <option value="fa-cog">&#xf013; cog
                        </option>
                        
                         <option value="fa-cogs">&#xf085; cogs
                        </option>
                        
                         <option value="fa-columns">&#xf0db; columns
                        </option>
                        
                         <option value="fa-comment">&#xf075; comment
                        </option>
                        
                         <option value="fa-comment-o">&#xf0e5; comment-o
                        </option>
                        
                         <option value="fa-comments">&#xf086; comments
                        </option>
                        
                         <option value="fa-comments-o">&#xf0e6; comments-o
                        </option>
                        
                         <option value="fa-compass">&#xf14e; compass
                        </option>
                        
                         <option value="fa-compress">&#xf066; compress
                        </option>
                        
                         <option value="fa-copy">&#xf0c5; copy
                        </option>
                        
                         <option value="fa-copyright">&#xf1f9; copyright
                        </option>
                        
                         <option value="fa-credit-card">&#xf09d; credit-card
                        </option>
                        
                         <option value="fa-crop">&#xf125; crop
                        </option>
                        
                         <option value="fa-crosshairs">&#xf05b; crosshairs
                        </option>
                        
                        <option value="fa-css">css3 &#xf13c;
                        </option>
                        
                         <option value="fa-cube">&#xf1b2; cube
                        </option>
                        
                         <option value="fa-cubes">&#xf1b3; cubes
                        </option>
                        
                         <option value="fa-cut">&#xf0c4; cut
                        </option>
                        
                         <option value="fa-cutlery">&#xf0f5; cutlery
                        </option>
                        
                         <option value="fa-dashboard">&#xf0e4; dashboard
                        </option>
                        
                         <option value="fa-database">&#xf1c0; database
                        </option>
                        
                         <option value="fa-dedent">&#xf03b; dedent
                        </option>
                        
                         <option value="fa-delicious">&#xf1a5; delicious
                        </option>
                        
                         <option value="fa-desktop">&#xf108; desktop
                        </option>
                        
                         <option value="fa-deviantart">&#xf1bd; deviantart
                        </option>
                        
                         <option value="fa-digg">&#xf1a6; digg
                        </option>
                        
                         <option value="fa-dollar">&#xf155; dollar
                        </option>
                        
                         <option value="fa-dot-circle-o">&#xf192; dot-circle-o
                        </option>
                        
                         <option value="fa-download">&#xf019; download
                        </option>
                        
                         <option value="fa-dribbble">&#xf17d; dribbble
                        </option>
                        
                         <option value="fa-dropbox">&#xf16b; dropbox
                        </option>
                        
                         <option value="fa-drupal">&#xf1a9; drupal
                        </option>
                        
                         <option value="fa-edit">&#xf044; edit
                        </option>
                        
                         <option value="fa-eject">&#xf052; eject
                        </option>
                        
                         <option value="fa-ellipsis-h">&#xf141; ellipsis-h
                        </option>
                        
                         <option value="fa-ellipsis-v">&#xf142; ellipsis-v
                        </option>
                        
                         <option value="fa-empire">&#xf1d1; empire
                        </option>
                        
                         <option value="fa-envelope">&#xf0e0; envelope
                        </option>
                        
                         <option value="fa-envelope-o">&#xf003; envelope-o
                        </option>
                        
                         <option value="fa-envelope-square">&#xf199; envelope-square
                        </option>
                        
                         <option value="fa-eraser">&#xf12d; eraser
                        </option>
                        
                         <option value="fa-eur">&#xf153; eur
                        </option>
                        
                         <option value="fa-euro">&#xf153; euro
                        </option>
                        
                         <option value="fa-exchange">&#xf0ec; exchange
                        </option>
                        
                         <option value="fa-exclamation">&#xf12a; exclamation
                        </option>
                        
                         <option value="fa-exclamation-circle">&#xf06a; exclamation-circle
                        </option>
                        
                         <option value="fa-exclamation-triangle">&#xf071; exclamation-triangle
                        </option>
                        
                         <option value="fa-expand">&#xf065; expand
                        </option>
                        
                         <option value="fa-external-link">&#xf08e; external-link
                        </option>
                        
                         <option value="fa-external-link-square">&#xf14c; external-link-square
                        </option>
                        
                         <option value="fa-eye">&#xf06e; eye
                        </option>
                        
                         <option value="fa-eye-slash">&#xf070; eye-slash
                        </option>
                        
                         <option value="fa-eyedropper">&#xf1fb; eyedropper
                        </option>
                        
                         <option value="fa-facebook">&#xf09a; facebook
                        </option>
                        
                         <option value="fa-facebook-square">&#xf082; facebook-square
                        </option>
                        
                         <option value="fa-fast-backward">&#xf049; fast-backward
                        </option>
                        
                         <option value="fa-fast-forward">&#xf050; fast-forward
                        </option>
                        
                         <option value="fa-fax">&#xf1ac; fax
                        </option>
                        
                         <option value="fa-female">&#xf182; female
                        </option>
                        
                         <option value="fa-fighter-jet">&#xf0fb; fighter-jet
                        </option>
                        
                         <option value="fa-file">&#xf15b; file
                        </option>
                        
                         <option value="fa-file-archive-o">&#xf1c6; file-archive-o
                        </option>
                        
                         <option value="fa-file-audio-o">&#xf1c7; file-audio-o
                        </option>
                        
                         <option value="fa-file-code-o">&#xf1c9; file-code-o
                        </option>
                        
                         <option value="fa-file-excel-o">&#xf1c3; file-excel-o
                        </option>
                        
                         <option value="fa-file-image-o">&#xf1c5; file-image-o
                        </option>
                        
                         <option value="fa-file-movie-o">&#xf1c8; file-movie-o
                        </option>
                        
                         <option value="fa-file-o">&#xf016; file-o
                        </option>
                        
                         <option value="fa-file-pdf-o">&#xf1c1; file-pdf-o
                        </option>
                        
                         <option value="fa-file-photo-o">&#xf1c5; file-photo-o
                        </option>
                        
                         <option value="fa-file-picture-o">&#xf1c5; file-picture-o
                        </option>
                        
                         <option value="fa-file-powerpoint-o">&#xf1c4; file-powerpoint-o
                        </option>
                        
                         <option value="fa-file-sound-o">&#xf1c7; file-sound-o
                        </option>
                        
                         <option value="fa-file-text">&#xf15c; file-text
                        </option>
                        
                         <option value="fa-file-text-o">&#xf0f6; file-text-o
                        </option>
                        
                         <option value="fa-file-video-o">&#xf1c8; file-video-o
                        </option>
                        
                         <option value="fa-file-word-o">&#xf1c2; file-word-o
                        </option>
                        
                         <option value="fa-file-zip-o">&#xf1c6; file-zip-o
                        </option>
                        
                         <option value="fa-files-o">&#xf0c5; files-o
                        </option>
                        
                         <option value="fa-film">&#xf008; film
                        </option>
                        
                         <option value="fa-filter">&#xf0b0; filter
                        </option>
                        
                         <option value="fa-fire">&#xf06d; fire
                        </option>
                        
                         <option value="fa-fire-extinguisher">&#xf134; fire-extinguisher
                        </option>
                        
                         <option value="fa-flag">&#xf024; flag
                        </option>
                        
                         <option value="fa-flag-checkered">&#xf11e; flag-checkered
                        </option>
                        
                         <option value="fa-flag-o">&#xf11d; flag-o
                        </option>
                        
                         <option value="fa-flash">&#xf0e7; flash
                        </option>
                        
                         <option value="fa-flask">&#xf0c3; flask
                        </option>
                        
                         <option value="fa-flickr">&#xf16e; flickr
                        </option>
                        
                         <option value="fa-floppy-o">&#xf0c7; floppy-o
                        </option>
                        
                         <option value="fa-folder">&#xf07b; folder
                        </option>
                        
                         <option value="fa-folder-o">&#xf114; folder-o
                        </option>
                        
                         <option value="fa-folder-open">&#xf07c; folder-open
                        </option>
                        
                         <option value="fa-folder-open-o">&#xf115; folder-open-o
                        </option>
                        
                         <option value="fa-font">&#xf031; font
                        </option>
                        
                         <option value="fa-forward">&#xf04e; forward
                        </option>
                        
                         <option value="fa-foursquare">&#xf180; foursquare
                        </option>
                        
                         <option value="fa-frown-o">&#xf119; frown-o
                        </option>
                        
                         <option value="fa-futbol-o">&#xf1e3; futbol-o
                        </option>
                        
                         <option value="fa-gamepad">&#xf11b; gamepad
                        </option>
                        
                         <option value="fa-gavel">&#xf0e3; gavel
                        </option>
                        
                         <option value="fa-gbp">&#xf154; gbp
                        </option>
                        
                         <option value="fa-ge">&#xf1d1; ge
                        </option>
                        
                         <option value="fa-gear">&#xf013; gear
                        </option>
                        
                         <option value="fa-gears">&#xf085; gears
                        </option>
                        
                         <option value="fa-gift">&#xf06b; gift
                        </option>
                        
                         <option value="fa-git">&#xf1d3; git
                        </option>
                        
                         <option value="fa-git-square">&#xf1d2; git-square
                        </option>
                        
                         <option value="fa-github">&#xf09b; github
                        </option>
                        
                         <option value="fa-github-alt">&#xf113; github-alt
                        </option>
                        
                         <option value="fa-github-square">&#xf092; github-square
                        </option>
                        
                         <option value="fa-gittip">&#xf184; gittip
                        </option>
                        
                         <option value="fa-glass">&#xf000; glass
                        </option>
                        
                         <option value="fa-globe">&#xf0ac; globe
                        </option>
                        
                         <option value="fa-google">&#xf1a0; google
                        </option>
                        
                         <option value="fa-google-plus">&#xf0d5; google-plus
                        </option>
                        
                         <option value="fa-google-plus-square">&#xf0d4; google-plus-square
                        </option>
                        
                         <option value="fa-google-wallet">&#xf1ee; google-wallet
                        </option>
                        
                         <option value="fa-graduation-cap">&#xf19d; graduation-cap
                        </option>
                        
                         <option value="fa-group">&#xf0c0; group
                        </option>
                        
                         <option value="fa-h-square">&#xf0fd; h-square
                        </option>
                        
                         <option value="fa-hacker-news">&#xf1d4; hacker-news
                        </option>
                        
                         <option value="fa-hand-o-down">&#xf0a7; hand-o-down
                        </option>
                        
                         <option value="fa-hand-o-left">&#xf0a5; hand-o-left
                        </option>
                        
                         <option value="fa-hand-o-right">&#xf0a4; hand-o-right
                        </option>
                        
                         <option value="fa-hand-o-up">&#xf0a6; hand-o-up
                        </option>
                        
                         <option value="fa-hdd-o">&#xf0a0; hdd-o
                        </option>
                        
                         <option value="fa-header">&#xf1dc; header
                        </option>
                        
                         <option value="fa-headphones">&#xf025; headphones
                        </option>
                        
                         <option value="fa-heart">&#xf004; heart
                        </option>
                        
                         <option value="fa-heart-o">&#xf08a; heart-o
                        </option>
                        
                         <option value="fa-history">&#xf1da; history
                        </option>
                        
                         <option value="fa-home">&#xf015; home
                        </option>
                        
                         <option value="fa-hospital-o">&#xf0f8; hospital-o
                        </option>
                        
                        <option value="fa-html">html5 &#xf13b;
                        </option>
                        
                         <option value="fa-ils">&#xf20b; ils
                        </option>
                        
                         <option value="fa-image">&#xf03e; image
                        </option>
                        
                         <option value="fa-inbox">&#xf01c; inbox
                        </option>
                        
                         <option value="fa-indent">&#xf03c; indent
                        </option>
                        
                         <option value="fa-info">&#xf129; info
                        </option>
                        
                         <option value="fa-info-circle">&#xf05a; info-circle
                        </option>
                        
                         <option value="fa-inr">&#xf156; inr
                        </option>
                        
                         <option value="fa-instagram">&#xf16d; instagram
                        </option>
                        
                         <option value="fa-institution">&#xf19c; institution
                        </option>
                        
                         <option value="fa-ioxhost">&#xf208; ioxhost
                        </option>
                        
                         <option value="fa-italic">&#xf033; italic
                        </option>
                        
                         <option value="fa-joomla">&#xf1aa; joomla
                        </option>
                        
                         <option value="fa-jpy">&#xf157; jpy
                        </option>
                        
                         <option value="fa-jsfiddle">&#xf1cc; jsfiddle
                        </option>
                        
                         <option value="fa-key">&#xf084; key
                        </option>
                        
                         <option value="fa-keyboard-o">&#xf11c; keyboard-o
                        </option>
                        
                         <option value="fa-krw">&#xf159; krw
                        </option>
                        
                         <option value="fa-language">&#xf1ab; language
                        </option>
                        
                         <option value="fa-laptop">&#xf109; laptop
                        </option>
                        
                         <option value="fa-lastfm">&#xf202; lastfm
                        </option>
                        
                         <option value="fa-lastfm-square">&#xf203; lastfm-square
                        </option>
                        
                         <option value="fa-leaf">&#xf06c; leaf
                        </option>
                        
                         <option value="fa-legal">&#xf0e3; legal
                        </option>
                        
                         <option value="fa-lemon-o">&#xf094; lemon-o
                        </option>
                        
                         <option value="fa-level-down">&#xf149; level-down
                        </option>
                        
                         <option value="fa-level-up">&#xf148; level-up
                        </option>
                        
                         <option value="fa-life-bouy">&#xf1cd; life-bouy
                        </option>
                        
                         <option value="fa-life-buoy">&#xf1cd; life-buoy
                        </option>
                        
                         <option value="fa-life-ring">&#xf1cd; life-ring
                        </option>
                        
                         <option value="fa-life-saver">&#xf1cd; life-saver
                        </option>
                        
                         <option value="fa-lightbulb-o">&#xf0eb; lightbulb-o
                        </option>
                        
                         <option value="fa-line-chart">&#xf201; line-chart
                        </option>
                        
                         <option value="fa-link">&#xf0c1; link
                        </option>
                        
                         <option value="fa-linkedin">&#xf0e1; linkedin
                        </option>
                        
                         <option value="fa-linkedin-square">&#xf08c; linkedin-square
                        </option>
                        
                         <option value="fa-linux">&#xf17c; linux
                        </option>
                        
                         <option value="fa-list">&#xf03a; list
                        </option>
                        
                         <option value="fa-list-alt">&#xf022; list-alt
                        </option>
                        
                         <option value="fa-list-ol">&#xf0cb; list-ol
                        </option>
                        
                         <option value="fa-list-ul">&#xf0ca; list-ul
                        </option>
                        
                         <option value="fa-location-arrow">&#xf124; location-arrow
                        </option>
                        
                         <option value="fa-lock">&#xf023; lock
                        </option>
                        
                         <option value="fa-long-arrow-down">&#xf175; long-arrow-down
                        </option>
                        
                         <option value="fa-long-arrow-left">&#xf177; long-arrow-left
                        </option>
                        
                         <option value="fa-long-arrow-right">&#xf178; long-arrow-right
                        </option>
                        
                         <option value="fa-long-arrow-up">&#xf176; long-arrow-up
                        </option>
                        
                         <option value="fa-magic">&#xf0d0; magic
                        </option>
                        
                         <option value="fa-magnet">&#xf076; magnet
                        </option>
                        
                         <option value="fa-mail-forward">&#xf064; mail-forward
                        </option>
                        
                         <option value="fa-mail-reply">&#xf112; mail-reply
                        </option>
                        
                         <option value="fa-mail-reply-all">&#xf122; mail-reply-all
                        </option>
                        
                         <option value="fa-male">&#xf183; male
                        </option>
                        
                         <option value="fa-map-marker">&#xf041; map-marker
                        </option>
                        
                         <option value="fa-maxcdn">&#xf136; maxcdn
                        </option>
                        
                         <option value="fa-meanpath">&#xf20c; meanpath
                        </option>
                        
                         <option value="fa-medkit">&#xf0fa; medkit
                        </option>
                        
                         <option value="fa-meh-o">&#xf11a; meh-o
                        </option>
                        
                         <option value="fa-microphone">&#xf130; microphone
                        </option>
                        
                         <option value="fa-microphone-slash">&#xf131; microphone-slash
                        </option>
                        
                         <option value="fa-minus">&#xf068; minus
                        </option>
                        
                         <option value="fa-minus-circle">&#xf056; minus-circle
                        </option>
                        
                         <option value="fa-minus-square">&#xf146; minus-square
                        </option>
                        
                         <option value="fa-minus-square-o">&#xf147; minus-square-o
                        </option>
                        
                         <option value="fa-mobile">&#xf10b; mobile
                        </option>
                        
                         <option value="fa-mobile-phone">&#xf10b; mobile-phone
                        </option>
                        
                         <option value="fa-money">&#xf0d6; money
                        </option>
                        
                         <option value="fa-moon-o">&#xf186; moon-o
                        </option>
                        
                         <option value="fa-mortar-board">&#xf19d; mortar-board
                        </option>
                        
                         <option value="fa-music">&#xf001; music
                        </option>
                        
                         <option value="fa-navicon">&#xf0c9; navicon
                        </option>
                        
                         <option value="fa-newspaper-o">&#xf1ea; newspaper-o
                        </option>
                        
                         <option value="fa-openid">&#xf19b; openid
                        </option>
                        
                         <option value="fa-outdent">&#xf03b; outdent
                        </option>
                        
                         <option value="fa-pagelines">&#xf18c; pagelines
                        </option>
                        
                         <option value="fa-paint-brush">&#xf1fc; paint-brush
                        </option>
                        
                         <option value="fa-paper-plane">&#xf1d8; paper-plane
                        </option>
                        
                         <option value="fa-paper-plane-o">&#xf1d9; paper-plane-o
                        </option>
                        
                         <option value="fa-paperclip">&#xf0c6; paperclip
                        </option>
                        
                         <option value="fa-paragraph">&#xf1dd; paragraph
                        </option>
                        
                         <option value="fa-paste">&#xf0ea; paste
                        </option>
                        
                         <option value="fa-pause">&#xf04c; pause
                        </option>
                        
                         <option value="fa-paw">&#xf1b0; paw
                        </option>
                        
                         <option value="fa-paypal">&#xf1ed; paypal
                        </option>
                        
                         <option value="fa-pencil">&#xf040; pencil
                        </option>
                        
                         <option value="fa-pencil-square">&#xf14b; pencil-square
                        </option>
                        
                         <option value="fa-pencil-square-o">&#xf044; pencil-square-o
                        </option>
                        
                         <option value="fa-phone">&#xf095; phone
                        </option>
                        
                         <option value="fa-phone-square">&#xf098; phone-square
                        </option>
                        
                         <option value="fa-photo">&#xf03e; photo
                        </option>
                        
                         <option value="fa-picture-o">&#xf03e; picture-o
                        </option>
                        
                         <option value="fa-pie-chart">&#xf200; pie-chart
                        </option>
                        
                         <option value="fa-pied-piper">&#xf1a7; pied-piper
                        </option>
                        
                         <option value="fa-pied-piper-alt">&#xf1a8; pied-piper-alt
                        </option>
                        
                         <option value="fa-pinterest">&#xf0d2; pinterest
                        </option>
                        
                         <option value="fa-pinterest-square">&#xf0d3; pinterest-square
                        </option>
                        
                         <option value="fa-plane">&#xf072; plane
                        </option>
                        
                         <option value="fa-play">&#xf04b; play
                        </option>
                        
                         <option value="fa-play-circle">&#xf144; play-circle
                        </option>
                        
                         <option value="fa-play-circle-o">&#xf01d; play-circle-o
                        </option>
                        
                         <option value="fa-plug">&#xf1e6; plug
                        </option>
                        
                         <option value="fa-plus">&#xf067; plus
                        </option>
                        
                         <option value="fa-plus-circle">&#xf055; plus-circle
                        </option>
                        
                         <option value="fa-plus-square">&#xf0fe; plus-square
                        </option>
                        
                         <option value="fa-plus-square-o">&#xf196; plus-square-o
                        </option>
                        
                         <option value="fa-power-off">&#xf011; power-off
                        </option>
                        
                         <option value="fa-print">&#xf02f; print
                        </option>
                        
                         <option value="fa-puzzle-piece">&#xf12e; puzzle-piece
                        </option>
                        
                         <option value="fa-qq">&#xf1d6; qq
                        </option>
                        
                         <option value="fa-qrcode">&#xf029; qrcode
                        </option>
                        
                         <option value="fa-question">&#xf128; question
                        </option>
                        
                         <option value="fa-question-circle">&#xf059; question-circle
                        </option>
                        
                         <option value="fa-quote-left">&#xf10d; quote-left
                        </option>
                        
                         <option value="fa-quote-right">&#xf10e; quote-right
                        </option>
                        
                         <option value="fa-ra">&#xf1d0; ra
                        </option>
                        
                         <option value="fa-random">&#xf074; random
                        </option>
                        
                         <option value="fa-rebel">&#xf1d0; rebel
                        </option>
                        
                         <option value="fa-recycle">&#xf1b8; recycle
                        </option>
                        
                         <option value="fa-reddit">&#xf1a1; reddit
                        </option>
                        
                         <option value="fa-reddit-square">&#xf1a2; reddit-square
                        </option>
                        
                         <option value="fa-refresh">&#xf021; refresh
                        </option>
                        
                         <option value="fa-remove">&#xf00d; remove
                        </option>
                        
                         <option value="fa-renren">&#xf18b; renren
                        </option>
                        
                         <option value="fa-reorder">&#xf0c9; reorder
                        </option>
                        
                         <option value="fa-repeat">&#xf01e; repeat
                        </option>
                        
                         <option value="fa-reply">&#xf112; reply
                        </option>
                        
                         <option value="fa-reply-all">&#xf122; reply-all
                        </option>
                        
                         <option value="fa-retweet">&#xf079; retweet
                        </option>
                        
                         <option value="fa-rmb">&#xf157; rmb
                        </option>
                        
                         <option value="fa-road">&#xf018; road
                        </option>
                        
                         <option value="fa-rocket">&#xf135; rocket
                        </option>
                        
                         <option value="fa-rotate-left">&#xf0e2; rotate-left
                        </option>
                        
                         <option value="fa-rotate-right">&#xf01e; rotate-right
                        </option>
                        
                         <option value="fa-rouble">&#xf158; rouble
                        </option>
                        
                         <option value="fa-rss">&#xf09e; rss
                        </option>
                        
                         <option value="fa-rss-square">&#xf143; rss-square
                        </option>
                        
                         <option value="fa-rub">&#xf158; rub
                        </option>
                        
                         <option value="fa-ruble">&#xf158; ruble
                        </option>
                        
                         <option value="fa-rupee">&#xf156; rupee
                        </option>
                        
                         <option value="fa-save">&#xf0c7; save
                        </option>
                        
                         <option value="fa-scissors">&#xf0c4; scissors
                        </option>
                        
                         <option value="fa-search">&#xf002; search
                        </option>
                        
                         <option value="fa-search-minus">&#xf010; search-minus
                        </option>
                        
                         <option value="fa-search-plus">&#xf00e; search-plus
                        </option>
                        
                         <option value="fa-send">&#xf1d8; send
                        </option>
                        
                         <option value="fa-send-o">&#xf1d9; send-o
                        </option>
                        
                         <option value="fa-share">&#xf064; share
                        </option>
                        
                         <option value="fa-share-alt">&#xf1e0; share-alt
                        </option>
                        
                         <option value="fa-share-alt-square">&#xf1e1; share-alt-square
                        </option>
                        
                         <option value="fa-share-square">&#xf14d; share-square
                        </option>
                        
                         <option value="fa-share-square-o">&#xf045; share-square-o
                        </option>
                        
                         <option value="fa-shekel">&#xf20b; shekel
                        </option>
                        
                         <option value="fa-sheqel">&#xf20b; sheqel
                        </option>
                        
                         <option value="fa-shield">&#xf132; shield
                        </option>
                        
                         <option value="fa-shopping-cart">&#xf07a; shopping-cart
                        </option>
                        
                         <option value="fa-sign-in">&#xf090; sign-in
                        </option>
                        
                         <option value="fa-sign-out">&#xf08b; sign-out
                        </option>
                        
                         <option value="fa-signal">&#xf012; signal
                        </option>
                        
                         <option value="fa-sitemap">&#xf0e8; sitemap
                        </option>
                        
                         <option value="fa-skype">&#xf17e; skype
                        </option>
                        
                         <option value="fa-slack">&#xf198; slack
                        </option>
                        
                         <option value="fa-sliders">&#xf1de; sliders
                        </option>
                        
                         <option value="fa-slideshare">&#xf1e7; slideshare
                        </option>
                        
                         <option value="fa-smile-o">&#xf118; smile-o
                        </option>
                        
                         <option value="fa-soccer-ball-o">&#xf1e3; soccer-ball-o
                        </option>
                        
                         <option value="fa-sort">&#xf0dc; sort
                        </option>
                        
                         <option value="fa-sort-alpha-asc">&#xf15d; sort-alpha-asc
                        </option>
                        
                         <option value="fa-sort-alpha-desc">&#xf15e; sort-alpha-desc
                        </option>
                        
                         <option value="fa-sort-amount-asc">&#xf160; sort-amount-asc
                        </option>
                        
                         <option value="fa-sort-amount-desc">&#xf161; sort-amount-desc
                        </option>
                        
                         <option value="fa-sort-asc">&#xf0de; sort-asc
                        </option>
                        
                         <option value="fa-sort-desc">&#xf0dd; sort-desc
                        </option>
                        
                         <option value="fa-sort-down">&#xf0dd; sort-down
                        </option>
                        
                         <option value="fa-sort-numeric-asc">&#xf162; sort-numeric-asc
                        </option>
                        
                         <option value="fa-sort-numeric-desc">&#xf163; sort-numeric-desc
                        </option>
                        
                         <option value="fa-sort-up">&#xf0de; sort-up
                        </option>
                        
                         <option value="fa-soundcloud">&#xf1be; soundcloud
                        </option>
                        
                         <option value="fa-space-shuttle">&#xf197; space-shuttle
                        </option>
                        
                         <option value="fa-spinner">&#xf110; spinner
                        </option>
                        
                         <option value="fa-spoon">&#xf1b1; spoon
                        </option>
                        
                         <option value="fa-spotify">&#xf1bc; spotify
                        </option>
                        
                         <option value="fa-square">&#xf0c8; square
                        </option>
                        
                         <option value="fa-square-o">&#xf096; square-o
                        </option>
                        
                         <option value="fa-stack-exchange">&#xf18d; stack-exchange
                        </option>
                        
                         <option value="fa-stack-overflow">&#xf16c; stack-overflow
                        </option>
                        
                         <option value="fa-star">&#xf005; star
                        </option>
                        
                         <option value="fa-star-half">&#xf089; star-half
                        </option>
                        
                         <option value="fa-star-half-empty">&#xf123; star-half-empty
                        </option>
                        
                         <option value="fa-star-half-full">&#xf123; star-half-full
                        </option>
                        
                         <option value="fa-star-half-o">&#xf123; star-half-o
                        </option>
                        
                         <option value="fa-star-o">&#xf006; star-o
                        </option>
                        
                         <option value="fa-steam">&#xf1b6; steam
                        </option>
                        
                         <option value="fa-steam-square">&#xf1b7; steam-square
                        </option>
                        
                         <option value="fa-step-backward">&#xf048; step-backward
                        </option>
                        
                         <option value="fa-step-forward">&#xf051; step-forward
                        </option>
                        
                         <option value="fa-stethoscope">&#xf0f1; stethoscope
                        </option>
                        
                         <option value="fa-stop">&#xf04d; stop
                        </option>
                        
                         <option value="fa-strikethrough">&#xf0cc; strikethrough
                        </option>
                        
                         <option value="fa-stumbleupon">&#xf1a4; stumbleupon
                        </option>
                        
                         <option value="fa-stumbleupon-circle">&#xf1a3; stumbleupon-circle
                        </option>
                        
                         <option value="fa-subscript">&#xf12c; subscript
                        </option>
                        
                         <option value="fa-suitcase">&#xf0f2; suitcase
                        </option>
                        
                         <option value="fa-sun-o">&#xf185; sun-o
                        </option>
                        
                         <option value="fa-superscript">&#xf12b; superscript
                        </option>
                        
                         <option value="fa-support">&#xf1cd; support
                        </option>
                        
                         <option value="fa-table">&#xf0ce; table
                        </option>
                        
                         <option value="fa-tablet">&#xf10a; tablet
                        </option>
                        
                         <option value="fa-tachometer">&#xf0e4; tachometer
                        </option>
                        
                         <option value="fa-tag">&#xf02b; tag
                        </option>
                        
                         <option value="fa-tags">&#xf02c; tags
                        </option>
                        
                         <option value="fa-tasks">&#xf0ae; tasks
                        </option>
                        
                         <option value="fa-taxi">&#xf1ba; taxi
                        </option>
                        
                         <option value="fa-tencent-weibo">&#xf1d5; tencent-weibo
                        </option>
                        
                         <option value="fa-terminal">&#xf120; terminal
                        </option>
                        
                         <option value="fa-text-height">&#xf034; text-height
                        </option>
                        
                         <option value="fa-text-width">&#xf035; text-width
                        </option>
                        
                         <option value="fa-th">&#xf00a; th
                        </option>
                        
                         <option value="fa-th-large">&#xf009; th-large
                        </option>
                        
                         <option value="fa-th-list">&#xf00b; th-list
                        </option>
                        
                         <option value="fa-thumb-tack">&#xf08d; thumb-tack
                        </option>
                        
                         <option value="fa-thumbs-down">&#xf165; thumbs-down
                        </option>
                        
                         <option value="fa-thumbs-o-down">&#xf088; thumbs-o-down
                        </option>
                        
                         <option value="fa-thumbs-o-up">&#xf087; thumbs-o-up
                        </option>
                        
                         <option value="fa-thumbs-up">&#xf164; thumbs-up
                        </option>
                        
                         <option value="fa-ticket">&#xf145; ticket
                        </option>
                        
                         <option value="fa-times">&#xf00d; times
                        </option>
                        
                         <option value="fa-times-circle">&#xf057; times-circle
                        </option>
                        
                         <option value="fa-times-circle-o">&#xf05c; times-circle-o
                        </option>
                        
                         <option value="fa-tint">&#xf043; tint
                        </option>
                        
                         <option value="fa-toggle-down">&#xf150; toggle-down
                        </option>
                        
                         <option value="fa-toggle-left">&#xf191; toggle-left
                        </option>
                        
                         <option value="fa-toggle-off">&#xf204; toggle-off
                        </option>
                        
                         <option value="fa-toggle-on">&#xf205; toggle-on
                        </option>
                        
                         <option value="fa-toggle-right">&#xf152; toggle-right
                        </option>
                        
                         <option value="fa-toggle-up">&#xf151; toggle-up
                        </option>
                        
                         <option value="fa-trash">&#xf1f8; trash
                        </option>
                        
                         <option value="fa-trash-o">&#xf014; trash-o
                        </option>
                        
                         <option value="fa-tree">&#xf1bb; tree
                        </option>
                        
                         <option value="fa-trello">&#xf181; trello
                        </option>
                        
                         <option value="fa-trophy">&#xf091; trophy
                        </option>
                        
                         <option value="fa-truck">&#xf0d1; truck
                        </option>
                        
                         <option value="fa-try">&#xf195; try
                        </option>
                        
                         <option value="fa-tty">&#xf1e4; tty
                        </option>
                        
                         <option value="fa-tumblr">&#xf173; tumblr
                        </option>
                        
                         <option value="fa-tumblr-square">&#xf174; tumblr-square
                        </option>
                        
                         <option value="fa-turkish-lira">&#xf195; turkish-lira
                        </option>
                        
                         <option value="fa-twitch">&#xf1e8; twitch
                        </option>
                        
                         <option value="fa-twitter">&#xf099; twitter
                        </option>
                        
                         <option value="fa-twitter-square">&#xf081; twitter-square
                        </option>
                        
                         <option value="fa-umbrella">&#xf0e9; umbrella
                        </option>
                        
                         <option value="fa-underline">&#xf0cd; underline
                        </option>
                        
                         <option value="fa-undo">&#xf0e2; undo
                        </option>
                        
                         <option value="fa-university">&#xf19c; university
                        </option>
                        
                         <option value="fa-unlink">&#xf127; unlink
                        </option>
                        
                         <option value="fa-unlock">&#xf09c; unlock
                        </option>
                        
                         <option value="fa-unlock-alt">&#xf13e; unlock-alt
                        </option>
                        
                         <option value="fa-unsorted">&#xf0dc; unsorted
                        </option>
                        
                         <option value="fa-upload">&#xf093; upload
                        </option>
                        
                         <option value="fa-usd">&#xf155; usd
                        </option>
                        
                         <option value="fa-user">&#xf007; user
                        </option>
                        
                         <option value="fa-user-md">&#xf0f0; user-md
                        </option>
                        
                         <option value="fa-users">&#xf0c0; users
                        </option>
                        
                         <option value="fa-video-camera">&#xf03d; video-camera
                        </option>
                        
                         <option value="fa-vimeo-square">&#xf194; vimeo-square
                        </option>
                        
                         <option value="fa-vine">&#xf1ca; vine
                        </option>
                        
                         <option value="fa-vk">&#xf189; vk
                        </option>
                        
                         <option value="fa-volume-down">&#xf027; volume-down
                        </option>
                        
                         <option value="fa-volume-off">&#xf026; volume-off
                        </option>
                        
                         <option value="fa-volume-up">&#xf028; volume-up
                        </option>
                        
                         <option value="fa-warning">&#xf071; warning
                        </option>
                        
                         <option value="fa-wechat">&#xf1d7; wechat
                        </option>
                        
                         <option value="fa-weibo">&#xf18a; weibo
                        </option>
                        
                         <option value="fa-weixin">&#xf1d7; weixin
                        </option>
                        
                         <option value="fa-wheelchair">&#xf193; wheelchair
                        </option>
                        
                         <option value="fa-wifi">&#xf1eb; wifi
                        </option>
                        
                         <option value="fa-windows">&#xf17a; windows
                        </option>
                        
                         <option value="fa-won">&#xf159; won
                        </option>
                        
                         <option value="fa-wordpress">&#xf19a; wordpress
                        </option>
                        
                         <option value="fa-wrench">&#xf0ad; wrench
                        </option>
                        
                         <option value="fa-xing">&#xf168; xing
                        </option>
                        
                         <option value="fa-xing-square">&#xf169; xing-square
                        </option>
                        
                         <option value="fa-yahoo">&#xf19e; yahoo
                        </option>
                        
                         <option value="fa-yelp">&#xf1e9; yelp
                        </option>
                        
                         <option value="fa-yen">&#xf157; yen
                        </option>
                        
                         <option value="fa-youtube">&#xf167; youtube
                        </option>
                        
                         <option value="fa-youtube-play">&#xf16a; youtube-play
                        </option>
                        
                         <option value="fa-youtube-square">&#xf166; youtube-square
                        </option>
                    </select>
                    
                </div><!-- /.tab-pane -->

                <div class="tab-pane videoTab" id="video_Tab">
                    
                    <label>Youtube ID:</label>
                        
                    <input type="text" class="form-control margin-bottom-20" id="youtubeID" placeholder="Enter a Youtube video ID" value="">
                        
                    <p class="text-center or">
                        <span>or</span>
                    </p>
                        
                    <label>Vimeo ID:</label>
                        
                    <input type="text" class="form-control margin-bottom-20" id="vimeoID" placeholder="Enter a Vimeo video ID" value="">
                        
                </div><!-- /.tab-pane -->

            </div><!-- /.tab-content -->

            <div class="alert alert-success" style="display: none;" id="detailsAppliedMessage">
                <button class="close fui-cross" type="button" id="detailsAppliedMessageHide"></button>
                The changes were applied successfully!
            </div>

            <div class="margin-bottom-5">
                <button type="button" class="btn btn-primary btn-embossed btn-sm btn-block" id="saveStyling"><span class="fui-check-inverted"></span> Apply Changes</button>
            </div>

            <div class="sideButtons clearfix">
                <button type="button" class="btn btn-inverse btn-embossed btn-xs" id="cloneElementButton">
                    <span class="fui-windows"></span> Clone
                </button>
                <button type="button" class="btn btn-warning btn-embossed btn-xs" id="resetStyleButton">
                    <i class="fa fa-refresh"></i> Reset
                </button>
                <button type="button" class="btn btn-danger btn-embossed btn-xs" data-target="#deleteElement" data-toggle="modal" id="removeElementButton">
                    <span class="fui-cross-inverted"></span> Remove
                </button>
            </div>
        
        </div><!-- /#styleEditor -->

        <div id="hidden">
            <iframe src="/builder/elements/skeleton.html" id="skeleton"></iframe>
        </div>

        <div id="loader">
            <span>{</span><span>}</span>
        </div>

        <div class="sandboxes" id="sandboxes" style="display: none"></div>

    </div><!-- /#builder -->

    <!-- modals -->

    <!-- export HTML popup -->
    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-hidden="true">
            
        <form action="" id="markupForm" method="post" class="form-horizontal">
        
        <input type="hidden" name="siteID" value="">
        
        <input type="hidden" name="markup" value="" id="markupField">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="fui-export"></span> Export your site</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger">
                        <button data-dismiss="alert" class="close fui-cross" type="button"></button>
                        Please note that the export function has been disabled in the live demo. Normally you would be able to export your entire site, including all Javascript files, CSS files and images.
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Doc type</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="doctype" id="doctype" placeholder="Doc type" value="<!--DOCTYPE html -->">
                        </div>
                    </div>
                    
                </div><!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal" id="exportCancel">Cancel & Close</button>
                    <button type="submit" type="button" class="btn btn-primary btn-embossed disabled" id="exportSubmit">Export Now</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        
        </form>
        
    </div><!-- /.modal -->

    <!-- delete single block popup -->
    <div class="modal fade small-modal" id="deleteBlock" tabindex="-1" role="dialog" aria-hidden="true">
                    
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                
                    Are you sure you want to delete this block?
                    
                </div><!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancel &  Close</button>
                    <button type="button" type="button" class="btn btn-primary btn-embossed" id="deleteBlockConfirm">Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
                
    </div><!-- /.modal -->

    <div class="modal fade small-modal" id="resetBlock" tabindex="-1" role="dialog" aria-hidden="true">
                        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                
                    <p>
                        Are you sure you want to reset this block?
                    </p>
                    <p>
                        All changes made to the content will be destroyed.
                    </p>
                    
                </div><!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancel & Close</button>
                    <button type="button" type="button" class="btn btn-primary btn-embossed" id="resetBlockConfirm">Reset Block</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
                
    </div><!-- /.modal -->

    <!-- delete page popup -->
    <div class="modal fade small-modal" id="deletePage" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                
                    <p>
                        Are you sure you want to delete this entire page?
                    </p>
                    
                </div><!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal" id="deletePageCancel">Cancel & Close</button>
                    <button type="button" type="button" class="btn btn-primary btn-embossed" id="deletePageConfirm">Delete Page</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
                
    </div><!-- /.modal -->

    <!-- delete elemnent popup -->
    <div class="modal fade small-modal" id="deleteElement" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                
                    <p>
                        Are you sure you want to delete this element? Once deleted, it can not be restored.
                    </p>
                    
                </div><!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal" id="deletePageCancel">Cancel & Close</button>
                    <button type="button" type="button" class="btn btn-primary btn-embossed" id="deleteElementConfirm">Delete Block</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
                
    </div><!-- /.modal -->

    <!-- edit content popup -->
    <div class="modal fade" id="editContentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                
                    <textarea id="contentToEdit"></textarea>
                    
                </div><!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancel & Close</button>
                    <button type="button" type="button" class="btn btn-primary btn-embossed" id="updateContentInFrameSubmit">Update Content</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
                
    </div><!-- /.modal -->

    <!-- preview popup -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-hidden="true">
        
       
        
        
        <div class="modal-dialog">
            
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="fui-window"></span> Page Preview</h4>
                </div>
                
                <div class="modal-body">
                
                    <p>
                        Please Save Changes before go to preview page.
                    </p>
                    
                </div><!-- /.modal-body -->
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal"><span class="fui-cross"></span> Cancel & Close</button>
                    <a  href="{{route('landing_page.show',['slug'=>$page->slug])}}" class="btn btn-primary btn-embossed" target="_blank"><span class="fui-export"></span> Preview Changes</a>
                </div>
                
            </div><!-- /.modal-content -->
            
        </div><!-- /.modal-dialog -->
            
        </form> 
            
    </div><!-- /.modal -->

{{--   <!-- preview popup -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-hidden="true">
        
        <form action="_preview.php" target="_blank" id="markupPreviewForm" method="post" class="form-horizontal">
        
        <input type="hidden" name="markup" value="" id="markupField">
        
        <div class="modal-dialog">
            
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="fui-window"></span> Page Preview</h4>
                </div>
                
                <div class="modal-body">
                
                    <p>
                        Please note that links to other pages will not function properly in the preview, you can only preview a single page at once.
                    </p>
                    
                </div><!-- /.modal-body -->
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal"><span class="fui-cross"></span> Cancel & Close</button>
                    <button type="submit" class="btn btn-primary btn-embossed"><span class="fui-export"></span> Preview Changes</button>
                </div>
                
            </div><!-- /.modal-content -->
            
        </div><!-- /.modal-dialog -->
            
        </form> 
            
    </div><!-- /.modal -->--}}

    <div class="modal fade errorModal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
        <div class="modal-dialog modal-sm">
            
            <div class="modal-content">
                
                <div class="modal-body">
                                
                </div><!-- /.modal-body -->
                                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal"><span class="fui-cross"></span> Close Window</button>
                </div>
                
            </div><!-- /.modal-content -->
            
        </div><!-- /.modal-dialog -->
                
    </div><!-- /.modal -->
    
    <div class="modal fade successModal" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
        <div class="modal-dialog modal-sm">
            
            <div class="modal-content">
                                        
                <div class="modal-body">
                                                                    
                </div><!-- /.modal-body -->
                                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal"><span class="fui-cross"></span> Close Window</button>
                </div>
                
            </div><!-- /.modal-content -->
            
        </div><!-- /.modal-dialog -->
                
    </div><!-- /.modal -->

   {{-- <div class="modal fade" id="loadModal" tabindex="-1" role="dialog" aria-labelledby="loadModal" aria-hidden="true">
        
        <div class="modal-dialog">
            
            <div class="modal-content">
                                        
                <div class="modal-body">

                    <h4>Please Note</h4>

                    <p>
                        This is a live demo of <a href="http://codecanyon.net/item/html-builder-frontend-version/8432859" target="_blank">Chilly Orange's HTML Builder</a>. Please note that this demo will remain live for <b>one hour</b> after which it will be automatically deleted. Once the hour has passed, you are free to start another demo.
                    </p>
                                                                    
                </div><!-- /.modal-body -->
                                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fui-check"></span> I understand, continue to live demo</button>
                </div>
                
            </div><!-- /.modal-content -->
            
        </div><!-- /.modal-dialog -->
                
    </div><!-- /.modal --> --}}
    <!-- Load JS here for greater good =============================-->

    <script>
    var siteUrl = '';
    var baseUrl = '';
    </script>
    <script src="/builder/assets/js/vendor/jquery.min.js"></script>
    <script src="/builder/assets/js/vendor/jquery-ui.min.js"></script>
    <script src="/builder/assets/js/vendor/flat-ui-pro.min.js"></script>
    <script src="/builder/assets/js/vendor/chosen.min.js"></script>
    <script src="/builder/assets/js/vendor/jquery.zoomer.js"></script>
    <script src="/builder/assets/js/vendor/spectrum.js"></script>
    <script src="/builder/assets/js/vendor/ace/ace.js"></script>
    <script src="/builder/assets/js/builder.js"></script>
  {{--   <script src="{{elixir("js/angular.js")}}"></script>
<script src="{{elixir("js/ng-dependencies.js")}}"></script> --}}
     <script>
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

</script>



{{-- <script src="{{elixir('js/ng-app.js')}}"></script> --}}
   {{-- <script>
    $('#loadModal').modal('show');
    </script> --}}
{{--    <script src="/builder/assets/js/topbar.js"></script> 
--}}</html>