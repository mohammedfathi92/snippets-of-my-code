/**
 * Created by Mohammed on 7/23/16.
 */

var ctrl = angular.module('controllers', ['angular.filter']);
ctrl.controller('uploaderCtrl', function ($scope, $http, Upload, $timeout, $attrs) {

    $scope.photos = [];
    $scope.videos = [];
    $scope.files = [];
    var $default_options = {
        'resize': '',
        'uploadUrl': '',
        'prefix': ''
    };

    var resize = [150, 150];
    var prefix = '';
    if ($attrs.resize) {
        resize = $attrs.resize.split(",");
    }
    if ($attrs.prefix) {
        prefix = $attrs.prefix;
    }

    var options = {
        'resize': resize,
        'uploadUrl': $attrs.uploadUrl,
        'prefix': prefix
    }

    var settings = angular.extend({}, $default_options, options);

    var upload_url = $attrs.uploadUrl;

    $scope.uploadPhoto = function (files, errFiles) {
        $scope.photos = files;

        $scope.errFiles = errFiles;
        angular.forEach(files, function (file) {
            file.upload = Upload.upload({
                url: settings.uploadUrl,
                data: {file: file, resize: settings.resize, prefix: settings.prefix}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;

                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                    evt.loaded / evt.total));
            });
        });
    }
    $scope.removeByName = function (file) {
        var id = "file-" + file;
        var el = document.getElementById(id)
        // send post with delete method.. it's not allowed to use $http.post
        $http.delete(upload_url + "/" + file, {'_method': "DELETE"}).success(function () {
            // remove element from dom
            if (el) {
                el.remove();
            }
            if (toastr !== undefined)
                toastr.success("Photo Removed Successfully");
        });
    }
    $scope.removePhoto = function (index) {

        var file = $scope.photos[index].result.file;
        // send post with delete method.. it's not allowed to use $http.post
        $http.delete(upload_url + "/" + file, {'_method': "DELETE"}).success(function () {
            $scope.photos.splice(index, 1);
        });

    }

  $scope.uploadVideo = function (files, errFiles) {
        $scope.videos = files;
        $scope.errFiles = errFiles;
        angular.forEach(files, function (file) {
            file.upload = Upload.upload({
                url: settings.uploadUrl,
                data: {file: file, resize: settings.resize, prefix: settings.prefix}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;

                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                    evt.loaded / evt.total));
            });
        });
    }
    $scope.removeVideo = function (index) {

        var file = $scope.videos[index].result.file;
        $http.get("/images/delete/" + file).success(function () {
            $scope.videos.splice(index, 1);
        });

    }



    $scope.uploadFile = function (files, errFiles) {
        $scope.files = files;
        $scope.errFiles = errFiles;
        angular.forEach(files, function (file) {
            file.upload = Upload.upload({
                url: settings.uploadUrl,
                data: {file: file, resize: settings.resize, prefix: settings.prefix}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;

                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                    evt.loaded / evt.total));
            });
        });
    }
    $scope.removeFile = function (index) {

        var file = $scope.files[index].result.file;
        $http.get("/images/delete/" + file).success(function () {
            $scope.files.splice(index, 1);
        });

    }

})
    .controller("CountryCitiesCtrl", function ($scope, $http) {
        $scope.citiesList = [];
        $scope.$watch("country", function (n, o) {
            $scope.getCountryCities();
        });

        $scope.getCountryCities = function () {
            $scope.citiesList = [];
            if ($scope.country) {
                $http.get("/" + window.locale + "/ajax/country/" + $scope.country + "/cities").success(function (resp) {
                    if (resp.success) {
                        $scope.citiesList = resp.data;
                    }
                });
            }
        }
    })

     // Start builder CTRL
      .controller("builderCtrl", function ($scope, $http) {
        $scope.countriesList = [];
        $scope.citiesList = [];
         $scope.getCountriesList = function () {
            $http.get("/builder/ajax/countriesList")
                .success(function (resp) {
                    if (resp.success && resp.data) {
                        $scope.countriesList = resp.data;

                    
                    } else {
                        if (resp.message && typeof toastr !== undefined)
                            toastr.error(resp.message);
                    }

                });
        };
        $scope.$watch("country", function (n, o) {
            $scope.getCountryCities();
        });

        $scope.getCountryCities = function () {
            $scope.citiesList = [];
            if ($scope.country) {
                $http.get("/builder/ajax/" + $scope.country + "/cities").success(function (resp) {
                    if (resp.success) {
                        $scope.citiesList = resp.data;
                    }
                });
            }
        }
    })

      // End builder CTRL
      
        .controller("institutesFilterCtrl", function ($scope, $http, $location, $httpParamSerializer, filterFilter) {

        $scope.wLocale = window.locale;
        $scope.currencyRate;
        $scope.countriesList = [];
        $scope.institutesCategories = [];
        $scope.loadingResults = false;
        $scope.citiesList = [];
        $scope.institutesList = [];
        $scope.queryParams = $location.search();
        $scope.filterData = {};
        $scope.filterData.rating = [];
        $scope.filterData.location = [];
        

 $scope.changeCurrencyRate = function(cRate) {
 $scope.currencyRate = cRate;

}


 

$scope.lRatings = [{stars: 5},{stars: 4},{stars: 3},{stars: 2},{stars: 1}];


 $scope.lRatingAdd = function(){
    $scope.filterData.lRating = [];
    angular.forEach($scope.lRatings, function(lRating){
      if (lRating.selected) $scope.filterData.lRating.push(lRating.stars);
    });
  }


  $scope.gRatings = [{stars: 5},{stars: 4},{stars: 3},{stars: 2},{stars: 1}];


 $scope.gRatingAdd = function(){
    $scope.filterData.gRating = [];
    angular.forEach($scope.gRatings, function(gRating){
      if (gRating.selected) $scope.filterData.gRating.push(gRating.stars);
    });
  }

  $scope.nearPlaces = [{pType: 1, name_ar: "مركز المدينة" ,name_en:"Town centre"},{pType: 2, name_ar: "منطقة تسوق" ,name_en:"Shopping area"},{pType: 3, name_ar: "منطقة احياء سكنية" ,name_en:"Residential area"},{pType: 4, name_ar: "منطقة مطاعم ومقاهي" ,name_en:"Restaurants and cafes area"},{pType: 5, name_ar: "بالقرب من الشواطئ" ,name_en:"Beach area"},{pType: 6, name_ar: "داخل المدينة" ,name_en:"Within the city"},{pType: 7, name_ar: "في الضواحي" ,name_en:"In the suburbs"}];


 $scope.nearPlaceAdd = function(){
    $scope.filterData.nearPlace = [];
    angular.forEach($scope.nearPlaces, function(nearPlace){
      if (nearPlace.selected) $scope.filterData.nearPlace.push(nearPlace.pType);
    });
  }




        if (!$scope.filterData.length) {
            $scope.filterData = $scope.queryParams;
        }

        
         

  
        $scope.getCountriesList = function () {
            $http.get("/" + window.locale + "/ajax/countriesList?hasInstitutes=true")
                .success(function (resp) {
                    if (resp.success && resp.data) {
                        $scope.countriesList = resp.data;

                        if ($scope.filterData.country) {
                            $scope.getCountryCities();
                        }
                    } else {
                        if (resp.message && typeof toastr !== undefined)
                            toastr.error(resp.message);
                    }

                });
        };
         $scope.getInstitutesCategories = function () {
            $http.get("/" + window.locale + "/ajax/institutes/categories")
                .success(function (resp) {
                    if (resp.success && resp.data) {
                        $scope.institutesCategories = resp.data;
                    } else {
                        if (resp.message && typeof toastr !== undefined)
                            toastr.error(resp.message);
                    }

                });
        };


        $scope.$watchCollection("filterData", function (newValues, oldValues) {

            angular.forEach(newValues, function (v, k) {
                if (k === "country" && newValues[k] !== oldValues[k]) {
                    // $scope.getCountryInstitutes();
                    $scope.getCountryCities();
                }

            });
            $scope.getSearchResults();
        });

        /*$scope.$watch("filterData.city", function (n, o) {
         $scope.getCityInstitutes();
         });*/
        $scope.getSearchResults = function () {
            // $scope.institutesList = [];
            $scope.loadingResults = true;
            var urlQueryString = $httpParamSerializer($scope.filterData);
            var url = "/" + window.locale + "/institutes/ajax/search";
            $location.search(urlQueryString).replace();
            $http.post(url, $scope.filterData).success(function (resp) {
                if (resp.success) {
                    $scope.institutesList = resp.data;
                }
            });
        }
        $scope.getCountryCities = function () {
            $scope.citiesList = [];
            $scope.filterData.city = "";
            if ($scope.filterData.country) {
                $scope.countriesList.map(function (e) {
                    if (e.code == $scope.filterData.country) {
                        $scope.citiesList = e.cities;
                        return;
                    }
                });

            }
        }
        $scope.getCountryInstitutes = function () {
            if ($scope.filterData.country) {

                $http.get("/" + window.locale + "/country/" + $scope.filterData.country + "/ajax/institutes")
                    .success(function (resp) {
                        if (resp.success && resp.data) {
                            $scope.institutesList = resp.data;
                           
                        } else {
                            if (resp.message && typeof toastr !== "undefined")
                                toastr.error(resp.message);
                        }

                    });
            }
        }
        $scope.getCityInstitutes = function () {
            if ($scope.filterData.city !== "") {

                $http.get("/" + window.locale + "/city/" + $scope.filterData.city + "/ajax/institutes")
                    .success(function (resp) {
                        if (resp.success && resp.data) {
                            $scope.institutesList = resp.data;
                        } else {
                            if (resp.message && typeof toastr !== undefined)
                                toastr.error(resp.message);
                        }

                    });
            }
        }





     
        $scope.submitFilters = function () {
            var formData = $.param($scope.filterData);

            $http.post("/" + window.locale + "/institutes/ajax/search", $scope.filterData).success(function (resp) {
                $scope.institutesList = resp.data;
            });

        }

       



            // $scope.getRatingsCount = function(country,type,stars){

            //      $http.get("/" + window.locale + "/institutes/ajax/withRating")
            //         .success(function (resp) {
            //             if (resp.success && resp.data) {
            //                 if(type == 'locale'){
            //                 return filterFilter( resp.data.data, {locale_rate:stars}).length;
            //             }else{

            //                 return filterFilter( resp.data.data, {international_rate:stars}).length;

            //             }
            
            //             } else {
            //                 if (resp.message && typeof toastr !== undefined)
            //                     toastr.error(resp.message);
            //             }

            //         });

            // }



    })
    .controller("coursesFilterCtrl", function ($scope, $http, $location, $httpParamSerializer) {
        $scope.currencyRate;
        $scope.countriesList = [];
        $scope.coursesCategories = [];
        $scope.loadingResults = false;
        $scope.citiesList = [];
        $scope.institutesList = [];
        $scope.queryParams = $location.search();
        $scope.filterData = {};
        $scope.filterData.rating = [];
        $scope.filterData.location = [];
        if (!$scope.filterData.length) {
            $scope.filterData = $scope.queryParams;
        }


$scope.changeCurrencyRate = function(cRate) {
 $scope.currencyRate = cRate;

}




        $scope.getCurrencyRate = function (currency) {

                $http.get("/" + window.locale + "/ajax/currencyRate/" + currency)
                .success(function (resp) {
                    if (resp.success && resp.data) {
                        $scope.currencyRate = resp.data;

                    } else {
                        if (resp.message && typeof toastr !== undefined)
                            toastr.error(resp.message);
                    }

                });

            
        };
        $scope.getCountriesList = function () {
            $http.get("/" + window.locale + "/ajax/countriesList?hasInstitutes=true")
                .success(function (resp) {
                    if (resp.success && resp.data) {
                        $scope.countriesList = resp.data;

                        if ($scope.filterData.country) {
                            $scope.getCountryCities();
                        }
                    } else {
                        if (resp.message && typeof toastr !== undefined)
                            toastr.error(resp.message);
                    }

                });
        };
         $scope.getCoursesCategories = function () {
            $http.get("/" + window.locale + "/ajax/courses/categories")
                .success(function (resp) {
                    if (resp.success && resp.data) {
                        $scope.coursesCategories = resp.data;
                    } else {
                        if (resp.message && typeof toastr !== undefined)
                            toastr.error(resp.message);
                    }

                });
        };
        $scope.$watchCollection("filterData", function (newValues, oldValues) {

            angular.forEach(newValues, function (v, k) {
                if (k === "country" && newValues[k] !== oldValues[k]) {
                    // $scope.getCountryInstitutes();
                    $scope.getCountryCities();
                }

            });
            $scope.getSearchResults();
        });

        /*$scope.$watch("filterData.city", function (n, o) {
         $scope.getCityInstitutes();
         });*/
        $scope.getSearchResults = function () {
            // $scope.coursesList = [];
            $scope.loadingResults = true;
            var urlQueryString = $httpParamSerializer($scope.filterData);
            var url = "/" + window.locale + "/courses/ajax/search";
            $location.search(urlQueryString).replace();
            $http.post(url, $scope.filterData).success(function (resp) {
                if (resp.success) {
                    $scope.coursesList = resp.data;
                }
            });
        }
        $scope.getCountryCities = function () {
            $scope.citiesList = [];
            $scope.filterData.city = "";
            if ($scope.filterData.country) {
                $scope.countriesList.map(function (e) {
                    if (e.code == $scope.filterData.country) {
                        $scope.citiesList = e.cities;
                        return;
                    }
                });

            }
        }

        $scope.getCountryInstitutes = function () {
            if ($scope.filterData.country) {

                $http.get("/" + window.locale + "/country/" + $scope.filterData.country + "/ajax/institutes")
                    .success(function (resp) {
                        if (resp.success && resp.data) {
                            $scope.institutesList = resp.data;
                        } else {
                            if (resp.message && typeof toastr !== "undefined")
                                toastr.error(resp.message);
                        }

                    });
            }
        }
        $scope.getCityInstitutes = function () {
            if ($scope.filterData.city !== "") {

                $http.get("/" + window.locale + "/city/" + $scope.filterData.city + "/ajax/institutes")
                    .success(function (resp) {
                        if (resp.success && resp.data) {
                            $scope.institutesList = resp.data;
                        } else {
                            if (resp.message && typeof toastr !== undefined)
                                toastr.error(resp.message);
                        }

                    });
            }
        }

        $scope.getInstituteCourses = function () {
            if ($scope.filterData.institute) {

                $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/institutes/" + $scope.filterData.institute + "/getCoursesList")
                    .success(function (resp) {
                        if (resp.success && resp.data) {
                            $scope.courses = resp.data;
                        } else {
                            if (resp.message && typeof toastr !== undefined)
                                toastr.error(resp.message);
                        }

                    });
            }
        }

        $scope.submitFilters = function () {
            var formData = $.param($scope.filterData);

            $http.post("/" + window.locale + "/courses/ajax/search", $scope.filterData).success(function (resp) {
                $scope.coursesList = resp.data;
            });

        }

    })

    .controller("courseDetailsCtrl", function ($scope, $http, $location, $httpParamSerializer) {
        $scope.currencyRate;
        $scope.courseId = 0;
        $scope.queryParams = $location.search();
        $scope.bookingData = {};
        $scope.housingTypePrice=0.0;
        // $scope.transportingTypePrice=0.0;
        $scope.course = {};
        $scope.subTotal = parseFloat(0.00);
        $scope.fees = [];
        $scope.errorMessages=[];

        $scope.bookingData = $scope.queryParams;
        $scope.changeCurrencyRate = function(cRate) {
          $scope.currencyRate = cRate;

             }


        $scope.$watchCollection("bookingData", function (newValues, oldValues) {
            var urlQueryString = $httpParamSerializer($scope.bookingData);
            $location.search(urlQueryString).replace();
            $scope.getCourseBookingDetails();//199.99
            $scope.calculateSubTotal();

        });
        $scope.$watchCollection("bookingData", function (newValues, oldValues) {
            if(newValues.housingType && newValues.housing=='y'){
                $http.get("/ajax/services/"+newValues.housingType+"/price").then(function(resp){
                    if(resp.data.success){
                        $scope.housingTypePrice=resp.data.data;
                        $scope.calculateSubTotal();
                    }
                });
            }

            //  if(newValues.transportingType && newValues.transporting=='y'){
            //     $http.get("/ajax/services/"+newValues.transportingType+"/price").then(function(resp){
            //         if(resp.data.success){
            //             $scope.transportingTypePrice=resp.data.data;
            //             $scope.calculateSubTotal();
            //         }
            //     });
            // }
            
        });

        

        $scope.calculateSubTotal = function () {
            $scope.subTotal = parseFloat(0.00);
            if ($scope.course) {
                var price = ($scope.course.offer_price || $scope.course.price);// * parseInt($scope.bookingData.weeks);
                
                if($scope.bookingData.housingType && $scope.bookingData.housing=='y'){
                    price+=(parseFloat($scope.housingTypePrice)* parseInt($scope.bookingData.hWeeks));
                }

                // if($scope.bookingData.transportingType && $scope.bookingData.transporting=='y'){
                //     price+=(parseFloat($scope.transportingTypePrice));
                // }

                if ($scope.course && $scope.course.institute && $scope.course.institute.services.length) {
                    $scope.fees = [];
                    angular.forEach($scope.course.institute.services, function (v, k) {

                       
                        if (v.fees) {

                            if (v.type == 'house' && $scope.queryParams.housing == 'y' && $scope.bookingData.housingType) {
                                price += parseFloat(v.fees);
                                $scope.fees.push(v);
                            } else if (v.type == 'insurance' && $scope.queryParams.insurance == 'y') {
                                price += parseFloat(v.fees);
                                $scope.fees.push(v);
                    
                            } else if (v.type == 'transport' && $scope.queryParams.transporting == 'y') {
                                price += parseFloat(v.fees);
                                $scope.fees.push(v);
                            } else if (!(v.type == 'house' || v.type == 'transporting' || v.type == 'insurance')) {
                                price += parseFloat(v.fees);
                                $scope.fees.push(v);
                            }

                        }
                    });
                };
                $scope.subTotal = parseFloat(price);
            }
        }

        $scope.getCourseBookingDetails = function () {
            var url = "/" + window.locale + "/courses/ajax/details";
            var data = $scope.bookingData;
            data.course_id = $scope.courseId;
            if ($scope.courseId) {
                $http.post(url, data).success(function (resp) {
                    if (resp.success) {
                        $scope.course = resp.data;
                        $scope.calculateSubTotal();
                    }

                });
            }

        }
        $scope.goCheckout = function () {
           
            var data=$scope.bookingData;
            

            // How to modifi your request.
       /*     data.services=[
                {housing:{
                    enabled:$scope.bookingData.housing=='y',
                    id:$scope.housingType,
                    price:$scope.housingTypePrice
                },
                    transporting:$scope.transportingType}];
                    data.total=$scope.subTotal;*/

                    // How to recieve request in php (laravel)
                    //$housing=$request->input('services.housing');
                    // if($housing['enabled']){  $total+=$housing['price']*housingWeeks}
                    
            $http.get("/ajax/booking/course/"+$scope.course.id,data).then(function(resp){
                if(resp.data.success && resp.data.redirect){
                    window.location.href=resp.data.redirect;
                }else{
                    if(resp.message){
                        $scope.errorMessages=resp.message;
                        // show message with toaster or any javascript notifier
                    }
                }
            });
        }
    })
    .controller("compareCtrl", function ($scope, $http) {

        //  $(".cd-cart-container .cd-cart-trigger").click(function () {
        //     $(this).parent(".cd-cart-container").toggleClass('cart-open')
        // });

         $scope.openCartBtn = function () {
             $(".cd-cart-container").toggleClass('cart-open');
        };

        "use strict";
        $scope.comparisonItems = {};
        $scope.comparisonItemsLink = {};
        $scope.cartOpen = false;
        var urlRemove = "/" + window.locale + "/actions/removeCompare";
        var urlAdd = "/" + window.locale + "/actions/addCompare";
        var urlList = "/" + window.locale + "/compare/ajax/institutes/list";

        $scope.getCompareInstitutes = function () {
            $http.get(urlList)
                .success(function (resp) {
                    if (resp.success && resp.data) {
                        $scope.comparisonItems = resp.data;
                        $scope.comparisonItemsLink = resp.ids;
                    } 

                });
        };

        $scope.addToCompare = function (id) {
            $http.post(urlAdd + "/" + id).then(function (resp) {
                $scope.getCompareInstitutes();
            });
        };
        $scope.removeFromCompare = function (id) {
            $http.post(urlRemove + "/" + id).then(function (resp) {
                $scope.getCompareInstitutes();

            });
        };
    })
    .directive('preventedClick', function () {
        return {
            restrict: 'AE',
            link: function (scope, elem, attrs) {
                elem.on('click', function (e) {
                    e.preventDefault();
                });
            }
        };
    })
    .directive("dismissNotification", function ($http, $location) {
        return {
            restrict: 'EA',
            link: function (scope, element, attrs) {
                var id = attrs.dismissNotification;
                var url = attrs.href;
                element.bind("click", function (event) {
                    event.preventDefault();
                    $http.get("/notifications/" + id + "/dismiss").success(function (resp) {
                        window.location = url;
                    });

                });

            }
        }
    })
    .directive("viewSliderModal", function ($http) {
        return {
            restrict: "EA",
            link: function (scope, element, attrs) {
                var url = attrs.viewSliderModal;
                element.bind("click", function () {

                })
            }
        }
    })
    .directive('iCheck', function ($timeout, $parse) {

        return {
            link: function (scope, element, $attrs) {
                return $timeout(function () {
                    var ngModelGetter, value;
                    ngModelGetter = $parse($attrs['ngModel']);
                    value = $parse($attrs['ngValue'])(scope);
                    return $(element).iCheck({
                        checkboxClass: 'icheckbox_square-grey',
                        radioClass: 'iradio_square-grey',
                        increaseArea: '20%'
                    }).on('ifChanged', function (event) {
                        if ($(element).attr('type') === 'checkbox' && $attrs['ngModel']) {
                            $scope.$apply(function () {
                                return ngModelGetter.assign($scope, value);
                            });
                        }
                        if ($(element).attr('type') === 'radio' && $attrs['ngModel']) {
                            return $scope.$apply(function () {
                                return ngModelGetter.assign($scope, value);
                            });
                        }
                    });
                });
            }
        };
    })
    .directive("modal", function ($http) {
        return {
            restrict: 'EA',
            link: function (scope, element, attrs) {

                var url = attrs.url;
                element.bind("click", function () {

                    /*$http.get(url).success(function (resp) {
                     if (resp) {
                     angular.element("#modalContent").html(resp);
                     angular.element(attrs.target).modal().show();
                     }
                     });*/
                })


            }
        }
    })
    .directive('addToCompare', function ($http) {
        return {
            restrict: 'EA',
            link: function (scope, element, attrs) {

            }
        };
    })
 
    .controller('favoriteCtrl', function ($scope, $http) {
        $scope.favoritesCourses = [];
        $scope.favoritesInstitutes = [];

            $scope.getFavoritesCourses = function () {
            $http.get("/favorite/ajax/courses/list")
                .success(function (resp) {
                    if (resp.success && resp.data) {
                        $scope.favoritesCourses = resp.data;
                    } 

                });
        };

        $scope.getFavoritesInstitutes = function () {
            $http.get("/favorite/ajax/institutes/list")
                .success(function (resp) {
                    if (resp.success && resp.data) {
                        $scope.favoritesInstitutes = resp.data;
                    } 

                });
        };

        $scope.favorite = function (module, id) {
            

            $http({
                method: "post",
                url: "/favorite/ajax/"+ module +"/" + id + "/add",

            }).success(function (response) {
                 if (response.success && response.message && response.alert_type) {
                $scope.favStatus = response.success;
                $scope.favMsg = response.message;
                $scope.favAlert = response.alert_type;
                
                $scope.getFavoritesInstitutes();
                $scope.getFavoritesCourses();

            }

            });
        };

        $scope.unfavorite = function (module, id) {
            $http({
                method: "post",
                url: "/favorite/ajax/"+ module +"/" + id + "/remove",

            }).success(function (response) {
                 if (response.success && response.message && response.alert_type) {
                $scope.favStatus = response.success;
                $scope.favMsg = response.message;
                $scope.favAlert = response.alert_type;
             
                $scope.getFavoritesInstitutes();
                $scope.getFavoritesCourses();
            }

            });
        };


    })
    .controller('paypalMthodCtrl', function ($scope) {
        // Add the props needed to your $scope

        $scope.client = {
            sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
        };

        $scope.payment = function () {
        };

        $scope.onAuthorize = function (data) {
        };
    });
/**.then(function mySuccess(resp) {
        if (resp.success) {

        }
        $scope.myWelcome = response.data;
    }, function myError(response) {
        $scope.myWelcome = response.statusText;
    });
 **/
