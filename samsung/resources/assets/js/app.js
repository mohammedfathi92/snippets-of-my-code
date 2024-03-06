/**
 * Created by Mohammed on 4/7/16.
 */
var app = angular.module('samsungStore', ['ngRoute', 'ngSanitize', 'ui.router', 'ngAnimate', 'ngTouch','listing.services',
    'controllers', 'pascalprecht.translate',
    'ngCookies', 'checklist-model','ui.bootstrap','angularSpinners','ocNgRepeat']);
app.filter('to_trusted', ['$sce', function ($sce) {
    return function (text) {
            try {
                return  $sce.trustAsHtml(text);
            }catch (e){
                
            }


    };
}]);
app.config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}).config(['$httpProvider', function ($httpProvider) {
    // sets the X-Request-With to be sent on every ajax request with a value of XMLHttpRequest
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}]);
app.config(['$stateProvider', '$urlRouterProvider', function ($stateProvider, $urlRouterProvider) {
    // For any unmatched url, redirect to /state1
    $urlRouterProvider.otherwise("/");

    $stateProvider.state('home', {
        url: "/",
        views: {
            "main": {
                templateUrl: 'templates/categories_list.html',
                controller: 'categoriesCtrl'
            },

        }

    }).state('products', {
        url: "/products/:slug",
        views: {
            "main": {
                templateUrl: 'templates/products_list.html',
                controller: 'productsCtrl'
            },

        }


    }).state('details', {
        url: '/product/:productId',
        views: {
            "productDetails": {
                templateUrl: 'templates/product_details.html',
                controller: 'productDetailsCtrl'
            }

        }

    });
}]).config(['$translateProvider', function ($translateProvider) {
    $translateProvider.registerAvailableLanguageKeys(['en', 'ar'], {
        'en_US': 'en',
        'ar_EG': 'ar'

    });

    $translateProvider.useUrlLoader(laraApp.appUrl + '/get_lang')
        .use('en')
        .preferredLanguage('en')
        .useMissingTranslationHandlerLog()
        .useLocalStorage()
        .useSanitizeValueStrategy('escape');
}])
    .directive("owlCarousel", function() {
        return {
            restrict: 'E',
            transclude: false,
            link: function (scope) {
                scope.initCarousel = function(element) {
                    // provide any default options you want
                    var defaultOptions = {
                        loop: true, // duplicate last and first items to get loop illusion
                        autoplay: true,
                        lazyLoad:true,
                        lazyFollow:true,
                        lazyEffect:"fade",
                        margin: 5,
                        nav: true, // prev & next links
                        responsive: { // number of items shown
                            320:{
                                items:2
                            },
                            480:{
                                items:3
                            },
                            768:{
                                items:4
                            },
                            992:{
                                items:6
                            }
                        }
                    };
                    var customOptions = scope.$eval($(element).attr('data-options'));
                    // combine the two options objects
                    for(var key in customOptions) {
                        defaultOptions[key] = customOptions[key];
                    }
                    // init carousel
                    // angular.element(element).data('owl.carousel').destroy();
                    angular.element(element).owlCarousel(defaultOptions);
                };
            }
        };
    })
    .directive('owlCarouselItem', function($timeout) {
        return {
            restrict: 'EA',
            transclude: false,
            link: function(scope, element) {
                // wait for the last item in the ng-repeat then call init with timeout
                if(scope.$last) {
                    $timeout(function () {
                        
                        scope.initCarousel(element.parent());
                    },50);
                }
            }
        };
    })
    .constant("conf", laraApp)
app.run(function($rootScope, $timeout, $document,$location,$http) {

    // this for local app only
    if(laraApp.checkUpdatesTimer){
        var now = new Date();
        var checkUpdateTimer = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 30, 0, 0) - now;
        if (checkUpdateTimer < 0) {
            checkUpdateTimer += 86400000; // it's after 10am, try 10am tomorrow.
        }

       // var checkUpdateTimer=(1000*60)*laraApp.checkUpdatesTimer;// 30 minuets
        var checkUpdates=function () {
            $http.get(laraApp.appUrl+"/check_updates");
        }
        $timeout(function(){checkUpdates()},checkUpdateTimer);

    }


    // Timeout timer value
    var TimeOutTimerValue = (1000*60)*5;// 5 Minuets

    // Start a timeout
    var TimeOut_Thread = $timeout(function(){

        resetApp()

    } , TimeOutTimerValue);
    var bodyElement = angular.element($document);

    /// Keyboard Events
    bodyElement.bind('keydown', function (e) { TimeOut_Resetter(e) });
    bodyElement.bind('keyup', function (e) { TimeOut_Resetter(e) });

    /// Mouse Events
    bodyElement.bind('click', function (e) { TimeOut_Resetter(e) });
    bodyElement.bind('mousemove', function (e) { TimeOut_Resetter(e) });
    bodyElement.bind('DOMMouseScroll', function (e) { TimeOut_Resetter(e) });
    bodyElement.bind('mousewheel', function (e) { TimeOut_Resetter(e) });
    bodyElement.bind('mousedown', function (e) { TimeOut_Resetter(e) });

    /// Touch Events
    bodyElement.bind('touchstart', function (e) { TimeOut_Resetter(e) });
    bodyElement.bind('touchmove', function (e) { TimeOut_Resetter(e) });

    /// Common Events
    bodyElement.bind('scroll', function (e) { TimeOut_Resetter(e) });
    bodyElement.bind('focus', function (e) { TimeOut_Resetter(e) });

    function resetApp()
    {

        $rootScope.products=[];
        $rootScope.filters=[];
        $rootScope.results=[];


        // close product detils panel
        angular.element('.closespec').trigger('click');
        angular.element('.ct-productsinfo-close').trigger('click');
        // close product detils panel
        angular.element(".productinfo")
            .removeClass('bounceInRight')
            .addClass('bounceOutRight');


        // close compare panel

        if(angular.element('body').hasClass('cart-is-open')){

            angular.element('.ct-js-cart__button').trigger('click');
        }
        // reset compare session
        $http.get(laraApp.appUrl+'/products/ajax/resetCompare');
        $rootScope.compareList=[];

        angular.element('#cf-search-form').val("");// clear search input box
        angular.element('.closecat').trigger('click');

        angular.element(".navbar-beacon")
            .removeClass('bounceInRight-duration bounceInRight')
            .addClass('bounceInRight-duration bounceOutRight');

        angular.element('.closesarch').trigger('click');
        $location.url("/");
    }

    function TimeOut_Resetter(e)
    {

        /// Stop the pending timeout
        $timeout.cancel(TimeOut_Thread);

        /// Reset the timeout
        TimeOut_Thread = $timeout(function(){ resetApp() } , TimeOutTimerValue);
    }

})
