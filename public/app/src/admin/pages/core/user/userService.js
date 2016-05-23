// factory
angular
    .module('BlurAdmin.pages.core.user')
    .factory('userService', userService)
    .factory('userLoader', userLoader)
    .factory('userMultiLoader', userMultiLoader);

// do you need it?
// typeService.$inject = ['$http', '$location', '$q', 'apiService'];

function userService($http, $location, $q, apiService) {
    apiService.setEndpoint('user');
    var service = {
        save: save,
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

function userLoader(userService) {
    return userService.findOne();
}

function userMultiLoader() {
    return userService.findAll();
}
    