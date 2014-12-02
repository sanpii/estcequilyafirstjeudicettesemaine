'use strict';

var app = angular.module('first-jeudi', ['ngRoute', 'firstJeudiServices']);

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/', {
        templateUrl: '/bundles/app/partials/index.html',
        controller: IndexController
    });
}]);

app.run();
