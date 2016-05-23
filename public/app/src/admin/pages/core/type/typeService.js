// factory
angular
    .module('BlurAdmin.pages')
    .factory('typeService', typeService);

typeService.$inject = ['$http', '$location', '$q', 'apiService'];

function typeService($http, $location, $q, apiService) {
    apiService.setEndpoint('type');
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

    function delete(pk) {
        return apiService.delete(pk);
    }
}
