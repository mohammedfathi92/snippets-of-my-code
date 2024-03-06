/**
 * Created by Mohammed on 4/7/16.
 */
/*
 var csrfToken = laraApp.csrfToken;

 setInterval(refreshToken, (1000 * 60) * 30); // 30 min

 function refreshToken() {
 $.get(laraApp.appUrl + '/check_csrf').done(function (data) {

 if (csrfToken != data) {
 window.location.href = laraApp.appUrl + '/admin/login';
 }
 });
 }

 */

var app = angular.module('samsungBackendApp', ['ngAnimate', 'ngSanitize', 'ui.bootstrap', 'ui-iconpicker', 'colorpicker.module', 'ngFileUpload']);
app.filter('to_trusted', ['$sce', function ($sce) {
    return function (text) {
        return $sce.trustAsHtml(text);
    };
}]);
app.config(function ($interpolateProvider) {

    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
})
    .controller("slugController", ['$scope', function ($scope) {
        $scope.title = "";
        //this.slug=$scope.title;
        $scope.slug = $scope.title;


    }])
    .controller("filesController", ['$scope', '$http', function ($scope, $http) {

        $scope.delete = function (f, $event) {

            if (confirm("Are you sur you want to delete file? ")) {

                /*send delete request to server*/
                $http({
                    method: "POST",
                    url: "/files/delete",
                    data: {
                        "file": f

                    },
                    headers: {
                        "Content-Type": "application/json"
                    }
                });
                /*Delete Parent Element of clicked Element*/
                var el = $event.target;
                angular.element(el).parent().parent().remove();

            }

        }

    }
    ])
    .controller("colorpickerCtrl", ['$scope', function ($scope) {
        $scope.inputs = [];
        if (typeof laraApp.productColors != 'undefined') {
            $scope.inputs = laraApp.productColors;
        }
        $scope.add = function () {
            $scope.inputs.push({
                color: "#000000",
                id: "colorId_" + Math.random() + Math.random(),
                script: function (id) {
                    $("#" + id).colorpicker()
                }

            });

        }
        $scope.removeColor = function (index) {
            if (confirm("Are you sur you want to delete this color? ")) {

                $scope.inputs.splice(index, 1);
            }
        }
    }])
    .controller("categoryPropertiesCtrl", ['$scope', '$rootScope', '$http', function ($scope, $rootScope, $http) {
        $scope.properties = [];
        $scope.$watchCollection('selectedCategory', function (v) {
            if (v && typeof v != 'undefined') {
                var qs = '';
                if ($scope.selectedProduct) {
                    qs = "?product=" + $scope.selectedProduct
                }
                $http.get(laraApp.appUrl + "/admin/categories/ajax/" + v + "/product_properties" + qs).success(function (resp) {
                    if (typeof resp.success != 'undefined' && resp.success) {

                        if (resp.data.length) {

                            for ($i = 0; $i < resp.data.length; $i++) {
                                if (resp.data[$i].value != null) {
                                    var v = JSON.parse(resp.data[$i].value);
                                    resp.data[$i].value = v;
                                    resp.data[$i].value_ar = v['ar']
                                    resp.data[$i].value_en = v['en']
                                } else {
                                    var v = {'ar': '', 'en': ''};
                                    resp.data[$i].value = v;
                                    resp.data[$i].value_ar = v['ar'];
                                    resp.data[$i].value_en = v['en'];
                                }
                            }

                        }
                        $scope.properties = resp.data;


                    }

                });
            }
        });
        // for editing case.
        if (typeof laraApp.catProperties != 'undefined') {
            $scope.properties = laraApp.catProperties;

        }
        $scope.addProperty = function () {
            $scope.properties.push({
                id: 'property_' + Math.random(), // element id
                property_icon: 'fa fa-lg fa-android',
                property_name: "",
                property_icon_size: 30,
                property_id: 0,//'property_' + Math.random(),
                property_sort: 1
            });

        }

        $scope.removeProperty = function (index, id) {


            if (confirm("Are you sure .. you want to delete this item ?")) {
                if (id) {
                    $http.post(laraApp.appUrl + '/admin/categories/ajax/removeProperty/' + id).success(function (resp) {
                        if (typeof resp.success != 'undefined' && resp.success) {
                            $scope.properties.splice(index, 1);
                        }
                    });
                } else {
                    $scope.properties.splice(index, 1);
                }
            }

        }
    }])
    .controller('productsFiltersCtrl', function ($rootScope, $scope, $http) {
        $scope.filters = [];
        var qs = '';
        $scope.selectedProduct = 0;
        $scope.$watchCollection('selectedCategory', function (v) {

            if (v && typeof v != 'undefined') {
                qs = "?category=" + v;
                if ($scope.selectedProduct) {
                    qs += "&product=" + $scope.selectedProduct;
                }
                $http.get(laraApp.appUrl + "/admin/products/ajax/filters" + qs).success(function (resp) {
                    if (typeof resp.success != 'undefined' && resp.success) {
                        $scope.filters = resp.data;

                    }

                });
            }
        });
    })
    .controller("productsCtrl", ['$scope', '$http', function ($scope, $http) {
        $scope.product = [];
        $scope.product.gallery = [];
        $scope.product.uploads = [];
        // for editing case.
        if (typeof laraApp.productGallery != 'undefined') {
            $scope.product.gallery = laraApp.productGallery;
        }
        $scope.addGalleryUploader = function () {
            $scope.product.uploads.push({
                id: "gUpload_" + Math.random()
            });
        }
        $scope.removeGalleryPhoto = function (id, index) {
            if (confirm("Are you sure .. you want to delete this item ?")) {
                $http.post(laraApp.appUrl + "/admin/products/removeGalleryPhoto/" + id).success(function (resp) {
                    if (resp.success) {
                        $scope.product.gallery.splice(index, 1);
                    }
                });

            }
        }
        $scope.removeGalleryUploader = function (i) {
            if (confirm("Are you sure .. you want to delete this item ?")) {
                $scope.product.uploads.splice(i, 1);
            }
        }
    }])
    .controller('filtersCtrl', function ($scope, $http, $uibModal, $log) {

        $scope.filters = [];
        $scope.animationsEnabled = true;

        $scope.getFilters = function (cat) {

            $http.get(laraApp.appUrl + "/admin/categories/ajax/" + cat + "/filters").success(function (resp) {
                if (resp.success) {
                    $scope.filters = resp.data;
                }
            });
        }

        $scope.add = function (category, parent) {

            parent = parent ? parent : 0;
            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'modalAddFilter.html',
                controller: 'addFilterCtrl',
                size: 'lg',
                resolve: {
                    params: function () {
                        return {
                            category: category,
                            parentFilter: parent
                        };
                    }
                }
            });

            modalInstance.result.then(function (scopeData) {
                $scope.filters = scopeData;


            }, function () {

            });
        };
        $scope.edit = function (category, id) {

            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'modalEditFilter.html',
                controller: 'editFilterCtrl',
                size: 'lg',
                resolve: {
                    params: function () {

                        return {
                            category: category,
                            id: id,
                        };

                    }
                }
            });

            modalInstance.result.then(function (scopeData) {
                $scope.filters = scopeData;
            }, function () {

            });
        }

        $scope.delete = function (category, id) {
            parent = parent ? parent : 0;
            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'modalDeleteFilter.html',
                controller: 'deleteFilterCtrl',
                size: 'sm',
                resolve: {
                    params: function () {

                        return {
                            category: category,
                            id: id,
                        };

                    }
                }
            });

            modalInstance.result.then(function (scopeData) {
                $scope.filters = scopeData;
            }, function () {

            });
        }

    })
    .controller('addFilterCtrl', function ($scope, $http, $uibModalInstance, params) {
        $scope.ok = function () {
            if (typeof $scope.filterNameAr != 'undefined' && typeof $scope.filterNameEn != 'undefined' && $scope.filterNameAr && $scope.filterNameEn && params.category) {
                var data = {
                    category: params.category,
                    parent: params.parentFilter,
                    name_ar: $scope.filterNameAr,
                    name_en: $scope.filterNameEn
                }

            }

            $http.post(laraApp.appUrl + "/admin/categories/ajax/" + params.category + "/filters/add", data).success(function (resp) {

                if (resp.success) {

                    $uibModalInstance.close(resp.data);
                }
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    })
    .controller('editFilterCtrl', function ($scope, $http, $uibModalInstance, params) {
        $http.get(laraApp.appUrl + "/admin/categories/ajax/" + params.category + "/filters/edit/" + params.id).success(function (resp) {

            if (resp.success) {

                $scope.filterName = resp.data.name;
                $scope.filterNameAr = resp.data.name_ar;
                $scope.filterNameEn = resp.data.name_en;
            }
        });


        $scope.ok = function () {
            if (typeof $scope.filterName != 'undefined' && $scope.filterName && params.category) {
                var data = {
                    category: params.category,
                    id: params.parentFilter,
                    name_ar: $scope.filterNameAr,
                    name_en: $scope.filterNameEn
                }

            }

            $http.post(laraApp.appUrl + "/admin/categories/ajax/" + params.category + "/filters/edit/" + params.id, data).success(function (resp) {

                if (resp.success) {

                    $uibModalInstance.close(resp.data);
                }
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    })
    .controller('deleteFilterCtrl', function ($scope, $http, $uibModalInstance, params) {

        $scope.ok = function () {

            $http.post(laraApp.appUrl + "/admin/categories/ajax/" + params.category + "/filters/delete/" + params.id).success(function (resp) {

                if (resp.success) {

                    $uibModalInstance.close(resp.data);
                }
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    })
    .controller('propertiesCtrl', function ($scope, $http, $uibModal, $log) {

        $scope.properties = [];
        $scope.animationsEnabled = true;

        $scope.getProperties = function (cat) {

            $http.get(laraApp.appUrl + "/admin/categories/ajax/" + cat + "/properties").success(function (resp) {
                if (resp.success) {
                    $scope.properties = resp.data;
                }
            });
        }

        $scope.add = function (category) {

            parent = parent ? parent : 0;
            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'modalAddProperty.html',
                controller: 'addPropertyCtrl',
                size: 'lg',
                resolve: {
                    params: function () {
                        return {
                            category: category
                        };
                    }
                }
            });

            modalInstance.result.then(function (scopeData) {
                $scope.properties = scopeData;


            }, function () {

            });
        };
        $scope.edit = function (category, id) {

            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'modalEditProperty.html',
                controller: 'editPropertyCtrl',
                size: 'lg',
                resolve: {
                    params: function () {
                        return {
                            category: category,
                            id: id,
                        };

                    }
                }
            });

            modalInstance.result.then(function (scopeData) {
                $scope.properties = scopeData;
            }, function () {

            });
        }

        $scope.delete = function (category, id) {
            parent = parent ? parent : 0;
            var modalInstance = $uibModal.open({
                animation: $scope.animationsEnabled,
                templateUrl: 'modalDeleteProperty.html',
                controller: 'deletePropertyCtrl',
                size: 'sm',
                resolve: {
                    params: function () {

                        return {
                            category: category,
                            id: id,
                        };

                    }
                }
            });

            modalInstance.result.then(function (scopeData) {
                $scope.properties = scopeData;
            }, function () {

            });
        }

    })
    .controller('addPropertyCtrl', function ($scope, $http, $uibModalInstance, params) {
        $scope.ok = function () {
            if (typeof $scope.propertyNameAr != 'undefined' && typeof $scope.propertyNameEn != 'undefined' && $scope.propertyNameAr && $scope.propertyNameEn && params.category) {
                var data = {
                    category: params.category,
                    name_ar: $scope.propertyNameAr,
                    name_en: $scope.propertyNameEn,
                    icon: $scope.propertyIcon,
                    icon_size: $scope.propertyIconSize,
                    sort: $scope.propertySort
                }
                $http.post(laraApp.appUrl + "/admin/categories/ajax/" + params.category + "/properties/add", data).success(function (resp) {

                    if (resp.success) {

                        $uibModalInstance.close(resp.data);
                    }
                });

            }


        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    })
    .controller('editPropertyCtrl', function ($scope, $http, $uibModalInstance, params) {
        $http.get(laraApp.appUrl + "/admin/categories/ajax/" + params.category + "/properties/edit/" + params.id).success(function (resp) {

            if (resp.success) {
                $scope.propertyId = resp.data.id;
                $scope.propertyNameAr = resp.data.translations[0].name;
                $scope.propertyNameEn = resp.data.translations[1].name;
                $scope.propertyIcon = resp.data.icon;
                $scope.propertyIconSize = parseInt(resp.data.icon_size);
                $scope.propertySort = parseInt(resp.data.sort);
            }
        });


        $scope.ok = function () {
            if (typeof $scope.propertyNameAr != 'undefined' && $scope.propertyNameEn && params.category) {

                var data = {
                    category: params.category,
                    name_ar: $scope.propertyNameAr,
                    name_en: $scope.propertyNameEn,
                    icon: $scope.propertyIcon,
                    icon_size: $scope.propertyIconSize,
                    sort: $scope.propertySort
                }

            }

            $http.post(laraApp.appUrl + "/admin/categories/ajax/" + params.category + "/properties/edit/" + params.id, data).success(function (resp) {

                if (resp.success) {

                    $uibModalInstance.close(resp.data);
                }
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    })
    .controller('deletePropertyCtrl', function ($scope, $http, $uibModalInstance, params) {
        $scope.ok = function () {

            var data = {
                category: params.category,
                id: params.id,
            }


            $http.post(laraApp.appUrl + "/admin/categories/ajax/" + params.category + "/properties/delete/" + params.id, data).success(
                function (resp) {

                    if (resp.success) {
                        $uibModalInstance.close(resp.data);
                    }
                });
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    })
    .controller('productsUploaderCtrl', function ($scope, Upload, $timeout) {
        $scope.photos = [];
        $scope.gallery = [];
        $scope.slidePhoto = [];
        $scope.slideBackground = [];

        $scope.uploadPhoto = function (files, errFiles) {
            $scope.photos = files;
            $scope.errFiles = errFiles;
            angular.forEach(files, function (file) {
                file.upload = Upload.upload({
                    url: laraApp.appUrl + "/admin/products/upload",
                    data: {file: file}
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
        $scope.uploadGallery = function (files, errFiles) {
            $scope.gallery = files;
            $scope.errFiles = errFiles;
            angular.forEach(files, function (file) {
                file.upload = Upload.upload({
                    url: laraApp.appUrl + "/admin/products/upload",
                    data: {file: file}
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
        $scope.uploadSlidePhoto = function (files, errFiles) {
            $scope.slidePhoto = files;
            $scope.errFiles = errFiles;
            angular.forEach(files, function (file) {
                file.upload = Upload.upload({
                    url: laraApp.appUrl + "/admin/products/upload",
                    data: {file: file}
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
        $scope.uploadSlideBackground = function (files, errFiles) {
            $scope.slideBackground = files;
            $scope.errFiles = errFiles;
            angular.forEach(files, function (file) {
                file.upload = Upload.upload({
                    url: laraApp.appUrl + "/admin/products/upload",
                    data: {file: file}
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
        $scope.removePhoto = function (index) {
            $scope.photos.splice(index, 1);
        }
        $scope.removeGallery = function (index) {
            $scope.gallery.splice(index, 1);
        }
        $scope.removeSlidePhoto = function (index) {
            $scope.slidePhoto.splice(index, 1);
        }
        $scope.removeSlideBackground = function (index) {
            $scope.slideBackground.splice(index, 1);
        }
    })
    .controller('updateAvatarCtrl', function ($scope, Upload, $timeout) {
        $scope.photos = [];


        $scope.uploadPhoto = function (files, errFiles) {
            $scope.photos = files;
            $scope.errFiles = errFiles;
            angular.forEach(files, function (file) {
                file.upload = Upload.upload({
                    url: laraApp.appUrl + "/admin/account/upload",
                    data: {file: file}
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
        $scope.removePhoto = function (index) {
            $scope.photos.splice(index, 1);
        }
    });