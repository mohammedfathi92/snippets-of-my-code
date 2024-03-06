<!DOCTYPE html>
<html class="no-js" lang="en" ng-app="samsungStore" data-ng-controller="languageSwitcher">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Single Product e-Commerce HTML Template">
    <meta name="author" content="createIT">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="assets/images/demo-content/favicon.png">
    <link rel="apple-touch-icon" href="assets/images/demo-content/favicon.png">
    <title>Samsung Store</title>

    {{--<link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css"/>--}}
    <link href="assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/js/plugins/vkeyboard/dist/css/keyboard.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/js/plugins/vkeyboard/dist/css/keyboard-previewkeyset.min.css" rel="stylesheet" type="text/css"/>
    {{--<link href="assets/js/plugins/vkeyboard/dist/css/keyboard-dark.min.css" rel="stylesheet" type="text/css"/>--}}

    <link rel="stylesheet" data-ng-href="assets/css/app-style-<%lang%>.css">
    <style type="text/css">
        .ui-keyboard-langSwitcher {
            background-color: #00aa00 !important;
            color: #fff !important;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <script src="assets/js/es5-shim.min.js"></script><![endif]-->
</head>
<body class="cssAnimate drone">

<div class="ct-preloader">
    <div class="ct-preloader-inner">
        <div class="inner">
            <div class="container">
                <div class="row">


                    <div class="spinner">
                        <div class="dot1"></div>
                        <div class="dot2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ct-cart" data-ng-controller="compareCtrl" data-ng-show="compareList.length">
    <div class="ct-cart__inner">
        <div class="ct-cart__button ct-js-cart__button" data-ng-show="compareList.length">
            <div><img class="mobileicons" src="assets/images/comparepic.png"/></div>
            <div class="comparetext" translate="compare"> Compare</div>
        </div>
        <div class="ct-cart__message"><img class="arricons rotate180" src="assets/images/arrowswhite.svg"/></div>
        <div class="ct-cart__product">
            <div class="">
                <div class="">
                    <table data-role="table" id="phone-table" data-mode="columntoggle" data-column-btn-text="Compare..."
                           data-ng-show="compareList.length"
                           data-column-btn-theme="a" class="phone-compare ui-shadow table-stroke">
                        <thead>
                        <tr>

                            <th class="labell" translate="product_name">اسم المنتج</th>

                            <th class="text-center" data-ng-repeat="item in compareList">
                                <img class="compareclose" src="assets/images/circle.svg" alt="Circle"
                                     data-ng-click="removeCompareProduct(item.id,$index)">
                                <h3><%item.name%></h3>
                            </th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr class="photos">
                            <th class="labell">Photo</th>
                            <td data-ng-repeat="item in compareList"><a href="#img-iphone5" data-rel="popup"
                                                                        data-position-to="window">
                                    <img data-ng-src="<% item.photo %>"></a></td>
                        </tr>
                        <tr data-ng-repeat="property in compareList[0].properties">
                            <th class="labell"><%property.property_name%></th>

                            <td data-ng-repeat="product in compareList">
                                <% product.properties[$parent.$index].value %>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                    <p class="alert alert-info" data-ng-hide="compareList.length"
                       translate="message_no_products_to_compare"></p>

                </div>

            </div>
        </div>
    </div>
</div>

<div id="ct-js-wrapper" class="ct-js-wrapper ct-pageWrapper" data-ng-controller="homeSliderCtrl">
    <!-- Navigation-->
    <nav data-height="80" class="navbar navbar-dark navbar-fixed navbar-desktop">
        <div class="container-fluid pad25">
            <div class="row">
                <div class="col-xs-8">
                    <ul role="menu" class="nav navbar-nav">

                        <li class="nav-item-toggle">
                            <a href="#/"><i class=""><img class="aricon999" src="assets/images/interface.svg" alt="">
                                    <span class="searchtxt" translate="products">Products</span></i>
                            </a>
                        </li>

                        <li class="ct-search-link">
                            <a href="#"><i class="">
                                    <img class="aricon339" src="assets/images/search.svg" alt="">
                                    <span class="searchtxt" translate="search">Search</span></i></a></li>

                        <li>
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"><i class="">
                                    <img class="" src="{{asset('assets/images/pullet.png')}}" alt="pullet"><span
                                            class="searchtxt"><%langName%></span></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:;" data-ng-click="changeLanguage('en')"
                                       translate="btn_lang_en"></a></li>
                                <li><a href="javascript:;" data-ng-click="changeLanguage('ar')"
                                       translate="btn_lang_ar"></a></li>
                            </ul>
                        </li>

                    </ul>
                </div>

                <div class="col-xs-4">
                    <div class="navbar-header"><a href="#" class="navbar-brand">
                            <img src="assets/images/samsunglogo.png" alt=""></a>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <div id="homeSlider" data-ng-bind-html="homeSlidesHtml|to_trusted"></div>

</div>
<div class="clearfix"></div>
<form action="#" class="ct-searchForm">
    <div class="inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1" data-ng-controller="searchCtrl">
                    <div class="form-group">
                        <a href="#" class="ct-searchForm-close closesarch">
                            <img class="aricon" src="assets/images/close.svg"/>
                        </a>
                    </div>
                    <div class="form-group">


                        <input id="cf-search-form" type="text" value="ابحث باسم المنتج ..." required
                               class="form-control" data-ng-model="search" autocomplete="off">
                        <button type="submit" class="ct-search-btn "><img class="aricon888"
                                                                          src="assets/images/search.svg"/></button>
                    </div>
                    <div id="number" class="searchunder">

                        <div class="row paddrow">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 searchrow"
                                 data-ng-repeat="item in results">
                                <a href="#/product/<%item.id%>" resultItem>
                                    <div class="searchflpic">
                                        <img data-ng-src="<% laraApp.appUrl+item.photo %>"/>
                                    </div>
                                    <div class="searchflname">
                                        <% item.name %>
                                    </div>
                                </a>
                            </div>


                        </div>
                        <div data-ng-hide="results.length" class="alert alert-danger"
                             translate="search_results_not_found">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
<!-- Mobile Menu //-->

<div class="navbar-beacon2 productinfo ">
    <a href="<%prevUrl%>" class="ct-productsinfo-close closespec mleftin hidden-print">
        <img class="aricon" src="assets/images/close.svg"/>
    </a>
    <a href="javascript:;" onclick="window.print();" class="mleftin print_product_btn hidden-print"
       style="    margin-left: 82px;">
        <img class="aricon" src="assets/images/printer.svg">
    </a>

    <div class=" " id="#productDetails">
        <div ui-view="productDetails"></div>
    </div>

</div>
<div class="navbar-beacon">
    <div ui-view="main"></div>

</div>

<!-- JavaScripts-->
<script src="assets/js/disrupt.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>

<script src="{{asset('js/angular.js')}}"></script>
<script src="assets/js/plugins/vkeyboard/dist/js/jquery.keyboard.js"></script>
<script src="assets/js/plugins/vkeyboard/dist/js/jquery.mousewheel.min.js"></script>
{{--<script src="assets/js/plugins/vkeyboard/dist/js/jquery.keyboard.extension-caret.min.js"></script>--}}
<script src="assets/js/plugins/vkeyboard/dist/js/jquery.keyboard.extension-typing.min.js"></script>
<script src="assets/js/plugins/vkeyboard/dist/js/jquery.keyboard.extension-previewkeyset.min.js"></script>
<script src="assets/js/plugins/vkeyboard/dist/layouts/keyboard-layouts-microsoft.min.js"></script>
{{--<script src="assets/js/plugins/vkeyboard/dist/layouts/arabic.min.js"></script>--}}
<script src="assets/js/main.js"></script>
<script src="assets/js/jquery.print.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<!-- Plugins-->

</body>


</html>
