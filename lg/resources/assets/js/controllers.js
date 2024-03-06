/**
 * Created by Mohammed on 7/23/16.
 */
var ctrl = angular.module('controllers', []);
ctrl.controller('manageUploaderCtrl', function ($scope, $http, Upload, $timeout, $attrs) {
    $scope.photos = [];
    var upload_url = $attrs.uploadUrl;
    $scope.uploadPhoto = function (files, errFiles) {
        $scope.photos = files;
        $scope.errFiles = errFiles;
        angular.forEach(files, function (file) {
            file.upload = Upload.upload({
                url: upload_url,
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

        var file = $scope.photos[index].result.file;
        $http.get("/images/delete/" + file).success(function () {
            $scope.photos.splice(index, 1);
        });

    }

})
    .controller('opportunitiesProductsCtrl', function ($scope, $http) {
        $scope.selectedCategory = 0;
        $scope.totalPrice = 0;
        $scope.productsList = [];

        //get productsList from parent controller
        $scope.$on('getProductsList', function (e) {
            $scope.$parent.productsList = $scope.productsList;
        });

        $scope.getCategoryProducts = function (index) {
            if ($scope.productsList && $scope.productsList[index].category) {

                var category = $scope.productsList[index].category;
                $http.get("/products/ajax/category/" + category).success(function (resp) {
                    if (resp.success) {
                        $scope.productsList[index].categoryProducts = resp.data;
                    }
                })
            }
        }
        $scope.appendList = function () {
            var product = {
                category: null,
                categoryProducts: [],
                product: null,
                quantity: 1,
                price: 0.00,
                total: 0.00
            }
            $scope.productsList.push(product);
        }
        $scope.updatePrices = function (index) {
            if (index != null && $scope.productsList[index].product) {
                var sum = 0;
                angular.forEach($scope.productsList, function (product, key) {
                    var total = parseFloat(product.price) * parseInt(product.quantity);
                    $scope.productsList[key].total = total;
                    sum += parseFloat(total);
                });

                $scope.totalPrice = sum;
                /*angular.forEach($scope.productsList[index].categoryProducts, function (product) {
                 if (parseInt(product.id) == parseInt(item.product)) {

                 $scope.productsList[index].price = (parseInt(item.quantity) * parseFloat(product.price)) | 0.00;
                 }
                 });*/
            }
            //updateTotalPrice();

        }
        var updateTotalPrice = function () {
            var totalPrice = 0;
            if ($scope.productsList.length) {

                angular.forEach($scope.productsList, function (item) {
                    totalPrice += parseFloat(item.price);
                });

            }
            $scope.totalPrice = parseInt(totalPrice) | 0;
        }
        $scope.removeProduct = function (index) {

            if ($scope.productsList.splice(index, 1)) {
                updateTotalPrice();
            }

        }
    })
    .controller("createOpportunityFormData", function ($scope, $http, $attrs, transformRequestAsFormPost) {

        $scope.formData = {};
        $scope.errors = {};
        $scope.productsList = [];


        $scope.processFormData = function (event) {
            $scope.$broadcast('getProductsList');

            var mergedData = angular.extend($scope.formData, $scope.productsList);
            event.preventDefault();
            var url = $attrs.action;
            /*$http({
             method  : 'POST',
             url     : url,
             data    : mergedData,  // pass in data as strings,
             transformRequest: transformRequestAsFormPost
             // headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
             }).success(function (resp) {
             if(!resp.success){
             $scope.errors=JSON.parse(resp.errors);

             }else{

             console.log(resp);
             }
             });*/
            var data = $('#ajaxForm').serialize();
            $.ajax({
                url: url,
                method: "POST",
                dataType: "JSON",
                data: data
            }).done(function (resp) {
                if (!resp.success) {
                    $scope.errors = JSON.parse(resp.errors);
                    $scope.$apply();
                } else {
                    window.location = resp.redirect;
                }
            });


        }

    })
    .controller("closeConfirmationCtrl", function ($scope, $http, $attrs, Upload, $timeout) {
        $scope.photos = [];
        $scope.uploaded = false;
        var upload_url = $attrs.uploadUrl;
        $scope.uploadPhoto = function (files, errFiles) {
            $scope.photos = files;
            $scope.errFiles = errFiles;
            angular.forEach(files, function (file) {
                file.upload = Upload.upload({
                    url: upload_url,
                    data: {file: file}
                });

                file.upload.then(function (response) {
                    $timeout(function () {
                        $scope.uploaded = true;
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

            var file = $scope.photos[index].result.file;
            $http.get("/images/delete/" + file).success(function () {
                $scope.photos.splice(index, 1);
            });

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
    .directive("exportData", function ($http, $location) {
        return {
            restrict: 'EA',
            link: function (scope, element, attrs) {


                var type = attrs.exportData;
                var params = "?";
                var url = $location.absUrl();
                if (typeof $location.search().page != 'undefined') {

                    params += "page=" + $location.search().page;
                    params += "&export=" + type;
                } else {
                    params += "export=" + type;
                }
                url += params;
                element.bind("click", function () {
                    if (type == "print") {
                        var newWin = window.open();
                    }
                    $http.get(url).success(function (resp) {
                        if (type == "print") {

                            newWin.document.write(resp);
                            newWin.document.write("<script>window.print()</script>")
                            newWin.document.close();
                            newWin.focus();
                            // newWin.print();
                            // newWin.close();


                        }
                    });
                })


            }
        }
    })
    .directive("modal", function ($http) {
        return {
            restrict: 'EA',
            link: function (scope, element, attrs) {

                var url = attrs.url;
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