/**
 * Created by Mohammed on 7/23/16.
 */
var ctrl = angular.module('controllers', []);
ctrl.controller('backendUploaderCtrl', function ($scope, $http, Upload, $timeout, $attrs) {

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
    .controller("countryCitiesCtrl", function ($scope, $http) {

        $scope.citiesList = [];
        $scope.$watch('country', function (n, o) {
            $scope.getCities(n);
        });

        $scope.getCities = function (country_id) {
            if (!country_id)
                country_id = $scope.country;
            if (country_id) {

                $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/" + country_id + "/getCitiesList")
                    .success(function (resp) {
                        if (resp.success) {
                            $scope.citiesList = resp.data;
                        } else {
                            if (resp.message && toastr !== undefined)
                                toastr.error(resp.message);
                        }
                    });
            } else {
                $scope.citiesList = [];
            }
        }


    })
    .controller("tabsSectionsCrl", function ($scope) {
        $scope.tabsItems = [];
        $scope.addTab = function () {
            $scope.tabsItems.push({});
        }
        $scope.removeTab = function (index) {
            if (confirm(window.jsTrans.alert_delete_confirmation)) {
                $scope.tabsItems.splice(index - 1);
            }
        }
    })
    .controller("createUpdatePackagesCtrl",function ($scope) {
        $scope.submitForm=function () {
            if($scope.form.$valid){
                angular.element("#packageFormData").submit();
            }

        }
    })
    .controller("packageHotelsCtrl", function ($scope, $rootScope, $http) {
        //$rootScope.country = null;
        $scope.citiesList = [];
        $scope.items = [];
        $scope.hotelsLoading=false;
        $scope.init = function (country, data) {
            if (country) {
                $rootScope.country = country.toString();
            }


            if (data) {
                $scope.hotelsLoading=true;
                angular.forEach(data, function (v, k) {
                    $scope.hotelsLoading=true;
                    // get citiesList
                    $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/" + country + "/getCitiesList")
                        .success(function (resp) {
                            if (resp.success) {

                                $scope.citiesList = resp.data;

                            } else {
                                if (resp.message && toastr !== undefined)
                                    toastr.error(resp.message);
                            }
                        });

                    var city_id = v.pivot.city_id.toString();
                    var hsList = [];
                    // get Hotels list
                    $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/cities/" + city_id + "/getHotelsList").success(function (resp) {
                        if (resp.success) {
                            hsList = resp.data;
                            var hotel_id = v.hotel_id.toString();

                            var roomsList = [];
                            // get rooms list
                            $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/hotels/" + hotel_id + "/getRoomsList").success(function (resp) {
                                if (resp.success) {
                                    roomsList = resp.data;
                                    var room = v.id.toString();
                                    var days = v.pivot.days;
                                    var item = {
                                        country: country,
                                        city: city_id,
                                        hotelsList: hsList,
                                        roomsList: roomsList,
                                        hotel: hotel_id,
                                        room: room,
                                        days: days
                                    };

                                    $scope.items.push(item);
                                }
                            });


                        }
                    });


                });

                $scope.hotelsLoading=false;
            }

        }

        $scope.$watch('country', function (n, o) {
            $scope.getCities(n);
        });

        $scope.getCities = function (country_id) {
            if (!country_id)
                country_id = $rootScope.country;
            if (!isNaN(country_id) && $rootScope.country != null && $rootScope.country) {
                $scope.hotelsLoading=true;
                $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/" + country_id + "/getCitiesList")
                    .success(function (resp) {
                        if (resp.success) {
                            $scope.citiesList = resp.data;
                        } else {
                            if (resp.message && toastr !== undefined)
                                toastr.error(resp.message);
                        }
                    });
                $scope.hotelsLoading=false;
            } else {
                $scope.citiesList = [];
            }
        }

        $scope.getCityHotels = function (index) {

            if (!isNaN(index)) {
                var city_id = 0;
                if ($scope.items.length && $scope.items[index].city != null) {
                    city_id = $scope.items[index].city;
                    $scope.hotelsLoading=true;
                    $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/cities/" + city_id + "/getHotelsList")
                        .success(function (resp) {
                            if (resp.success) {
                                $scope.items[index].hotelsList = resp.data;

                            } else {
                                $scope.showMessage(resp.message);
                            }
                        });
                    $scope.hotelsLoading=false;
                } else {
                    $scope.showMessage("You didn't select city ")
                }

            }
        };

        $scope.getHotelRooms = function (index) {
            if (!isNaN(index)) {
                var hotel_id = 0;
                if ($scope.items.length && $scope.items[index].city != '' && $scope.items[index].hotel != '') {
                    hotel_id = $scope.items[index].hotel;
                    $scope.hotelsLoading=true;
                    $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/hotels/" + hotel_id + "/getRoomsList")
                        .success(function (resp) {
                            if (resp.success) {
                                $scope.items[index].roomsList = resp.data;

                            } else {
                                $scope.showMessage(resp.message);
                            }
                            $scope.hotelsLoading=false;
                        });
                }

            }
        };
        $scope.showMessage = function (message, type) {
            if (toastr !== undefined) {
                switch (type) {
                    case 'info':
                        toastr.info(message);
                        break;

                    case 'warning':
                        toastr.warning(message);
                        break;

                    case 'success':
                        toastr.success(message);
                        break;

                    default:
                        toastr.error(message);
                }
            }
            else {
                alert(message);
            }
        }
        $scope.addHotel = function () {
            $scope.hotelsLoading=true;
            var hotelItem = {
                country: $rootScope.country,
                city: null,
                hotelsList: [],
                roomsList: [],
                hotel: null,
                room: null,
                days: 1
            };

            if (!$rootScope.country || $rootScope.country == null) {
                if (toastr !== undefined) {
                    toastr.error("You didn't select country ");
                } else {
                    alert("you didn't select country");
                }
            } else {

                $scope.items.push(hotelItem);
            }
            $scope.hotelsLoading=false;
        }

        $scope.removeHotel = function (index) {
            $scope.items.splice(index, 1);
        }
    })
    .controller("packageTransportsCtrl", function ($scope, $rootScope, $http) {
        $scope.citiesList = [];
        $scope.items = [];
        $scope.transportsLoading=false;
        $scope.init = function (country, data) {
            if (country)
                $rootScope.country = country.toString();

            if (data) {
                $scope.transportsLoading=true;
                angular.forEach(data, function (v, k) {
                    // get citiesList
                    $scope.transportsLoading=true;
                    $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/" + country + "/getCitiesList")
                        .success(function (resp) {
                            if (resp.success) {

                                $scope.citiesList = resp.data;

                            } else {
                                if (resp.message && toastr !== undefined)
                                    toastr.error(resp.message);
                            }
                        });

                    var city_id = v.pivot.city_id.toString();
                    var typesList = [];
                    var type = v.type;
                    var transport = v.pivot.transport_id.toString();
                    var city_query = "?city=" + city_id;
                    $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/transports/getTransportTypes").success(function (resp) {
                        if (resp.success) {
                            typesList = resp.data;
                            var transportsList = [];
                            $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/transports/" + type + "/getTypeTransports" + city_query).success(function (resp) {
                                if (resp.success) {

                                    transportsList = resp.data;
                                    var item = {
                                        country: $rootScope.country,
                                        city: city_id,
                                        typesList: typesList,
                                        transportsList: transportsList,
                                        type: type,
                                        transport: transport
                                    };
                                    $scope.items.push(item);
                                } else {
                                    $rootScope.showMessage(resp.message);
                                }
                            });
                        } else {
                            $rootScope.showMessage(resp.message);
                        }
                    });


                });
                $scope.transportsLoading=false;
            }
        }
        $rootScope.$watch('country', function (n, o) {
            $scope.getCities(n);
        });

        $scope.getCities = function (country_id) {
            if (!country_id)
                country_id = $rootScope.country;
            if (!isNaN(country_id) && $rootScope.country != null && $rootScope.country) {
                $scope.transportsLoading=true;
                $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/" + country_id + "/getCitiesList")
                    .success(function (resp) {
                        if (resp.success) {
                            $scope.citiesList = resp.data;
                        } else {
                            if (resp.message && toastr !== undefined)
                                toastr.error(resp.message);
                        }
                        $scope.transportsLoading=false;
                    });
            } else {
                $scope.citiesList = [];
            }
        }


        $scope.getCityTransportTypes = function (index) {
            if ($scope.items[index].city && $scope.items[index].city != '') {
                $scope.transportsLoading=true;
                $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/transports/getTransportTypes").success(function (resp) {
                    if (resp.success) {
                        $scope.items[index].typesList = resp.data;

                        if ($scope.items[index].type) {
                            $scope.items[index].type = "car";
                        }
                    } else {
                        $rootScope.showMessage(resp.message);
                    }
                    $scope.transportsLoading=false;
                });

            }
        }

        $scope.getTypeTransports = function (index) {
            if ($scope.items[index].city && $scope.items[index].city != '' && $scope.items[index].type != '') {
                var type = $scope.items[index].type;
                $scope.transportsLoading=true;
                var city_query = "?city=" + $scope.items[index].city;
                $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/transports/" + type + "/getTypeTransports" + city_query).success(function (resp) {
                    if (resp.success) {
                        $scope.items[index].transportsList = resp.data;
                    } else {
                        $rootScope.showMessage(resp.message);
                        $scope.items[index].transportsList = [];
                    }
                    $scope.transportsLoading=false;
                });

            }
        }

        $scope.addTransport = function () {
            $scope.transportsLoading=true;
            var transportItem = {
                country: $rootScope.country,
                city: null,
                typesList: [],
                transportsList: [],
                type: null,
                transport: null
            };

            if (!$rootScope.country || $rootScope.country == null) {
                if (toastr !== undefined) {
                    toastr.error("You didn't select country ");
                } else {
                    alert("you didn't select country");
                }
                $scope.transportsLoading=false;
            } else {

                $scope.items.push(transportItem);
                $scope.transportsLoading=false;
            }
        }

        $scope.removeTransport = function (index) {
            $scope.items.splice(index, 1);
        }
    })
    .controller("packageFlightsCtrl", function ($scope, $rootScope, $http) {
        $scope.items = [];
        $scope.flightsLoading=false;
        $scope.init = function (data) {
            if (data) {
                $scope.flightsLoading=true;
                angular.forEach(data, function (v, k) {
                    var fromCountry = v.pivot.from_country_id.toString();
                    var fromCity = v.pivot.from_city_id.toString();
                    var toCountry = v.pivot.to_country_id.toString();
                    var toCity = v.pivot.to_city_id.toString();
                    var fromCitiesList = [];
                    var toCitiesList = [];
                    var flightsList = [];
                    $scope.flightsLoading=true;
                    //get from country cities
                    $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/" + fromCountry + "/getCitiesList")
                        .success(function (resp) {
                            if (resp.success) {
                                fromCitiesList = resp.data;
                                $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/" + toCountry + "/getCitiesList")
                                    .success(function (resp) {
                                        if (resp.success) {
                                            toCitiesList = resp.data;

                                            $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/transports/flight/getTypeTransports").success(function (resp) {
                                                if (resp.success) {
                                                    flightsList = resp.data;
                                                    var flight = v.id.toString();

                                                    var item = {
                                                        fromCountry: fromCountry,
                                                        fromCity: fromCity,
                                                        toCountry: toCountry,
                                                        toCity: toCity,
                                                        fromCitiesList: fromCitiesList,
                                                        toCitiesList: toCitiesList,
                                                        flightsList: flightsList,
                                                        flight: flight
                                                    };
                                                    $scope.items.push(item);
                                                } else {
                                                    $rootScope.showMessage(resp.message);
                                                }
                                            });

                                        } else {
                                            if (resp.message && toastr !== undefined)
                                                toastr.error(resp.message);
                                        }
                                    });

                            } else {
                                if (resp.message && toastr !== undefined)
                                    toastr.error(resp.message);
                            }
                        });


                });
                $scope.flightsLoading=false;

            }
        };


        $scope.getFromCountryCities = function (index) {
            $scope.items[index].fromCitiesList = [];
            $scope.flightsLoading=true;
            if ($scope.items[index].fromCountry && $scope.items[index].fromCountry != '') {
                var country_id = $scope.items[index].fromCountry;
                $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/" + country_id + "/getCitiesList")
                    .success(function (resp) {
                        if (resp.success) {
                            $scope.items[index].fromCitiesList = resp.data;
                        } else {
                            if (resp.message && typeof toastr !== undefined)
                                toastr.error(resp.message);
                        }
                        $scope.flightsLoading=false;
                    });

            }

        }
        $scope.getToCountryCities = function (index) {
            $scope.items[index].toCitiesList = [];
            $scope.flightsLoading=true;

            if ($scope.items[index].toCountry && $scope.items[index].toCountry != '') {
                var country_id = $scope.items[index].toCountry;
                $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/" + country_id + "/getCitiesList")
                    .success(function (resp) {
                        if (resp.success) {
                            $scope.items[index].toCitiesList = resp.data;
                        } else {
                            if (resp.message && typeof toastr !== undefined)
                                toastr.error(resp.message);
                        }
                        $scope.flightsLoading=false;
                    });

            }

        }

        $scope.getFlights = function (index) {
            $scope.flightsLoading=true;
            if ($scope.items[index].fromCity && $scope.items[index].toCity) {
                $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/transports/flight/getTypeTransports").success(function (resp) {
                    if (resp.success) {
                        $scope.items[index].flightsList = resp.data;
                    } else {
                        $rootScope.showMessage(resp.message);
                    }
                    $scope.flightsLoading=false;
                });
            }

        }
        $scope.addFlight = function () {
            var item = {
                fromCountry: null,
                fromCity: null,
                toCountry: null,
                toCity: null,
                fromCitiesList: [],
                toCitiesList: [],
                flightsList: [],
                flight: null
            };
            $scope.items.push(item);
        }

        $scope.removeFlight = function (index) {
            $scope.items.splice(index, 1);
        }
    })
    .controller("SaveModalFormDataController", function ($scope, $http, $attrs) {

        var form = "form#" + $attrs.form;
        var url = angular.element(form).attr("action");
        var formData = angular.element(form).serialize();
        angular.element(form).submit(function (e) {
            e.preventDefault();
        });
        // $http.post(url,$scope.formData)
    })
    .controller("bookingHotelsAndPackagesCtrl", function ($scope, $http) {
        $scope.country = 0;
        $scope.hotels = [];
        $scope.rooms = [];
        $scope.package_types = [];
        $scope.packages = [];
        if ($scope.country) {
            $scope.getCountryHotels();

            $scope.getCountryPackages();
        }

        $scope.$watch("country", function (n, o) {

            $scope.getCountryHotels();
            $scope.getCountryPackageTypes();
            $scope.getCountryPackages();
        });

        $scope.$watch("hotel", function (n, o) {
            $scope.getHotelRooms();
        });


        $scope.getCountryHotels = function () {
            if ($scope.country) {

                $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/ajax/" + $scope.country + "/hotels")
                    .success(function (resp) {
                        if (resp.success && resp.data) {
                            $scope.hotels = resp.data;
                        } else {
                            if (resp.message && toastr !== undefined)
                                toastr.error(resp.message);
                        }

                    });
            }
        }
        $scope.getHotelRooms = function () {
            if ($scope.hotel) {

                $http.get("/" + window.locale + "/" + window.backend_uri + "/ajax/hotels/" + $scope.hotel + "/getRoomsList")
                    .success(function (resp) {
                        if (resp.success && resp.data) {
                            $scope.rooms = resp.data;
                        } else {
                            if (resp.message && toastr !== undefined)
                                toastr.error(resp.message);
                        }

                    });
            }
        }
        $scope.getCountryPackageTypes = function () {
            if ($scope.country) {

                $http.get("/" + window.locale + "/" + window.backend_uri + "/countries/ajax/" + $scope.country + "/packages_types")
                    .success(function (resp) {
                        if (resp.success && resp.data) {
                            $scope.package_types = resp.data;
                        } else {
                            if (resp.message && toastr !== undefined)
                                toastr.error(resp.message);
                        }

                    });
            }
        }
        $scope.getCountryPackages = function () {
            if ($scope.package_type) {

                $http.get("/" + window.locale + "/" + window.backend_uri + "/packages_types/ajax/" + $scope.package_type + "/packages")
                    .success(function (resp) {
                        if (resp.success && resp.data) {
                            $scope.packages = resp.data;
                        } else {
                            if (resp.message && toastr !== undefined)
                                toastr.error(resp.message);
                        }

                    });
            }
        }


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
    .directive("modal", function ($http) {
        return {
            restrict: 'EA',
            link: function (scope, element, attrs) {

                var form = angular.element(attrs.target + " form");
                var url = attrs.url;
                form.attr("action", url);
                element.bind("click", function () {
                    $http.get(url).success(function (resp) {
                        if (resp) {
                            angular.element("#modalContent").html(resp);
                            angular.element(attrs.target).modal().show();

                        }
                    });
                })


            }
        }
    });