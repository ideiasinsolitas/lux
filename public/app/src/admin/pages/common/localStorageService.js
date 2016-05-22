// factory
angular
    .module('app')
    .factory('localStorageService', localStorageService);

function localStorageService() {
    var defaultObjectStorageKey = 'admin_app_state';
    var service = {
        save: save,
        findAll: findAll,
        findOne: findOne
    };
    return service;

    ////////////

    function save(key, model) {
        var newModel = findAll()[key] = model;
        return localStorage.save(newModel);
    }

    function findAll() {
        return localStorage.get(defaultObjectStorageKey);
    }

    function findOne(key) {
        return findAll()[key];
    }
}
