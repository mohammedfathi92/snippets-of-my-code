/**
 * Created by Mohammed on 4/29/16.
 */
var ctrl = angular.module("controllers", []);
var lang = 'en';
var categoriesController = function ($scope, $rootScope, listingService, $stateParams, $timeout) {
    $scope.categories = [];
    $scope.loading = true;
    if (!typeof $rootScope.lang == 'undefined' && $rootScope.lang) {
        lang = $rootScope.lang;

    }
    if (!lang) lang = 'en';
    // get categories
    var getCats = function () {
        listingService.get("/" + lang + "/categories/listAll", function (result) {
            $scope.loading = false;
            $scope.categories = result.data;
            angular.element(".catall").removeClass('fadeOut animated').show('fadeIn animated')

        });
    }
    $rootScope.$on('$translateChangeSuccess', function (event, data) {
        laraApp.lang = lang = $rootScope.lang;
        getCats();
    });

    getCats();
    setInterval(function () {
        //if ($stateParams.length == 0) // get categories if this is the main page
            getCats();
    }, 30000)

}


var productsController = function ($scope, $rootScope, $http, listingService, $routeParams, $stateParams, $timeout,$compile) {
    $scope.products = [];

    $scope.loading = true;
    $scope.noResults = false;
    $scope.productsView = null;
    // Start Filters
    $rootScope.prevFilters = [];
    $scope.filters = [];
    $scope.selectedCategory = 0;
    $scope.prevIsDetails = false;
    $scope.selectedFilters = [];
    var filtersIsLoaded = false;


    $routeParams = $stateParams;
    $scope.$on('$stateChangeSuccess', function (ev, to, toParams, from, fromParams) {
        if (from.name == 'details') {
            if (sessionStorage.prevCheckedFilters) {
                $scope.selectedFilters = JSON.parse(sessionStorage.prevCheckedFilters);
                $scope.prevIsDetails = true;
            }

        } else {
            sessionStorage.prevCheckedFilters = JSON.stringify([]);
            $scope.selectedFilters = [];
            $scope.prevIsDetails = false;

        }


    });

    var getProducts = function () {
        if (typeof $routeParams.slug != "undefined") {
            if (!typeof $rootScope.lang == 'undefined' && $rootScope.lang) {
                lang = $rootScope.lang;

            }
            $http.get("/" + lang + "/categories/products/" + $routeParams.slug).success(function (result) {
                if (result) {

                    $scope.loading = false;
                    $scope.productsView = result;
                    $compile($scope.productsView)($scope);

                    if ($scope.selectedFilters.length) {
                        $scope.sendFilters();
                    }

                    angular.element('.proall').show('bounceInUp animated');

                } else {
                    $scope.noResults = true;
                }

            }).catch(function (err) {
                // Log error somehow.
            })
                .finally(function () {
                    // Hide loading spinner whether our call succeeded or failed.
                    $scope.loading = false;
                });
            if (!filtersIsLoaded) {
                $http.get("/" + lang + "/categories/ajax/filters/" + $routeParams.slug).success(function (resp) {
                    if (typeof resp.success != 'undefined' && resp.success) {
                        if (resp.data.length) {
                            for (i = 0; i < resp.data.length; i++) {
                                if (resp.data[i].sub_filters.length) {
                                    for (j = 0; j < resp.data[i].sub_filters.length; j++) {
                                        if ($scope.selectedFilters.indexOf(resp.data[i].sub_filters[j].id) !== -1 && $scope.prevIsDetails) {
                                            resp.data[i].sub_filters[j].selected = true;
                                        } else {
                                            resp.data[i].sub_filters[j].selected = false;
                                        }

                                    }
                                }

                            }
                            $scope.filters = (resp.data);
                            filtersIsLoaded = true;
                        }

                    }

                });
            }
        }

    }

    $scope.sendFilters = function () {


        // save filters in session
        var $sf = JSON.stringify($scope.selectedFilters);
        sessionStorage.prevCheckedFilters = JSON.stringify({});
        sessionStorage.prevCheckedFilters = $sf;


        $http.post("/" + $rootScope.lang + "/products/ajax/" + $routeParams.slug + "/filters", {filters: $scope.selectedFilters})
            .success(function (resp) {
                //if (typeof resp.success != 'undefined' && resp.success) {
                //$scope.products = resp.data;
                $scope.productsView = resp;
                // }

            });


    }


    // end filters
    if($scope.prevIsDetails==false){
        getProducts();
    }

    $timeout(function () {
        if (!$scope.selectedFilters.length && $scope.prevIsDetails==false) {
            //if (typeof $routeParams.slug != 'undefined')
            getProducts();
        }

    }, 30000)

}

var productDetails = function ($scope, $rootScope, $http, $routeParams, $stateParams) {
    $scope.product = [];
    $scope.product.photos = [];
    $scope.product.properties = [];
    $scope.loading = true;

    $rootScope.prevUrl = '#/';
    $routeParams = $stateParams;
    $scope.$on('$stateChangeSuccess', function (ev, to, toParams, from, fromParams) {
        if (from.name == 'products') {
            $rootScope.prevUrl = '#/' + from.name + "/" + fromParams.slug;
            $rootScope.selectedFilters;
        }

    });
    if (typeof $routeParams.productId != "undefined") {
        if (!typeof $rootScope.lang == 'undefined' && $rootScope.lang) {
            lang = $rootScope.lang;

        }
        $http.get(lang + "/products/" + $routeParams.productId).success(function (result) {
            if (result.success) {
                $scope.product = result.data;
                $scope.product.photos = result.data.photos;
                $scope.product.properties = result.data.properties;
                $scope.loading = false;
                angular.element("#spicContainer").show("fade");
            }


        }).catch(function (err) {
            console.log(err);
        }).finally(function () {
            // Hide loading spinner whether our call succeeded or failed.
            $scope.loading = false;
        });
    }
}

var searchCtrl = function ($scope, $rootScope, listingService, $routeParams, $stateParams) {

    $scope.results = [];
    $routeParams = $stateParams;
    $scope.$watch('search', function () {
        var word = $scope.search;
        if (word && word.trim()) {
            if (!typeof $rootScope.lang == 'undefined' && $rootScope.lang) {
                lang = $rootScope.lang;

            }
            listingService.get(lang + "/products/search/" + word, function (result) {
                $scope.results = result.data;
            });
        } else {
            $scope.results = [];
        }

    });

}

var compareCtrl = function ($rootScope, $scope, listingService, $routeParams, $stateParams, $http) {
    $scope.compareList = [];
    $scope.categoryProperties = [];
    $rootScope.$watchCollection("compareList", function () {

        listingService.get(laraApp.appUrl + "/compare", function (resp) {

            if (typeof resp.success != 'undefined' && resp.success) {
                $scope.compareList = resp.data;
                angular.element('.ct-js-cart__button').show();
                if (typeof $scope.compareList[0].properties != 'undefined')
                    $scope.categoryProperties = $scope.compareList[0].properties;
            } else {
                angular.element('.ct-js-cart__button').hide();
                $scope.compareList = [];
                $scope.categoryProperties = [];
            }
        });
    });

    $scope.removeCompareProduct = function (id, index) {
        if (id) {
            listingService.get(laraApp.appUrl + "/compare?remove=" + id, function (resp) {
                $scope.compareList.splice(index, 1);
                if (typeof resp.success != 'undefined' && resp.success) {
                    $scope.compareList = resp.data;

                    $scope.categoryProperties = $scope.compareList[0].properties;
                } else {

                        console.log('compare list is clear');
                        angular.element('.ct-js-cart__button').bind('click').hide();
                        angular.element('body').removeClass('cart-is-open');

                    $scope.compareList = [];
                    $scope.categoryProperties = [];
                }
            });
        }

    }


}
ctrl.controller("categoriesCtrl", categoriesController)
    .controller("productsCtrl", productsController)
    .controller("productDetailsCtrl", productDetails)
    .controller("homeSliderCtrl", function ($scope, $rootScope, $http, $timeout, $document) {
        $scope.homeSlidesHtml = null;
        $scope.lang = 'ar';
        if (!typeof $rootScope.lang == 'undefined' && $rootScope.lang) {
            lang = $rootScope.lang;

        }
        if (!lang) lang = 'ar';
        $scope.getHomeSlides = function () {
            $http.get(lang + "/home_slides").success(function (resp) {

                $scope.homeSlidesHtml = resp;

            });
        }

        $scope.getHomeSlides();

        $rootScope.$on('$translateChangeSuccess', function (event, data) {
            lang = $rootScope.lang;
            $scope.getHomeSlides();
        });


        // Timeout timer value
        var TimeOutTimerValue = (1000 * 60) * 1;// 1 Minuet

        // Start a timeout
        var TimeOut_Thread = $timeout(function () {

            $scope.getHomeSlides();

        }, TimeOutTimerValue);
        var bodyElement = angular.element($document);

        /// Keyboard Events
        bodyElement.bind('keydown', function (e) {
            TimeOut_Resetter(e)
        });
        bodyElement.bind('keyup', function (e) {
            TimeOut_Resetter(e)
        });

        /// Mouse Events
        bodyElement.bind('click', function (e) {
            TimeOut_Resetter(e)
        });
        bodyElement.bind('mousemove', function (e) {
            TimeOut_Resetter(e)
        });
        bodyElement.bind('DOMMouseScroll', function (e) {
            TimeOut_Resetter(e)
        });
        bodyElement.bind('mousewheel', function (e) {
            TimeOut_Resetter(e)
        });
        bodyElement.bind('mousedown', function (e) {
            TimeOut_Resetter(e)
        });

        /// Touch Events
        bodyElement.bind('touchstart', function (e) {
            TimeOut_Resetter(e)
        });
        bodyElement.bind('touchmove', function (e) {
            TimeOut_Resetter(e)
        });

        /// Common Events
        bodyElement.bind('scroll', function (e) {
            TimeOut_Resetter(e)
        });
        bodyElement.bind('focus', function (e) {
            TimeOut_Resetter(e)
        });


        function TimeOut_Resetter(e) {

            /// Stop the pending timeout
            $timeout.cancel(TimeOut_Thread);

            /// Reset the timeout
            TimeOut_Thread = $timeout(function () {
                $scope.getHomeSlides();
            }, TimeOutTimerValue);
        }


    })
    .controller("searchCtrl", searchCtrl)
    .directive('resultitem', function ($location) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var href = attrs.href;
                element.bind('click', function (e) {


                    angular.element(".productinfo").addClass('bounceInRight-duration bounceInRight');
                    angular.element(".productinfo").removeClass('bounceOutRight');
                    $location.url(href);
                });
            }
        };
    })
    .controller("compareCtrl", ['$rootScope', '$scope', 'listingService', '$routeParams', '$stateParams', compareCtrl])
    .controller('filtersCtrl', function ($rootScope, $scope, $http, $routeParams, $stateParams) {
        $scope.filters = [];
        $scope.selectedCategory = 0;
        $scope.selectedFilters = [];

        $scope.sendFilters = function () {

            $http.post(laraApp.appUrl + "/products/ajax/filters", {filters: $scope.selectedFilters}).success(function (resp) {
                //if (typeof resp.success != 'undefined' && resp.success) {
                //$scope.products = resp.data;
                $scope.productsView = resp
                //}

            });
        }
        $http.get(laraApp.appUrl + "/categories/ajax/filters/" + $stateParams.slug).success(function (resp) {
            if (typeof resp.success != 'undefined' && resp.success) {
                $scope.filters = resp.data;
            }

        });
    })
    .controller("languageSwitcher", ['$scope', '$rootScope', '$http', '$translate', '$location',
        function ($scope, $rootScope, $http, $translate, $location) {
            $scope.lang = 'ar';
            $scope.changeLanguage = function (langKey) {

                $translate.use(langKey);
                laraApp.lang = langKey;
                // window.history.pushState({url: "" + targetUrl + ""}, targetTitle, targetUrl);
                window.history.pushState({url: "" + laraApp.appUrl + "/" + langKey + ""}, langKey, laraApp.appUrl + "/" + langKey);

                //window.location.href = laraApp.appUrl + "/" + langKey;

            };

            $rootScope.$on('$translateChangeSuccess', function (event, data) {
                var language = data.language;

                laraApp.lang = language;
                $scope.lang = language;
                $rootScope.lang = language;
                $rootScope.langName = language === 'ar' ? 'عربي' : 'English';


                $rootScope.default_direction = language === 'ar' ? 'rtl' : 'ltr';
                $rootScope.opposite_direction = language === 'ar' ? 'ltr' : 'rtl';

                $rootScope.default_float = language === 'ar' ? 'right' : 'left';
                $rootScope.opposite_float = language === 'ar' ? 'left' : 'right';
                // set current language in session
                $http.get(laraApp.appUrl + '/get_lang?set=' + $scope.lang).success(function (resp) {

                });


            });
        }]);