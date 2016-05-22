// factory
angular
    .module('BlurAdmin.pages')
    .factory('configService', configService);

configService.$inject = ['$http', '$location', '$q', 'apiService'];

function configService($http, $location, $q, apiService) {
    apiService.setEndpoint('config');
    var service = {
        save: save,
        findAll: findAll
    };
    return service;

    ////////////

    function save(model) {
        return apiService.save(model);
    };

    function findAll() {
        return apiService.findAll();
    };
}
