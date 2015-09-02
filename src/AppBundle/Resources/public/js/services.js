'use strict';

angular.module('firstJeudiServices', ['ngResource'])
    .factory('FirstJeudi', ['$resource', function ($resource) {
        return $resource('//localhost:8080/app_dev.php/api');
    }]);
