'use strict';

angular.module('firstJeudiServices', ['ngResource'])
    .factory('FirstJeudi', ['$resource', function ($resource) {
        return $resource('//estcequilyafirstjeudicettesemaine.fr/api');
    }]);
