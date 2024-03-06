/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 4/29/16
 * Time: 9:36 PM
 */
angular.module("listing.services", []).service("listingService", ['$rootScope', '$http', function ($rootScope, $http) {
    "use strict"
    var get = function (url, callback) {
        $http({method: 'GET', url: url}).success(function (data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available
            callback(data);
        }).error(function (data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            throw "No data returned from " + url;
        });
    };

    this.get = function (url, callback) {
        get(url, callback)
    };
    var post = function (url, callback, obj) {
        $http({method: 'POST', url: url, data: obj}).success(function (data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available
            callback(data);
        }).error(function (data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            throw "No data returned from " + url;
        });
    };
    this.post = function (url, callback, obj) {
        post(url, callback, obj);
    }
    /* add product to compare*/
    var compare = function (id) {
        var qs = "";
        if (id) {
            qs = "/?product=" + id;
        }
        get(laraApp.appUrl+"/compare" + qs, function (result) {
            $rootScope.compareList=[];
            if(result.success){

                $rootScope.compareList=result.data;
            }
            return result;
        })
    };
    
    /*global function to add product to compare*/
    $rootScope.addToCompare = function (id) {

        compare(id);
        angular.element('.ct-js-cart__button').show();
        angular.element('.ct-cart__message').addClass('ct-cart__message-added');
        setTimeout(function(){
            angular.element('.ct-cart__message').removeClass('ct-cart__message-added');
        }, 1000)
    }

}]);