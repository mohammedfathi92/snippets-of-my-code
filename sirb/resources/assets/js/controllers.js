/**
 * Created by mohammed on 7/23/16.
 */
var ctrl = angular.module('controllers', []);
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
                    console.log("test here");
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
                    console.log("test modal");
                    /*$http.get(url).success(function (resp) {
                     if (resp) {
                     angular.element("#modalContent").html(resp);
                     angular.element(attrs.target).modal().show();
                     }
                     });*/
                })


            }
        }
    });