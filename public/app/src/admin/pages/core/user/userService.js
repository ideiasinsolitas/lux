// factory
angular
    .module('Lux.pages.core.user')
    .factory('userService', userService)
    .factory('userLoader', userLoader)
    .factory('userMultiLoader', userMultiLoader);

typeService.$inject = ['$http', '$location', '$q', 'apiService'];

function userService($http, $location, $q, apiService) {
    
    apiService.setEndpoint('user');
    
    var service = {
        save: save,
        delete: delete,
        findOne: findOne,
        findAll: findAll
    };
    
    return service;

    ////////////

    function save(model) {
        return apiService.save(model);
    }

    function findAll() {
        return apiService.findAll();
    }

    function findOne(pk) {
        return apiService.findOne(pk);
    }

    function delete(pk) {
        return apiService.delete(pk);
    }
}

function userLoader(userService, pk) {
    return userService.findOne(pk);
}

function userMultiLoader() {
    return userService.findAll();
}
    