'use strict';

function IndexController($scope, FirstJeudi)
{
    $scope.info = FirstJeudi.get();
}
IndexController.$inject = ['$scope', 'FirstJeudi'];
